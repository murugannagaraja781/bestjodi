#!/usr/bin/env bash
# ==============================================================================
# BestJodi - Backup Restoration Script
# Restores database and upload folders from a backup archive or SQL file
# ==============================================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(cd "$SCRIPT_DIR/.." && pwd)"
BACKUP_DIR="$ROOT_DIR/backups"

# Load environment variables if available
if [ -f "$ROOT_DIR/.env" ]; then
    while IFS='=' read -r key value; do
        [[ "$key" =~ ^#.*$ ]] && continue
        [ -z "$key" ] && continue
        export "$key=$value" 2>/dev/null || true
    done < "$ROOT_DIR/.env"
fi

DB_NAME="${DB_DATABASE:-bestjodi}"
DB_USER="${DB_USER:-best_jodi_user}"
DB_PASS="${DB_PASSWORD:-bestjodi_secure_pass_2026}"
ROOT_PASS="${MYSQL_ROOT_PASSWORD:-bestjodi_root_secret_2026}"

BACKUP_TARGET="$1"

if [ -z "$BACKUP_TARGET" ]; then
    echo "📋 Available backups in $BACKUP_DIR:"
    echo "--------------------------------------------------"
    ls -lh "$BACKUP_DIR"/*.tar.gz 2>/dev/null || echo "No backups found."
    echo "--------------------------------------------------"
    echo "Usage: $0 <path_to_backup_archive_or_sql_file>"
    exit 1
fi

if [ ! -f "$BACKUP_TARGET" ]; then
    echo "❌ Error: Backup file '$BACKUP_TARGET' does not exist."
    exit 1
fi

echo "=================================================="
echo "⚠️  WARNING: RESTORING WILL OVERWRITE CURRENT DATA!"
echo "Target: $BACKUP_TARGET"
echo "=================================================="
read -p "Are you sure you want to proceed? (y/N): " -r CONFIRM
if [[ ! "$CONFIRM" =~ ^[Yy]$ ]]; then
    echo "Restoration cancelled."
    exit 0
fi

TEMP_RESTORE_DIR="/tmp/bestjodi_restore_$(date +%s)"
mkdir -p "$TEMP_RESTORE_DIR"

# Clean up temp dir on exit
trap 'rm -rf "$TEMP_RESTORE_DIR"' EXIT

echo "🔹 Extracting backup files..."
if [[ "$BACKUP_TARGET" =~ \.tar\.gz$ ]]; then
    tar -xzf "$BACKUP_TARGET" -C "$TEMP_RESTORE_DIR"
    
    # Check if there is an inner directory
    INNER_DIR=$(find "$TEMP_RESTORE_DIR" -mindepth 1 -maxdepth 1 -type d | head -n 1)
    SEARCH_DIR="${INNER_DIR:-$TEMP_RESTORE_DIR}"
    
    # Find SQL dump inside
    SQL_DUMP=$(find "$SEARCH_DIR" -name "*.sql.gz" -o -name "*.sql" | head -n 1)
    
    # Find uploads archive inside
    UPLOADS_TAR=$(find "$SEARCH_DIR" -name "uploads_*.tar.gz" | head -n 1)
    
    if [ -n "$UPLOADS_TAR" ]; then
        echo "🔹 Restoring user uploads..."
        tar -xzf "$UPLOADS_TAR" -C "$ROOT_DIR/public_html"
        echo "  ✅ User uploads restored."
    fi
elif [[ "$BACKUP_TARGET" =~ \.sql(\.gz)?$ ]]; then
    SQL_DUMP="$BACKUP_TARGET"
fi

if [ -n "$SQL_DUMP" ]; then
    echo "🔹 Restoring MySQL database '$DB_NAME' from $(basename "$SQL_DUMP")..."
    
    if [[ "$SQL_DUMP" =~ \.gz$ ]]; then
        UNZIPPED_SQL="$TEMP_RESTORE_DIR/restore.sql"
        gunzip -c "$SQL_DUMP" > "$UNZIPPED_SQL"
        SQL_FILE_TO_IMPORT="$UNZIPPED_SQL"
    else
        SQL_FILE_TO_IMPORT="$SQL_DUMP"
    fi
    
    if docker ps --format '{{.Names}}' | grep -q "^bestjodi_db$"; then
        echo "  🐳 Importing into Docker container 'bestjodi_db'..."
        docker exec -i bestjodi_db mysql -u root -p"$ROOT_PASS" "$DB_NAME" < "$SQL_FILE_TO_IMPORT"
    elif command -v mysql &>/dev/null; then
        echo "  🖥️  Importing using local mysql..."
        mysql -h "${DB_HOST:-localhost}" -P "${DB_PORT:-3306}" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$SQL_FILE_TO_IMPORT"
    else
        echo "  ❌ Failed to find MySQL import method."
        exit 1
    fi
    echo "  ✅ Database imported successfully."
fi

# Fix permissions after restore
"$SCRIPT_DIR/fix_permissions.sh"

echo "🎉 Restoration completed successfully!"
