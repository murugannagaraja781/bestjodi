#!/usr/bin/env bash
# ==============================================================================
# BestJodi - Health Check Script
# Validates web app HTTP response, MySQL connectivity, and disk storage
# ==============================================================================

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(cd "$SCRIPT_DIR/.." && pwd)"

# Load environment
if [ -f "$ROOT_DIR/.env" ]; then
    while IFS='=' read -r key value; do
        [[ "$key" =~ ^#.*$ ]] && continue
        [ -z "$key" ] && continue
        export "$key=$value" 2>/dev/null || true
    done < "$ROOT_DIR/.env"
fi

APP_PORT="${APP_PORT:-8080}"
APP_URL="${APP_URL:-http://localhost:$APP_PORT}"
DB_NAME="${DB_DATABASE:-bestjodi}"
ROOT_PASS="${MYSQL_ROOT_PASSWORD:-bestjodi_root_secret_2026}"

echo "=================================================="
echo "🩺 Running BestJodi System Health Check"
echo "=================================================="

HEALTH_OK=true

# 1. Check Web Service
echo -n "🌐 Checking Web Server ($APP_URL)... "
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" "$APP_URL" || echo "000")

if [ "$HTTP_CODE" -ge 200 ] && [ "$HTTP_CODE" -lt 400 ]; then
    echo "✅ UP (HTTP $HTTP_CODE)"
else
    echo "❌ DOWN / ERROR (HTTP $HTTP_CODE)"
    HEALTH_OK=false
fi

# 2. Check Database Service
echo -n "🗄️  Checking MySQL Database... "
if docker ps --format '{{.Names}}' | grep -q "^bestjodi_db$"; then
    if docker exec bestjodi_db mysqladmin ping -u root -p"$ROOT_PASS" --silent 2>/dev/null; then
        echo "✅ CONNECTED (Docker: bestjodi_db)"
    else
        echo "❌ DOWN (Docker container not responding)"
        HEALTH_OK=false
    fi
else
    if command -v mysqladmin &>/dev/null && mysqladmin ping -h "${DB_HOST:-localhost}" --silent 2>/dev/null; then
        echo "✅ CONNECTED (Native MySQL)"
    else
        echo "⚠️  Unable to ping database directly or container not running"
    fi
fi

# 3. Check Disk Storage
echo -n "💾 Checking Disk Space... "
DISK_USAGE=$(df -h "$ROOT_DIR" | awk 'NR==2 {print $5}')
DISK_FREE=$(df -h "$ROOT_DIR" | awk 'NR==2 {print $4}')
echo "✅ $DISK_FREE free (Usage: $DISK_USAGE)"

# 4. Check Upload Folders Write Permission
echo -n "📁 Checking Upload Directories... "
if [ -w "$ROOT_DIR/public_html/my_photos" ]; then
    echo "✅ Writable"
else
    echo "⚠️  Uploads directory is not writable. Run ./autoscript.sh fix-perms"
fi

echo "=================================================="
if [ "$HEALTH_OK" = true ]; then
    echo "🎉 ALL SYSTEMS OPERATIONAL!"
    exit 0
else
    echo "⚠️  WARNING: Some health checks failed. Inspect logs with './autoscript.sh logs'"
    exit 1
fi
