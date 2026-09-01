#!/usr/bin/env bash
# ==============================================================================
# BestJodi - Permissions Fix Script
# Ensures upload folders, cache and images have correct write permissions
# ==============================================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(cd "$SCRIPT_DIR/.." && pwd)"
PUBLIC_HTML="$ROOT_DIR/public_html"

echo "🔧 Fixing permissions for BestJodi in: $PUBLIC_HTML"

# Ensure upload and dynamic directories exist
UPLOAD_DIRS=(
    "$PUBLIC_HTML/my_photos"
    "$PUBLIC_HTML/my_photos_big"
    "$PUBLIC_HTML/horoscope-list"
    "$PUBLIC_HTML/SuccessStory"
    "$PUBLIC_HTML/advertise"
    "$PUBLIC_HTML/img"
    "$PUBLIC_HTML/chat"
    "$PUBLIC_HTML/admin/img"
    "$ROOT_DIR/backups"
)

for dir in "${UPLOAD_DIRS[@]}"; do
    if [ ! -d "$dir" ]; then
        echo "  📁 Creating missing directory: $dir"
        mkdir -p "$dir"
    fi
    echo "  🔒 Setting write permissions (775) on: $(basename "$dir")"
    chmod -R 775 "$dir" 2>/dev/null || chmod -R 777 "$dir" 2>/dev/null || true
done

# Try setting web-server ownership if running as root/sudo
if [ "$(id -u)" -eq 0 ]; then
    if id "www-data" &>/dev/null; then
        echo "  👤 Setting ownership to www-data:www-data"
        chown -R www-data:www-data "$PUBLIC_HTML" 2>/dev/null || true
    fi
fi

echo "✅ Permissions fixed successfully!"
