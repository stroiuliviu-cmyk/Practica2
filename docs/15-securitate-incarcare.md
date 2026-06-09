# 15. Securitate și testare la încărcare (AS22–AS23)

> **Activități curriculare:**
> - AS22 — Testarea site-lui web prin efectuarea testelor de securitate și integritate a datelor
> - AS23 — Testarea site-lui web folosind testele la încărcare, testele la solicitări și testarea continuă
>
> **Date conform calendarului:** 06–08.06.2026

## 15.1. AS22 — Securitate și integritate

### 15.1.1. Vectori de atac analizați

Conform [OWASP Top 10](https://owasp.org/Top10/), am verificat:

| # | Vector OWASP | Protecție implementată | Test asociat |
|---|---|---|---|
| A01 | Broken Access Control | Middleware `auth` + `admin` pe `/admin/*` | `editor-ul este blocat de rute admin cu HTTP 403` |
| A02 | Cryptographic Failures | bcrypt pe parole (cast nativ Laravel) | `parolele sunt hash-uite cu bcrypt` |
| A03 | Injection (SQL) | Eloquent ORM (prepared statements) | `căutarea cu payload SQL nu produce eroare` |
| A03 | Injection (XSS) | Blade escape `{{ }}` automat | `Blade escapează HTML din datele afișate` |
| A05 | Security Misconfiguration | `APP_DEBUG=false` în producție, `.env` în `.gitignore` | manual |
| A07 | Authentication Failures | Session regenerate post-login, rate limit | `respinge parola greșită` |
| A08 | Software & Data Integrity | Composer + npm cu lock files | manual |

### 15.1.2. CSRF (Cross-Site Request Forgery)

Toate rutele POST/PUT/PATCH/DELETE includ token CSRF generat automat de Laravel. Token-ul se inserează prin directiva `@csrf` în formulare și se verifică automat de middleware-ul `VerifyCsrfToken` (activ default pe toate rutele web).

**Test:**

```php
it('formularul de contact include token CSRF', function () {
    $html = $this->get(route('contacte.index'))->getContent();
    expect($html)->toContain('name="_token"');
});
```

### 15.1.3. XSS (Cross-Site Scripting)

Toate variabilele afișate cu `{{ $variabila }}` în Blade sunt automat escape-uite cu `htmlspecialchars`. Singura modalitate de a afișa HTML brut este `{!! $variabila !!}` — care **nu** este folosit nicăieri în acest proiect.

**Test:**

```php
$cat = Categorie::create([
    'denumire' => '<script>alert("XSS")</script>',
    // ...
]);

$html = $this->get(route('servicii.show', $cat->slug))->getContent();
expect($html)
    ->not->toContain('<script>alert("XSS")</script>')
    ->toContain('&lt;script&gt;');
```

### 15.1.4. SQL Injection

Toate query-urile folosesc Eloquent ORM sau Query Builder, care folosesc **prepared statements** automat. Nicăieri în cod nu există `DB::raw()` cu user input interpolat.

**Exemple sigure:**

```php
// Sigure (parametrizate)
Produs::where('denumire', 'like', "%{$q}%")->get();
Categorie::where('slug', $slug)->firstOrFail();
```

**Test:**

```php
$payload = "' OR '1'='1";
$response = $this->get('/cautare?q=' . urlencode($payload));
$response->assertStatus(200);
// Nu returnează TOATE produsele (ar însemna injection reușit)
```

### 15.1.5. Authentication & Session

- **bcrypt** cu cost factor 12 (default Laravel) pentru parole;
- **Session ID** regenerat la login pentru prevenirea session fixation;
- **Session token** invalidat la logout;
- **Remember me** token-uri în cookie HttpOnly, criptate;
- **Rate limiting** — 60 cereri/minut default pe rutele de login (configurabil).

### 15.1.6. Mass Assignment

Modelele Eloquent definesc explicit `$fillable` cu lista coloanelor permise pentru `create()` și `update()`. Aceasta previne ca un atacator să injecteze coloane neașteptate (ex: `is_admin=1`) printr-un formular.

```php
// app/Models/User.php
protected $fillable = ['name', 'email', 'password', 'rol'];
```

Coloanele care **nu** sunt în fillable (ex: `created_at`, `id`) nu pot fi setate prin mass-assignment.

### 15.1.7. Headers de securitate HTTP

Configurate în [`deploy/nginx-server.conf`](../deploy/nginx-server.conf) și [`deploy/apache-vhost.conf`](../deploy/apache-vhost.conf):

```
X-Content-Type-Options: nosniff
X-Frame-Options: SAMEORIGIN
Referrer-Policy: strict-origin-when-cross-origin
Strict-Transport-Security: max-age=31536000; includeSubDomains
```

### 15.1.8. Producție vs Development

În `.env.production.example`:

```
APP_DEBUG=false           # Niciodată true în producție!
APP_ENV=production
SESSION_ENCRYPT=true      # Criptează datele de sesiune
SESSION_SECURE_COOKIE=true # Cookie-uri doar pe HTTPS
SESSION_HTTP_ONLY=true    # JS nu poate citi cookie-ul
SESSION_SAME_SITE=lax     # Protecție CSRF la nivel browser
```

### 15.1.9. Integritate date

| Mecanism | Beneficiu |
|---|---|
| Foreign keys CASCADE | Ștergerea categorie → ștergere produse asociate |
| UNIQUE constraint pe `users.email` și `newsletter_subscribers.email` | Previne duplicate |
| `slug` UNIQUE pe `categorii` | Garantează URL-uri stabile |
| Transactions implicite Eloquent | Atomicitate la create/update |
| Validări server-side pe toate formularele | Garantează format corect |

## 15.2. AS23 — Testare la încărcare

### 15.2.1. Tehnici de optimizare aplicate

#### Cache navbar (categorii)

Categoriile pentru dropdown-ul navbar sunt cache-uite 1 oră în `Cache::remember('navbar.categorii', ...)`. La fiecare modificare a unei categorii, cache-ul este invalidat automat prin observator pe modelul `Categorie`.

```php
// app/Providers/AppServiceProvider.php
$categoriiNavbar = Cache::remember(
    'navbar.categorii',
    now()->addHour(),
    fn () => Categorie::where('activ', true)->orderBy('ordine_afisare')->get()
);

Categorie::saved(fn () => Cache::forget('navbar.categorii'));
Categorie::deleted(fn () => Cache::forget('navbar.categorii'));
```

Impact: economisește 1 query la fiecare pagină (pentru un site cu 1000 vizitatori/zi → 1000 query-uri economisite).

#### Eager loading

Pe paginile cu liste, folosim `with()` pentru a evita N+1 queries:

```php
// Galerie cu categoria asociată — 1 query în loc de N+1
Galerie::with('categorie')->get();
```

#### Asset compression

`npm run build` produce:
- CSS: **321 KB** brut → **48 KB gzipped** (85% reducere)
- JS:  **84 KB** brut → **25 KB gzipped** (70% reducere)

În producție, Nginx/Apache servesc cu `Content-Encoding: gzip` automat.

#### Cache-Control headers

Configurat în deploy:

```
location ~* \.(css|js|jpg|jpeg|png|svg|webp|woff2?)$ {
    expires 30d;
    add_header Cache-Control "public, immutable";
}
```

Browser-ul cache-uiește asset-urile 30 de zile. Hash-ul în nume (`app-CnPJqPOj.css`) garantează invalidare la deploy nou.

#### Laravel optimization commands

Înainte de deploy se rulează:

```bash
php artisan config:cache    # config arrays cached
php artisan route:cache     # routing compiled
php artisan view:cache      # Blade pre-compiled
php artisan event:cache     # event listeners cached
```

Acestea îmbunătățesc performanța cu ~30-50% în producție.

### 15.2.2. Tooluri recomandate pentru load testing

Pentru testarea reală a încărcării (recomandat de făcut după AS26 — deploy):

| Tool | Folosire | Comandă |
|---|---|---|
| **wrk** | benchmark HTTP simplu | `wrk -t4 -c100 -d30s https://infinity.md/` |
| **Apache Bench** | requests/sec | `ab -n 1000 -c 100 https://infinity.md/` |
| **k6** | scenarii complexe | `k6 run load-test.js` |
| **JMeter** | UI vizuală | jmeter |

### 15.2.3. Baseline așteptat (server modest)

Pentru un server cu **2 CPU + 4 GB RAM** și un setup adecvat (PHP-FPM + Nginx + Redis):

| Tip cerere | Throughput așteptat | Latență P95 |
|---|---|---|
| Static asset (CSS/JS din cache) | 5000+ req/s | < 10ms |
| Pagină dinamică cache navbar | 200-400 req/s | < 100ms |
| Submit formular contact | 80-150 req/s | < 250ms |

### 15.2.4. Testare continuă

Recomandat pe CI (GitHub Actions / GitLab CI) la fiecare push:

```yaml
# .github/workflows/test.yml (de creat manual)
name: Tests
on: [push, pull_request]
jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with: { php-version: '8.2' }
      - run: composer install
      - run: cp .env.example .env
      - run: php artisan key:generate
      - run: ./vendor/bin/pest
```

Astfel, fiecare commit este validat automat — niciun cod nu ajunge în producție fără să treacă cele **71 de teste**.
