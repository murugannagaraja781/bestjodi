#!/usr/bin/env bash
# ==============================================================================
# BestJodi - 1-Click Production VPS Automated Deployment Script
# Supports: Ubuntu 20.04 / 22.04 / 24.04 LTS, Debian 11 / 12
# ==============================================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(cd "$SCRIPT_DIR/.." && pwd)"

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m'

echo -e "${CYAN}${BOLD}"
echo "============================================================"
echo "    🚀 BESTJODI PRODUCTION VPS 1-CLICK DEPLOYMENT          "
echo "============================================================"
echo -e "${NC}"

# 1. Root Check
if [ "$(id -u)" -ne 0 ]; then
    echo -e "${RED}❌ Please run this script with sudo or as root: sudo bash scripts/deploy_vps.sh${NC}"
    exit 1
fi

# 2. Install Docker & Docker Compose if missing
echo -e "${YELLOW}🔹 Step 1: Checking Docker & Docker Compose...${NC}"
if ! command -v docker &>/dev/null; then
    echo "  Installing Docker..."
    apt-get update -qq
    apt-get install -y -qq apt-transport-https ca-certificates curl gnupg lsb-release ufw
    curl -fsSL https://get.docker.com -o get-docker.sh
    sh get-docker.sh
    rm -f get-docker.sh
    systemctl enable docker
    systemctl start docker
    echo -e "${GREEN}  ✅ Docker installed successfully.${NC}"
else
    echo -e "${GREEN}  ✅ Docker is already installed: $(docker --version)${NC}"
fi

# Check Docker Compose plugin
if ! docker compose version &>/dev/null && ! command -v docker-compose &>/dev/null; then
    echo "  Installing Docker Compose plugin..."
    apt-get update -qq
    apt-get install -y -qq docker-compose-plugin
fi

# 3. Configure Firewall (UFW)
echo -e "${YELLOW}🔹 Step 2: Configuring Firewall (UFW)...${NC}"
if command -v ufw &>/dev/null; then
    ufw allow 22/tcp comment 'SSH' || true
    ufw allow 80/tcp comment 'HTTP' || true
    ufw allow 443/tcp comment 'HTTPS' || true
    ufw allow 8080/tcp comment 'BestJodi App' || true
    echo "y" | ufw enable || true
    echo -e "${GREEN}  ✅ Firewall rules applied.${NC}"
fi

# 4. Generate Production .env Configuration
echo -e "${YELLOW}🔹 Step 3: Configuring Environment (.env)...${NC}"
if [ ! -f "$ROOT_DIR/.env" ]; then
    echo "  Creating new secure .env file..."
    
    # Generate secure random passwords
    RANDOM_DB_PASS=$(openssl rand -hex 16 2>/dev/null || date +%s | sha256sum | base64 | head -c 20)
    RANDOM_ROOT_PASS=$(openssl rand -hex 16 2>/dev/null || date +%s | sha256sum | base64 | head -c 24)
    
    cat <<EOF > "$ROOT_DIR/.env"
APP_ENV=production
APP_PORT=80
APP_URL=http://localhost

DB_HOST=db
DB_PORT=3306
DB_DATABASE=bestjodi
DB_USER=best_jodi_user
DB_PASSWORD=${RANDOM_DB_PASS}
MYSQL_ROOT_PASSWORD=${RANDOM_ROOT_PASS}

PMA_PORT=8081

PHP_MEMORY_LIMIT=256M
PHP_UPLOAD_MAX_FILESIZE=64M
PHP_POST_MAX_SIZE=64M
PHP_MAX_EXECUTION_TIME=300

BACKUP_RETENTION_DAYS=14
EOF
    echo -e "${GREEN}  ✅ Production .env generated with secure random credentials.${NC}"
else
    echo -e "${GREEN}  ✅ Existing .env file found.${NC}"
fi

# 5. Fix Directory Permissions
echo -e "${YELLOW}🔹 Step 4: Setting Permissions on Upload Directories...${NC}"
bash "$SCRIPT_DIR/fix_permissions.sh"

# 6. Launch Docker Containers
echo -e "${YELLOW}🔹 Step 5: Building and Starting Application Containers...${NC}"
cd "$ROOT_DIR"
if docker compose version &>/dev/null; then
    docker compose up -d --build
else
    docker-compose up -d --build
fi

# 7. Wait for Database Readiness
echo -e "${YELLOW}🔹 Step 6: Waiting for Database Initialization...${NC}"
RETRIES=30
until docker exec bestjodi_db mysqladmin ping -h localhost --silent 2>/dev/null || [ $RETRIES -eq 0 ]; do
    echo -n "."
    sleep 2
    RETRIES=$((RETRIES - 1))
done
echo ""

if [ $RETRIES -eq 0 ]; then
    echo -e "${RED}⚠️  Database took longer than expected to start. Check logs: docker logs bestjodi_db${NC}"
else
    echo -e "${GREEN}  ✅ Database is ready and healthy!${NC}"
fi

# 8. Setup Automated Daily Backup Cron Job
echo -e "${YELLOW}🔹 Step 7: Setting up Daily Backup Cron Job...${NC}"
CRON_JOB="0 2 * * * cd $ROOT_DIR && /bin/bash $SCRIPT_DIR/backup.sh >> $ROOT_DIR/backups/backup.log 2>&1"
(crontab -l 2>/dev/null | grep -v "bestjodi.*backup.sh" ; echo "$CRON_JOB") | crontab -
echo -e "${GREEN}  ✅ Daily 2:00 AM backup cron job configured.${NC}"

# 9. Server IP & Domain Discovery
SERVER_IP=$(curl -s ifconfig.me || curl -s icanhazip.com || echo "YOUR_SERVER_IP")

echo ""
echo -e "${GREEN}${BOLD}============================================================${NC}"
echo -e "${GREEN}${BOLD}   🎉 BESTJODI PRODUCTION DEPLOYMENT COMPLETED!            ${NC}"
echo -e "${GREEN}${BOLD}============================================================${NC}"
echo ""
echo -e "  🌐 ${BOLD}Website URL:${NC}       http://$SERVER_IP"
echo -e "  ⚙️  ${BOLD}Admin Panel:${NC}       http://$SERVER_IP/admin"
echo -e "  🔑 ${BOLD}Admin Username:${NC}    admin1"
echo -e "  🔒 ${BOLD}Admin Password:${NC}    admin1"
echo ""
echo -e "  🗄️  ${BOLD}phpMyAdmin URL:${NC}    http://$SERVER_IP:8081"
echo -e "  👤 ${BOLD}phpMyAdmin User:${NC}   root"
echo -e "  🔑 ${BOLD}phpMyAdmin Pass:${NC}   (stored in .env)"
echo ""
echo -e "  📁 ${BOLD}Backups Directory:${NC} $ROOT_DIR/backups"
echo -e "  🎮 ${BOLD}Control Command:${NC}   ./autoscript.sh menu"
echo -e "${GREEN}${BOLD}============================================================${NC}"
