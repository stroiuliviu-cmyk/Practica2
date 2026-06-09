# 16. Mentenanță + tehnologii noi (AS24–AS25)

> **Activități curriculare:**
> - AS24 — Mentenanța site-ului web
> - AS25 — Actualizarea site-ului prin adăugarea de noi tehnologii la structura deja creată
>
> **Date conform calendarului:** 09–12.06.2026

## 16.1. AS24 — Mentenanță

### 16.1.1. Pagini de eroare custom

Înlocuiesc paginile default Laravel cu versiuni branded Infinity:

| Cod | View | Mesaj |
|---|---|---|
| 403 | [`errors/403.blade.php`](../resources/views/errors/403.blade.php) | „Acces interzis" |
| 404 | [`errors/404.blade.php`](../resources/views/errors/404.blade.php) | „Pagină negăsită" |
| 500 | [`errors/500.blade.php`](../resources/views/errors/500.blade.php) | „Eroare server" |
| 503 | [`errors/503.blade.php`](../resources/views/errors/503.blade.php) | „Site în mentenanță" |

Toate folosesc layout-ul comun `errors/layout.blade.php` cu:
- număr eroare mare, vizibil;
- titlu + descriere în română;
- 3 butoane de navigare: Acasă, Servicii, Contactează-ne;
- același logo, navbar, footer ca restul site-ului.

**Test rapid:**

```
http://127.0.0.1:8000/orice-pagina-inexistenta → 404 custom
http://127.0.0.1:8000/admin (fără login) → 403 (după login editor)
```

### 16.1.2. Maintenance mode

Laravel oferă un mecanism nativ de maintenance:

```bash
# Activează (toți utilizatorii văd 503)
php artisan down --render="errors::503" --secret="bypass-key"

# Bypass pentru admin (cu cookie special)
https://infinity.md/bypass-key

# Dezactivează
php artisan up
```

Folosit în [`deploy/deploy.sh`](../deploy/deploy.sh) automat în timpul deploy-ului.

### 16.1.3. Logs

În producție (`LOG_CHANNEL=daily`), Laravel salvează un fișier separat per zi în `storage/logs/laravel-2026-06-09.log`. Rotire automată după 14 zile (configurabil în `config/logging.php`).

Pentru monitorizare în producție, recomandat:
- **Sentry** sau **Bugsnag** pentru error tracking;
- **Laravel Telescope** pentru debugging local;
- **Pulse** pentru metrici performanță.

### 16.1.4. Backup-uri

Recomandat în producție (de configurat manual pe server):

```bash
# Backup zilnic DB la 03:00
0 3 * * * mysqldump infinity_production | gzip > /backups/db-$(date +\%F).sql.gz

# Păstrează doar ultimele 14 zile
0 4 * * * find /backups -name "db-*.sql.gz" -mtime +14 -delete
```

Pachet recomandat: `spatie/laravel-backup` (de instalat la AS25).

### 16.1.5. Monitorizare uptime

Endpoint nativ pentru health check:

```
GET /up   →   HTTP 200 OK (configurat default în bootstrap/app.php)
```

Poate fi monitorizat extern cu:
- **UptimeRobot** (gratuit, verifică la fiecare 5 min);
- **Better Stack**;
- **Pingdom**.

## 16.2. AS25 — Tehnologii noi adăugate

### 16.2.1. SEO complet (Open Graph + Twitter + JSON-LD)

În [`resources/views/layouts/app.blade.php`](../resources/views/layouts/app.blade.php) am adăugat:

#### Open Graph (Facebook, LinkedIn)

```html
<meta property="og:type" content="website">
<meta property="og:site_name" content="Infinity SRL">
<meta property="og:locale" content="ro_RO">
<meta property="og:title" content="@yield('title') — Imprimare personalizată Chișinău">
<meta property="og:description" content="@yield('description')">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('img/logo.svg') }}">
```

Beneficiu: când utilizatorii share-uiesc o pagină Infinity pe Facebook, apare un preview cu titlu + descriere + logo.

