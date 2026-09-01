#!/usr/bin/env bash
# ==============================================================================
# BestJodi - Automated Database and Uploads Backup Script
# Creates timestamped backup archives and enforces retention policy
# ==============================================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(cd "$SCRIPT_DIR/.." && pwd)"
BACKUP_DIR="$ROOT_DIR/backups"
TIMESTAMP="$(date +"%Y%m%d_%H%M%S")"
CURRENT_BACKUP_DIR="$BACKUP_DIR/backup_$TIMESTAMP"
RETENTION_DAYS=14

# Load environment variables if available
if [ -f "$ROOT_DIR/.env" ]; then
    export $(grep -v '^#' "$ROOT_DIR/.env" | xargs -0 2>/dev/null) 2>/dev/null || true
    # Fallback line by line parsing
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
RETENTION_DAYS="${BACKUP_RETENTION_DAYS:-14}"

mkdir -p "$CURRENT_BACKUP_DIR"

echo "=================================================="
echo "📦 Starting BestJodi Backup: $TIMESTAMP"
echo "=================================================="

# 1. Backup Database
SQL_FILE="$CURRENT_BACKUP_DIR/database_${DB_NAME}_$TIMESTAMP.sql"
echo "🔹 Backing up MySQL database '$DB_NAME'..."

if docker ps --format '{{.Names}}' | grep -q "^bestjodi_db$"; then
    echo "  🐳 Exporting from Docker container 'bestjodi_db'..."
    docker exec bestjodi_db mysqldump -u root -p"$ROOT_PASS" "$DB_NAME" > "$SQL_FILE"
elif command -v mysqldump &>/dev/null; then
    echo "  🖥️  Exporting using local mysqldump..."
    mysqldump -h "${DB_HOST:-localhost}" -P "${DB_PORT:-3306}" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" > "$SQL_FILE"
else
    echo "  ⚠️  Could not run mysqldump directly. Searching for running MySQL container..."
    DB_CONTAINER=$(docker ps --filter "name=db" --format "{{.ID}}" | head -n 1)
    if [ -n "$DB_CONTAINER" ]; then
        docker exec "$DB_CONTAINER" mysqldump -u root -p"$ROOT_PASS" "$DB_NAME" > "$SQL_FILE"
    else
        echo "  ❌ Failed to backup database: No mysqldump tool or running database container found."
    fi
fi

if [ -f "$SQL_FILE" ] && [ -s "$SQL_FILE" ]; then
    gzip -f "$SQL_FILE"
    echo "  ✅ Database dumped successfully: $(basename "$SQL_FILE.gz") ($(du -h "$SQL_FILE.gz" | cut -f1))"
else
    echo "  ⚠️  Database dump was empty or failed."
fi

# 2. Backup Uploaded Files (Photos, Horoscopes, Success Stories)
echo "🔹 Backing up user uploads..."
UPLOADS_ARCHIVE="$CURRENT_BACKUP_DIR/uploads_$TIMESTAMP.tar.gz"

cd "$ROOT_DIR/public_html"
tar -czf "$UPLOADS_ARCHIVE" \
    my_photos \
    my_photos_big \
    horoscope-list \
    SuccessStory \
    advertise \
    2>/dev/null || true

if [ -f "$UPLOADS_ARCHIVE" ]; then
    echo "  ✅ Uploads compressed successfully: $(basename "$UPLOADS_ARCHIVE") ($(du -h "$UPLOADS_ARCHIVE" | cut -f1))"
fi

# 3. Create Full Consolidated Archive
cd "$BACKUP_DIR"
FULL_ARCHIVE="$BACKUP_DIR/bestjodi_full_backup_$TIMESTAMP.tar.gz"
tar -czf "$FULL_ARCHIVE" "backup_$TIMESTAMP"
rm -rf "backup_$TIMESTAMP"

echo "  🎉 Consolidated Backup Created: $FULL_ARCHIVE ($(du -h "$FULL_ARCHIVE" | cut -f1))"

# 4. Enforce Retention Policy
echo "🔹 Cleaning up backups older than $RETENTION_DAYS days..."
find "$BACKUP_DIR" -type f -name "bestjodi_full_backup_*.tar.gz" -mtime +"$RETENTION_DAYS" -exec rm -f {} \;
echo "✅ Backup process finished cleanly!"
