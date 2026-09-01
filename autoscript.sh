#!/usr/bin/env bash
# ==============================================================================
#  _               _    _           _ _ 
# | |__   ___  ___| |_ (_) ___   __| (_)
# | '_ \ / _ \/ __| __|| |/ _ \ / _` | |
# | |_) |  __/\__ \ |_ | | (_) | (_| | |
# |_.__/ \___||___/\__// |\___/ \__,_|_|
#                    |__/               
# ==============================================================================
# BestJodi Matrimony - Master Production Automation & Management CLI
# Version: 2.0 (Production-Ready)
# ==============================================================================

set -e

# Base directory paths
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$SCRIPT_DIR"
SCRIPTS_DIR="$ROOT_DIR/scripts"
PUBLIC_HTML="$ROOT_DIR/public_html"
ENV_FILE="$ROOT_DIR/.env"
ENV_EXAMPLE="$ROOT_DIR/.env.example"

# ANSI Color Palette
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m'

# Helper functions
print_banner() {
    echo -e "${CYAN}${BOLD}"
    cat << "EOF"
  ____            _         _           _ _ 
 |  _ \          | |       | |         | (_)
 | |_) | ___  ___| |_      | | ___   __| |_ 
 |  _ < / _ \/ __| __| _   | |/ _ \ / _` | |
 | |_) |  __/\__ \ |_ | |__| | (_) | (_| | |
 |____/ \___||___/\__| \____/ \___/ \__,_|_|
  >> BestJodi Production Automation Suite <<
EOF
    echo -e "${NC}"
}

print_success() { echo -e "${GREEN}✅ $1${NC}"; }
print_info()    { echo -e "${CYAN}ℹ️  $1${NC}"; }
print_warn()    { echo -e "${YELLOW}⚠️  $1${NC}"; }
print_error()   { echo -e "${RED}❌ $1${NC}"; }

# Detect docker-compose command
get_compose_cmd() {
    if docker compose version &>/dev/null; then
        echo "docker compose"
    elif command -v docker-compose &>/dev/null; then
        echo "docker-compose"
    else
        echo ""
    fi
}

# Ensure .env exists
ensure_env() {
    if [ ! -f "$ENV_FILE" ]; then
        print_warn ".env file not found. Generating default from .env.example..."
        if [ -f "$ENV_EXAMPLE" ]; then
            cp "$ENV_EXAMPLE" "$ENV_FILE"
        else
            cat <<EOF > "$ENV_FILE"
APP_ENV=production
APP_PORT=8080
APP_URL=http://localhost:8080
DB_HOST=db
DB_PORT=3306
DB_DATABASE=bestjodi
DB_USER=best_jodi_user
DB_PASSWORD=bestjodi_secure_pass_2026
MYSQL_ROOT_PASSWORD=bestjodi_root_secret_2026
PMA_PORT=8081
PHP_MEMORY_LIMIT=256M
PHP_UPLOAD_MAX_FILESIZE=64M
PHP_POST_MAX_SIZE=64M
PHP_MAX_EXECUTION_TIME=300
BACKUP_RETENTION_DAYS=14
EOF
        fi
        print_success "Created $ENV_FILE"
    fi
}

# Load .env variables
load_env() {
    ensure_env
    while IFS='=' read -r key value; do
        [[ "$key" =~ ^#.*$ ]] && continue
        [ -z "$key" ] && continue
        export "$key=$value" 2>/dev/null || true
    done < "$ENV_FILE"
}

# 1. START STACK
cmd_start() {
    print_banner
    print_info "Starting BestJodi Application Stack..."
    
    ensure_env
    load_env
    
    COMPOSE=$(get_compose_cmd)
    if [ -z "$COMPOSE" ]; then
        print_error "Docker / Docker Compose not found on your system."
        echo "Please install Docker Desktop (for Mac/Windows) or run: sudo bash scripts/deploy_vps.sh (for Linux VPS)"
        exit 1
    fi
    
    # Fix directory permissions before starting
    print_info "Setting folder permissions for photo uploads..."
    bash "$SCRIPTS_DIR/fix_permissions.sh" > /dev/null 2>&1 || true
    
    print_info "Building and launching containers via $COMPOSE..."
    $COMPOSE up -d --build
    
    print_info "Waiting for database initialization..."
    RETRIES=20
    until docker exec bestjodi_db mysqladmin ping -h localhost --silent 2>/dev/null || [ $RETRIES -eq 0 ]; do
        echo -n "."
        sleep 1
        RETRIES=$((RETRIES - 1))
    done
    echo ""
    
    APP_PORT="${APP_PORT:-8080}"
    PMA_PORT="${PMA_PORT:-8081}"
    
    echo ""
    print_success "BestJodi Application Stack is ONLINE!"
    echo "============================================================"
    echo -e "  🌐 ${BOLD}Website URL:${NC}       http://localhost:${APP_PORT}"
    echo -e "  ⚙️  ${BOLD}Admin Panel:${NC}       http://localhost:${APP_PORT}/admin"
    echo -e "  🔑 ${BOLD}Admin User:${NC}        admin1"
    echo -e "  🔒 ${BOLD}Admin Pass:${NC}        admin1"
    echo ""
    echo -e "  🗄️  ${BOLD}phpMyAdmin URL:${NC}    http://localhost:${PMA_PORT}"
    echo -e "  👤 ${BOLD}phpMyAdmin User:${NC}   root"
    echo -e "  🔑 ${BOLD}phpMyAdmin Pass:${NC}   ${MYSQL_ROOT_PASSWORD:-bestjodi_root_secret_2026}"
    echo "============================================================"
}

# 2. STOP STACK
cmd_stop() {
    print_info "Stopping BestJodi Application Stack..."
    COMPOSE=$(get_compose_cmd)
    if [ -n "$COMPOSE" ]; then
        $COMPOSE down
        print_success "All services stopped."
    fi
}

# 3. RESTART STACK
cmd_restart() {
    print_info "Restarting BestJodi Application Stack..."
    cmd_stop
    sleep 2
    cmd_start
}

# 4. STATUS
cmd_status() {
    print_banner
    COMPOSE=$(get_compose_cmd)
    if [ -n "$COMPOSE" ]; then
        $COMPOSE ps
    fi
    echo ""
    bash "$SCRIPTS_DIR/healthcheck.sh"
}

# 5. LOGS
cmd_logs() {
    SERVICE="${1:-}"
    COMPOSE=$(get_compose_cmd)
    if [ -n "$COMPOSE" ]; then
        if [ -n "$SERVICE" ]; then
            $COMPOSE logs -f "$SERVICE"
        else
            $COMPOSE logs -f --tail=100
        fi
    fi
}

# 6. BACKUP
cmd_backup() {
    bash "$SCRIPTS_DIR/backup.sh"
}

# 7. RESTORE
cmd_restore() {
    TARGET="$1"
    bash "$SCRIPTS_DIR/restore.sh" "$TARGET"
}

# 8. FIX PERMISSIONS
cmd_fix_perms() {
    bash "$SCRIPTS_DIR/fix_permissions.sh"
}

# 9. IMPORT DATABASE
cmd_db_import() {
    load_env
    SQL_FILE="${1:-$ROOT_DIR/bestjodi.sql}"
    if [ ! -f "$SQL_FILE" ]; then
        print_error "SQL file not found: $SQL_FILE"
        exit 1
    fi
    
    print_warn "Importing $SQL_FILE into database '${DB_DATABASE:-bestjodi}'..."
    if docker ps --format '{{.Names}}' | grep -q "^bestjodi_db$"; then
        docker exec -i bestjodi_db mysql -u root -p"${MYSQL_ROOT_PASSWORD:-bestjodi_root_secret_2026}" "${DB_DATABASE:-bestjodi}" < "$SQL_FILE"
        print_success "Database successfully imported into container 'bestjodi_db'!"
    else
        print_error "Database container 'bestjodi_db' is not running. Start it first with './autoscript.sh start'"
    fi
}

# 10. EXPORT DATABASE
cmd_db_export() {
    load_env
    EXPORT_FILE="$ROOT_DIR/bestjodi_export_$(date +%Y%m%d_%H%M%S).sql"
    print_info "Exporting database to $EXPORT_FILE..."
    if docker ps --format '{{.Names}}' | grep -q "^bestjodi_db$"; then
        docker exec bestjodi_db mysqldump -u root -p"${MYSQL_ROOT_PASSWORD:-bestjodi_root_secret_2026}" "${DB_DATABASE:-bestjodi}" > "$EXPORT_FILE"
        print_success "Database exported to: $EXPORT_FILE ($(du -h "$EXPORT_FILE" | cut -f1))"
    else
        print_error "Database container 'bestjodi_db' is not running."
    fi
}

# 11. SHELL INTO CONTAINER
cmd_shell() {
    TARGET="${1:-app}"
    if [ "$TARGET" == "db" ]; then
        print_info "Opening MySQL shell..."
        load_env
        docker exec -it bestjodi_db mysql -u "${DB_USER:-best_jodi_user}" -p"${DB_PASSWORD:-bestjodi_secure_pass_2026}" "${DB_DATABASE:-bestjodi}"
    else
        print_info "Opening bash in app container (bestjodi_app)..."
        docker exec -it bestjodi_app bash
    fi
}

# 12. VPS 1-CLICK DEPLOY
cmd_deploy_vps() {
    bash "$SCRIPTS_DIR/deploy_vps.sh"
}

# 13. SSL SETUP GUIDE
cmd_setup_ssl() {
    print_banner
    echo -e "${YELLOW}${BOLD}🔒 Let's Encrypt Free SSL Setup for BestJodi${NC}"
    echo "------------------------------------------------------------"
    echo "To configure SSL on your domain (e.g. yoursite.com):"
    echo ""
    echo "1. Ensure DNS A record for yoursite.com points to this server IP."
    echo "2. Install Certbot on your host machine:"
    echo "   sudo apt-get install -y certbot"
    echo "3. Generate certificates:"
    echo "   sudo certbot certonly --standalone -d yoursite.com -d www.yoursite.com"
    echo "4. Link certificates to the ./ssl directory:"
    echo "   mkdir -p $ROOT_DIR/ssl"
    echo "   sudo cp /etc/letsencrypt/live/yoursite.com/fullchain.pem $ROOT_DIR/ssl/cert.pem"
    echo "   sudo cp /etc/letsencrypt/live/yoursite.com/privkey.pem $ROOT_DIR/ssl/key.pem"
    echo "5. Start stack with production Nginx proxy:"
    echo "   docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d"
    echo "------------------------------------------------------------"
}

# INTERACTIVE MENU
cmd_menu() {
    while true; do
        print_banner
        echo -e "${BOLD}Select an action:${NC}"
        echo "  [1] 🚀 Start / Deploy Stack (start)"
        echo "  [2] 🛑 Stop Stack (stop)"
        echo "  [3] 🔄 Restart Stack (restart)"
        echo "  [4] 🩺 System Status & Healthcheck (status)"
        echo "  [5] 📜 View Live Logs (logs)"
        echo "  [6] 📦 Run Automated Backup (backup)"
        echo "  [7] ♻️  Restore from Backup (restore)"
        echo "  [8] 🔧 Fix Upload Permissions (fix-perms)"
        echo "  [9] 📥 Force Import bestjodi.sql (db-import)"
        echo "  [10] 📤 Export Database (db-export)"
        echo "  [11] 💻 Open Container Shell (shell)"
        echo "  [12] 🌐 1-Click VPS Cloud Deployment (deploy-vps)"
        echo "  [13] 🔒 SSL Configuration Instructions (setup-ssl)"
        echo "  [0] 🚪 Exit"
        echo ""
        read -p "Enter option [0-13]: " -r CHOICE
        echo ""

        case "$CHOICE" in
            1) cmd_start ;;
            2) cmd_stop ;;
            3) cmd_restart ;;
            4) cmd_status ;;
            5) cmd_logs ;;
            6) cmd_backup ;;
            7) 
                read -p "Enter path to backup archive: " -r BPATH
                cmd_restore "$BPATH"
                ;;
            8) cmd_fix_perms ;;
            9) cmd_db_import ;;
            10) cmd_db_export ;;
            11) cmd_shell ;;
            12) cmd_deploy_vps ;;
            13) cmd_setup_ssl ;;
            0) exit 0 ;;
            *) print_error "Invalid selection. Please try again." ;;
        esac
        echo ""
        read -p "Press [Enter] to return to menu..."
    done
}

# SHOW HELP
cmd_help() {
    print_banner
    echo -e "${BOLD}Usage:${NC} ./autoscript.sh [command]"
    echo ""
    echo -e "${BOLD}Available Commands:${NC}"
    echo "  start | up          Start application and database stack"
    echo "  stop | down         Stop all running services"
    echo "  restart             Restart application and database stack"
    echo "  status              Check container and database health"
    echo "  logs [service]      View live logs (e.g. ./autoscript.sh logs app)"
    echo "  backup              Create timestamped DB and uploads backup"
    echo "  restore <file>      Restore DB/uploads from a backup file"
    echo "  fix-perms           Fix file permissions for uploads directory"
    echo "  db-import [file]    Import SQL dump into running database"
    echo "  db-export           Export current database state to SQL"
    echo "  shell [app|db]      Open interactive bash or MySQL CLI"
    echo "  deploy-vps          1-Click deployment for Ubuntu/Debian Cloud VPS"
    echo "  setup-ssl           Let's Encrypt Free SSL configuration guide"
    echo "  menu                Open interactive visual CLI menu"
    echo "  help                Display this help screen"
    echo ""
}

# Entrypoint argument parsing
ACTION="${1:-}"

case "$ACTION" in
    start|up)
        cmd_start
        ;;
    stop|down)
        cmd_stop
        ;;
    restart)
        cmd_restart
        ;;
    status)
        cmd_status
        ;;
    logs)
        cmd_logs "${2:-}"
        ;;
    backup)
        cmd_backup
        ;;
    restore)
        cmd_restore "${2:-}"
        ;;
    fix-perms)
        cmd_fix_perms
        ;;
    db-import)
        cmd_db_import "${2:-}"
        ;;
    db-export)
        cmd_db_export
        ;;
    shell)
        cmd_shell "${2:-app}"
        ;;
    deploy-vps)
        cmd_deploy_vps
        ;;
    setup-ssl)
        cmd_setup_ssl
        ;;
    healthcheck)
        bash "$SCRIPTS_DIR/healthcheck.sh"
        ;;
    help|--help|-h)
        cmd_help
        ;;
    "")
        cmd_menu
        ;;
    *)
        print_error "Unknown command: '$ACTION'"
        cmd_help
        exit 1
        ;;
esac