#### Twitter Card

```html
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="...">
<meta name="twitter:description" content="...">
```

#### Canonical URL

```html
<link rel="canonical" href="{{ url()->current() }}">
```

Previne probleme de „duplicate content" pentru SEO (când aceeași pagină e accesibilă pe mai multe URL-uri).

#### JSON-LD structured data

```html
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "Infinity SRL",
    "url": "https://infinity.md",
    "telephone": "+373 22 123 456",
    "address": { ... },
    "openingHoursSpecification": [ ... ]
}
</script>
```

Beneficiu: Google afișează „business card" cu informații despre firmă direct în SERP (Search Engine Results Page).

### 16.2.2. Sitemap.xml dinamic

Generat de `SitemapController@index`, accesibil la `/sitemap.xml`:

- include cele 6 pagini publice statice (home, despre, servicii, galerie, contacte, login);
- adaugă dinamic toate categoriile active din DB;
- specifică `<priority>` și `<changefreq>` per URL;
- `<lastmod>` din `updated_at` pentru categorii.

**Verificare:**

```
curl http://127.0.0.1:8000/sitemap.xml
```

Submit-ul în Google Search Console se face la `https://infinity.md/sitemap.xml`.

### 16.2.3. Robots.txt dinamic

Generat de `SitemapController@robots`:

```
User-agent: *
Allow: /
Disallow: /admin
Disallow: /admin/*
Disallow: /login
Disallow: /logout

Sitemap: http://127.0.0.1:8000/sitemap.xml
```

Beneficiu: motoarele de căutare nu indexează zona admin sau pagini de autentificare.

### 16.2.4. Favicon SVG

```html
<link rel="icon" type="image/svg+xml" href="{{ asset('img/logo.svg') }}">
```

Browserele moderne folosesc SVG-ul direct (mai mic + scalabil), iar cele vechi fac fallback la favicon.ico generat automat de browser.

### 16.2.5. Theme color (PWA-ready)

```html
<meta name="theme-color" content="#008DD2">
```

Pe Android/Chrome, bara de adrese se colorează cu albastrul Infinity când utilizatorul deschide site-ul.

### 16.2.6. Cache strategy (perf + scalare)

| Layer | Mecanism | Durată |
|---|---|---|
| Database queries | `Cache::remember('navbar.categorii')` | 1 oră |
| Compiled Blade | `view:cache` | până la deploy nou |
| Compiled routes | `route:cache` | până la deploy nou |
| Static assets | Cache-Control 30 zile | până la URL change (hash în nume) |
| HTML răspuns | OPNcache PHP | per request lifecycle |

### 16.2.7. Suite de teste automate (AS25 — tehnologie de „testare continuă")

Pest 3 instalat cu **71 teste** acoperind toate fluxurile. Considerată „tehnologie nouă" pentru proiect: a fost adăugată în săptămâna 5, pe lângă codul deja existent.

### 16.2.8. Deploy automatizat (script reproductibil)

Script-ul [`deploy/deploy.sh`](../deploy/deploy.sh) automatizează:
1. activare maintenance mode;
2. pull cod;
3. install dependencies optimizate;
4. migrate DB;
5. build assets;
6. cache config/routes/views;
7. permisiuni corecte;
8. dezactivare maintenance.

Reduce timpul de deploy de la ~15 min manuale la <2 min automat.

## 16.3. Roadmap continuare (după săptămâna 6)

Tehnologii care pot fi adăugate ulterior:

- **Image upload în admin** — drag&drop cu validare dimensiuni;
- **Queue (Redis) pentru email** — trimitere asincron;
- **Search avansat (Meilisearch / Algolia)** — full-text rapid;
- **Multilingv (i18n)** — ru, ro, en (Laravel localization);
- **PWA** — service worker + manifest pentru install pe mobil;
- **Notificări browser** la mesaj nou de contact (admin);
- **Statistici vizuale (Charts.js)** în dashboard admin.
