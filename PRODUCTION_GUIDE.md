# 🚀 BestJodi Production Deployment & Management Guide

This comprehensive guide explains how to run, deploy, and manage the **BestJodi** Matrimony Web Application in production using the automated script suite (`autoscript.sh`).

---

## 📑 Table of Contents
1. [Architecture & Features](#1-architecture--features)
2. [Quickstart (Local / Mac / Windows)](#2-quickstart-local--mac--windows)
3. [1-Click Cloud VPS Deployment (Ubuntu / Debian)](#3-1-click-cloud-vps-deployment-ubuntu--debian)
4. [Master CLI Commands (`./autoscript.sh`)](#4-master-cli-commands-autoscriptsh)
5. [Database & Admin Credentials](#5-database--admin-credentials)
6. [Free SSL Setup (Let's Encrypt / Certbot)](#6-free-ssl-setup-lets-encrypt--certbot)
7. [Automated Backups & Disaster Recovery](#7-automated-backups--disaster-recovery)
8. [Tanglish Quick Guide (தமிழ் குறிப்பு)](#8-tanglish-quick-guide-தமிழ்-குறிப்பு)

---

## 1. Architecture & Features

```
┌─────────────────────────────────────────────────────────────┐
│                    Nginx Reverse Proxy                      │
│        (Port 80 / 443 with SSL + Security Headers)          │
└──────────────────────────────┬──────────────────────────────┘
                               │
            ┌──────────────────┴──────────────────┐
            ▼                                     ▼
┌───────────────────────┐             ┌───────────────────────┐
│     bestjodi_app      │             │     bestjodi_pma      │
│  PHP 7.4 + Apache     │             │      phpMyAdmin       │
│  (mysqli, gd, zip)    │             │      (Port 8081)      │
└───────────┬───────────┘             └───────────┬───────────┘
            │                                     │
            └──────────────────┬──────────────────┘
                               ▼
            ┌─────────────────────────────────────┐
            │             bestjodi_db             │
            │   MariaDB 10.5 / MySQL 5.7          │
            │   (Auto-loads bestjodi.sql)         │
            └─────────────────────────────────────┘
```

- **Zero-Configuration Startup**: Automatic database import from `bestjodi.sql` on initial container launch.
- **Dynamic Configuration**: `public_html/dbConf.php` dynamically loads database credentials from environment variables / `.env`.
- **Modernized PHP Compatibility**: Replaced deprecated `mysql_*` functions with `mysqli_*` in `chat/chat.php` and `admin/password_get.php`.
- **Performance Tuned**: OPCache enabled, `upload_max_filesize=64M`, `post_max_size=64M`, `memory_limit=256M`, `max_execution_time=300`.
- **Production Hardened**: Proper security headers (`X-Frame-Options`, `X-XSS-Protection`, `X-Content-Type-Options`), sanitized cookies, and file upload permission enforcement.

---

## 2. Quickstart (Local / Mac / Windows)

### Prerequisites:
- Install **Docker Desktop** on macOS or Windows and ensure it is running.

### 1-Step Launch:
```bash
cd /Users/wohozo/Documents/bestjodi
./autoscript.sh start
```

### Or use the interactive terminal UI:
```bash
./autoscript.sh menu
```

Once started, open in your browser:
- 🌐 **Website**: [http://localhost:8080](http://localhost:8080)
- ⚙️ **Admin Panel**: [http://localhost:8080/admin](http://localhost:8080/admin)
- 🗄️ **Database Manager (phpMyAdmin)**: [http://localhost:8081](http://localhost:8081)

---

## 3. 1-Click Cloud VPS Deployment (Ubuntu / Debian)

When deploying to a fresh VPS on **DigitalOcean, AWS EC2, Linode, Hetzner, or Vultr**:

1. Clone or upload the `bestjodi` project directory to the server:
   ```bash
   scp -r /Users/wohozo/Documents/bestjodi root@YOUR_SERVER_IP:/var/www/bestjodi
   ```
2. SSH into your VPS:
   ```bash
   ssh root@YOUR_SERVER_IP
   cd /var/www/bestjodi
   ```
3. Run the automated VPS deployment script:
   ```bash
   sudo bash scripts/deploy_vps.sh
   ```

### What `deploy_vps.sh` does automatically:
1. Installs Docker & Docker Compose if missing.
2. Configures UFW firewall rules (opens ports 22, 80, 443, 8080).
3. Generates a secure `.env` file with random high-entropy passwords.
4. Sets correct permissions on image and horoscope upload folders.
5. Builds and boots the production container stack.
6. Automatically registers a daily automated backup cron job at 2:00 AM.
7. Prints your live server URLs and admin credentials.

---

## 4. Master CLI Commands (`./autoscript.sh`)

| Command | Action |
| :--- | :--- |
| `./autoscript.sh start` | Starts the app, database, and phpMyAdmin containers |
| `./autoscript.sh stop` | Gracefully shuts down all services |
| `./autoscript.sh restart` | Reboots the entire container stack |
| `./autoscript.sh status` | Displays container statuses and runs a healthcheck |
| `./autoscript.sh logs` | Streams live logs from all containers (use `logs app` for web app only) |
| `./autoscript.sh backup` | Creates an instant timestamped backup of MySQL and user uploads |
| `./autoscript.sh restore <file>` | Restores database and upload folders from a `.tar.gz` backup archive |
| `./autoscript.sh fix-perms` | Fixes folder permissions for `my_photos`, `horoscope-list`, etc. |
| `./autoscript.sh db-import [file]` | Re-imports `bestjodi.sql` (or custom SQL file) into the database |
| `./autoscript.sh db-export` | Exports current database state into a timestamped `.sql` file |
| `./autoscript.sh shell [app\|db]` | Opens an interactive bash terminal inside `bestjodi_app` or MySQL CLI |
| `./autoscript.sh deploy-vps` | Executes the 1-click cloud VPS deployment script |
| `./autoscript.sh setup-ssl` | Displays instructions and setup commands for Free Let's Encrypt SSL |
| `./autoscript.sh menu` | Opens the interactive visual CLI menu |

---

## 5. Database & Admin Credentials

### Admin Portal Login:
- **URL**: `http://<your-ip-or-domain>:8080/admin` (or `/admin` on port 80 in VPS)
- **Username**: `admin1`
- **Password**: `admin1`

### Default Database Credentials (Configured in `.env`):
- **Database Host**: `db` (internal Docker service) or `127.0.0.1:3307` (from host)
- **Database Name**: `bestjodi`
- **Database User**: `best_jodi_user`
- **Database Password**: Defined in `.env` (Default: `bestjodi_secure_pass_2026`)
- **Root Password**: Defined in `.env` (Default: `bestjodi_root_secret_2026`)

### phpMyAdmin Login:
- **URL**: `http://<your-ip-or-domain>:8081`
- **Username**: `root`
- **Password**: Your `MYSQL_ROOT_PASSWORD` value from `.env`

---

## 6. Free SSL Setup (Let's Encrypt / Certbot)

To enable HTTPS with a free SSL certificate on your live domain (e.g. `bestjodi.net`):

1. Make sure your domain DNS points to your server's public IP address.
2. Install Certbot on the host:
   ```bash
   sudo apt-get update && sudo apt-get install -y certbot
   ```
3. Temporarily stop the web container to free port 80:
   ```bash
   ./autoscript.sh stop
   ```
4. Generate the certificates:
   ```bash
   sudo certbot certonly --standalone -d bestjodi.net -d www.bestjodi.net
   ```
5. Copy the certificates into the project's `./ssl` directory:
   ```bash
   mkdir -p ssl
   sudo cp /etc/letsencrypt/live/bestjodi.net/fullchain.pem ssl/cert.pem
   sudo cp /etc/letsencrypt/live/bestjodi.net/privkey.pem ssl/key.pem
   ```
6. Start the stack with the production profile:
   ```bash
   docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d
   ```

---

## 7. Automated Backups & Disaster Recovery

### Manual Backup:
```bash
./autoscript.sh backup
```
This produces a consolidated archive in `backups/bestjodi_full_backup_YYYYMMDD_HHMMSS.tar.gz` containing:
- Compressed MySQL database dump (`database_bestjodi_YYYYMMDD_HHMMSS.sql.gz`)
- Compressed user uploads (`uploads_YYYYMMDD_HHMMSS.tar.gz`)

### Restoring from a Backup:
```bash
./autoscript.sh restore backups/bestjodi_full_backup_20260901_080000.tar.gz
```

### Scheduled Automatic Backups:
The VPS deploy script automatically sets up a daily cron job at 2:00 AM. To view or edit it:
```bash
crontab -e
```
Example cron line:
```cron
0 2 * * * cd /var/www/bestjodi && /bin/bash scripts/backup.sh >> backups/backup.log 2>&1
```

---

## 8. Tanglish Quick Guide (தமிழ் குறிப்பு)

### 📌 Project-ஐ Run பண்ணுவது எப்படி?

1. **Mac / Local System-ல்:**
   - Docker Desktop open பண்ணிக்கோங்க.
   - Terminal-ல் இந்த command-ஐ run பண்ணுங்க:
     ```bash
     ./autoscript.sh start
     ```
   - Menu மூலமா select பண்ண:
     ```bash
     ./autoscript.sh menu
     ```

2. **Linux VPS / Cloud Server-ல் (1-Click Deployment):**
   - Server-ல் இந்த command-ஐ run பண்ணா போதும் (Docker, Firewall, Database, Perms எல்லாமே auto-வா configure ஆகிடும்):
     ```bash
     sudo bash scripts/deploy_vps.sh
     ```

3. **Backup எடுக்க:**
   ```bash
   ./autoscript.sh backup
   ```

4. **Photos / Uploads Permission Fix பண்ண:**
   ```bash
   ./autoscript.sh fix-perms
   ```

5. **Admin Login:**
   - URL: `http://localhost:8080/admin`
   - User: `admin1`
   - Password: `admin1`
