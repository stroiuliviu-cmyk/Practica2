# 17. Publicarea site-ului (AS26)

> **Activitate curriculară:** AS26 — Publicarea site-ului
> **Date conform calendarului:** 15.06.2026

## 17.1. Opțiuni de hosting

Pentru un proiect Laravel modest (catalog dinamic, ~1000 vizitatori/zi), recomandate sunt:

| Provider | Cost lunar | Avantaje | Dezavantaje |
|---|---|---|---|
| **Cloudways** (Vultr/DigitalOcean) | ~$14 | UI prietenos, backup automat, SSL gratuit | Vendor lock-in |
| **DigitalOcean droplet** | ~$6 | Full control, ieftin | Necesită cunoștințe Linux |
| **Hetzner CX11** | ~€4 | Cel mai ieftin EU, performant | German UI |
| **Railway / Render** | $5–10 | Deploy din Git, zero config | Limite plan free |
| **Forge + DigitalOcean** | ~$12 ($12 Forge + $6 droplet) | Optimizat Laravel | Cost dublu |

Pentru proiect de practică / portfolio, recomandare: **DigitalOcean droplet + Laravel Forge** sau **Railway** (cel mai simplu).

## 17.2. Cerințe sistem

| Componentă | Versiune minimă | Recomandat |
|---|---|---|
| OS | Ubuntu 22.04 LTS | Ubuntu 24.04 LTS |
| PHP | 8.2 | 8.3 |
| MySQL / MariaDB | 8.0 / 10.6 | 8.0 |
| Web server | Nginx / Apache | Nginx |
| Node.js | 18 | 20 LTS |
| RAM | 1 GB | 2 GB |
| Disk | 10 GB SSD | 20 GB SSD |
| Bandwidth | 500 GB/lună | unlimited |

## 17.3. Pași de deploy

### 17.3.1. Pregătire server

```bash
# Pe server (Ubuntu)
sudo apt update && sudo apt upgrade -y
sudo apt install -y nginx mysql-server php8.2-fpm php8.2-mysql \
    php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip php8.2-gd \
    php8.2-intl php8.2-bcmath composer git unzip

# Node.js 20 (pentru npm run build)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

### 17.3.2. Bază de date

```bash
sudo mysql_secure_installation

sudo mysql <<SQL
CREATE DATABASE infinity_production CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'infinity_user'@'localhost' IDENTIFIED BY 'PAROLA_SECURIZATA';
GRANT ALL ON infinity_production.* TO 'infinity_user'@'localhost';
FLUSH PRIVILEGES;
SQL
```

### 17.3.3. Clone + setup proiect

```bash
sudo mkdir -p /var/www/infinity
sudo chown $USER:www-data /var/www/infinity
cd /var/www/infinity

git clone https://github.com/<user>/infinity.git .

composer install --no-dev --optimize-autoloader
npm ci --omit=dev
npm run build

cp .env.production.example .env
nano .env   # → configurează DB_PASSWORD, APP_URL, MAIL_*

php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=CategoriiSeeder --force
php artisan db:seed --class=ProduseSeeder --force
php artisan db:seed --class=GalerieSeeder --force
php artisan db:seed --class=AdminUserSeeder --force  # ATENȚIE: schimbă parola admin după!

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Permisiuni
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 755 storage bootstrap/cache
```

### 17.3.4. Nginx config

Copiază [`deploy/nginx-server.conf`](../deploy/nginx-server.conf):

```bash
sudo cp deploy/nginx-server.conf /etc/nginx/sites-available/infinity
sudo ln -s /etc/nginx/sites-available/infinity /etc/nginx/sites-enabled/
sudo nginx -t  # verifică sintaxa
sudo systemctl reload nginx
```

### 17.3.5. SSL gratuit (Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d infinity.md -d www.infinity.md
# Răspunde Y pentru redirect HTTP→HTTPS

# Verifică renewal automat
sudo certbot renew --dry-run
```

### 17.3.6. Verificare finală

| Test | Comandă | Rezultat așteptat |
|---|---|---|
| HTTP redirect | `curl -I http://infinity.md` | 301 → https |
| Homepage HTTPS | `curl -I https://infinity.md` | 200 |
| Headers securitate | `curl -I https://infinity.md \| grep -i strict` | `Strict-Transport-Security` prezent |
| Sitemap | `curl https://infinity.md/sitemap.xml` | XML cu rute |
| Robots | `curl https://infinity.md/robots.txt` | text/plain |
| 404 custom | `curl https://infinity.md/xyz` | HTML 404 branded |

## 17.4. După deploy — task-uri obligatorii

1. **Schimbă parolele admin** din DB (nu lăsa `admin1234`):
   ```bash
   php artisan tinker
   >>> $u = User::where('email', 'admin@infinity.local')->first();
   >>> $u->email = 'admin@infinity.md';
   >>> $u->password = Hash::make('PAROLA_NOUA_FORTE');
   >>> $u->save();
   ```

2. **Configurează SMTP real** (Mailgun / SendGrid / SES) pentru notificări.

3. **Submit sitemap în Google Search Console**: https://search.google.com/search-console

4. **Configurează backup automat** (cron job MySQL dump → S3 sau Hetzner Storage Box).

5. **Setează monitoring uptime** (UptimeRobot pe `/up`).

6. **Activează Cloudflare** (CDN + protection DDoS, gratuit).

7. **Configurează Google Analytics 4** sau **Plausible** (privacy-friendly).

## 17.5. Deploy continuu (CD)

După deploy inițial manual, viitoare deploy-uri pot fi automatizate:

```bash
# Pe server: clone deja existent
cd /var/www/infinity
bash deploy/deploy.sh
```

Scriptul face automat: pull → install → migrate → cache → restart.

### CI/CD cu GitHub Actions

Fișier `.github/workflows/deploy.yml`:

```yaml
name: Deploy to production
on:
  push:
    branches: [main]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Deploy via SSH
        uses: appleboy/ssh-action@v1
        with:
          host: infinity.md
          username: deploy
          key: ${{ secrets.SSH_KEY }}
          script: |
            cd /var/www/infinity
            bash deploy/deploy.sh
```

Astfel, fiecare push pe `main` → deploy automat în producție (după ce testele Pest trec).

## 17.6. Cost estimat anual

| Element | Cost an |
|---|---|
| Server VPS (DigitalOcean $6/mo) | $72 |
| Domeniu .md (~$30/an) | $30 |
| SSL Let's Encrypt | gratuit |
| Email transactional (Mailgun, 1000/mo) | gratuit |
| Backup (Hetzner Storage Box 100GB) | $36 |
| **TOTAL** | **~$138/an = ~2400 MDL/an** |

Foarte accesibil pentru o firmă mică ca Infinity SRL.
