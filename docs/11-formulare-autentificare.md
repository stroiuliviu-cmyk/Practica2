# 11. Formulare dinamice și autentificare (AS14-AS15)

> **Activități curriculare:**
> - AS14 — Compunerea elementelor dinamice pentru asigurarea interacțiunii cu utilizatorul
> - AS15 — Integrarea elementelor ce presupun autentificarea utilizatorilor
>
> **Date conform calendarului:** 19.05.2026 și 20.05.2026

## 11.1. Formulare dinamice (AS14)

### 11.1.1. Formular de contact (deja livrat la AS10)

Formularul de pe `/contacte` (POST → `ContacteController@store`) validează:

- `nume` — required, min 2, max 150 caractere
- `email` — required, format email valid, max 150 caractere
- `telefon` — opțional, max 30 caractere
- `subiect` — required, dropdown cu 5 opțiuni
- `mesaj` — required, min 10 caractere

Validările se aplică **dublu** (client + server):
- **client-side** prin atribute HTML5 (`required`, `minlength`, `type="email"`) + JavaScript custom în [`app.js`](../resources/js/app.js);
- **server-side** prin `$request->validate(...)` în controller, cu mesaje de eroare în română.

Mesajele se salvează în tabela `mesaje_contact` și se afișează în panoul admin (vezi AS17).

### 11.1.2. Formular de căutare în navbar (AS14)

Un formular GET cu un singur câmp (`name="q"`) integrat în navbar. Validări:

- minim 2 caractere (HTML5 `minlength="2" required`);
- maxim 50 rezultate returnate (limita server-side din [`ServiciuController@search`](../app/Http/Controllers/ServiciuController.php));
- caută în coloanele `denumire` și `descriere` prin LIKE.

### 11.1.3. Formular sortare produse (AS14)

Pe `/servicii/{slug}` există un `<select>` cu 4 opțiuni de sortare. La schimbarea valorii, formularul se trimite automat prin `onchange="this.form.submit()"` — comportament dinamic fără AJAX, dar care simulează interacțiunea modernă.

### 11.1.4. Formular newsletter (nou)

În footer, pe toate paginile, există un formular pentru abonarea la newsletter:

- câmp unic: `email` (required, format email);
- buton cu iconiță `bi-send`;
- POST către ruta `/newsletter` → `NewsletterController@subscribe`.

Comportament:

- dacă email-ul este nou → salvează în `newsletter_subscribers` și afișează mesaj „Mulțumim pentru abonare!";
- dacă email-ul există deja → mesaj „Ești deja abonat la newsletter. Mulțumim!";
- dacă email-ul este invalid → eroare validare afișată sub formular.

Tabel nou creat: `newsletter_subscribers`

| Coloană | Tip | Constrângeri |
|---|---|---|
| `id` | BIGINT | PK |
| `email` | VARCHAR(150) | UNIQUE, NOT NULL |
| `activ` | BOOLEAN | DEFAULT TRUE |
| `confirmat_la` | TIMESTAMP | NULLABLE |
| timestamps | | Automat |

Constrângerea UNIQUE pe `email` previne duplicate la nivel de bază de date.

### 11.1.5. Filtre dinamice galerie (AS14)

Pe `/galerie`, butoanele de filtrare după categorie folosesc query string (`?categorie={slug}`). La click pe alt filtru, link-ul activ este evidențiat cu clasa `btn-primary`, restul fiind `btn-outline-primary`. Comportament 100% server-side, fără JavaScript.

### 11.1.6. Lightbox galerie cu modal Bootstrap (AS14)

La click pe o imagine din galerie, se deschide un modal Bootstrap care primește dinamic conținutul prin `data-*` attributes (`data-image`, `data-title`, `data-description`, `data-categorie`). Logica este în [`app.js`](../resources/js/app.js):

```javascript
lightboxModal.addEventListener('show.bs.modal', (event) => {
    const trigger = event.relatedTarget;
    imgEl.src = trigger.dataset.image;
    titleEl.textContent = trigger.dataset.title;
    // ...
});
```

## 11.2. Autentificare utilizatori (AS15)

### 11.2.1. Strategia aleasă

Pentru această etapă a stagiului de practică, s-a optat pentru **autentificare doar pentru administratori** (nu pentru clienții finali ai site-ului). Justificare:

- site-ul este de prezentare cu catalog, nu de e-commerce → utilizatorii publici nu au nevoie de cont;
- comenzile se finalizează prin contact telefonic sau formular contact, nu prin coș;
- accesul autentificat este necesar pentru actualizarea catalogului (categorii, produse, galerie) și citirea mesajelor de contact — toate operațiuni administrative.

### 11.2.2. Tabela `users` extinsă

Tabela `users` (creată default de Laravel) a fost extinsă cu coloana `rol` (enum) prin migrate-ul `add_rol_to_users_table.php`:

```php
$table->enum('rol', ['admin', 'editor'])
    ->default('editor')
    ->after('password');
```

Roluri disponibile:
- **admin** — acces complet la panoul administrativ;
- **editor** — rol rezervat pentru o etapă viitoare (drepturi limitate, ex: doar adăugare produse fără ștergere).

În etapa curentă, doar rolul `admin` are acces la `/admin`.

### 11.2.3. Helper-ul `isAdmin()` pe model User

Modelul [`User`](../app/Models/User.php) include metoda:

```php
public function isAdmin(): bool
{
    return $this->rol === 'admin';
}
```

Folosită în:
- middleware-ul `EnsureUserIsAdmin`;
- controller-ul `LoginController` (verificare post-login);
- view-uri Blade pentru afișarea condiționată a butonului „Admin" în navbar.

### 11.2.4. Controller-ul `LoginController`

[`App\Http\Controllers\Auth\LoginController`](../app/Http/Controllers/Auth/LoginController.php) expune trei acțiuni:

| Metodă | Rută | Rol |
|---|---|---|
| `show()` | `GET /login` | Afișează formularul |
| `login(Request)` | `POST /login` | Procesează credențialele |
| `logout(Request)` | `POST /logout` | Distruge sesiunea |

Logica `login()`:

1. validează `email` (required, email valid) și `password` (required, string);
2. încearcă autentificare cu `Auth::attempt($credentials, $remember)`;
3. dacă reușește → regenerează sesiunea (protecție session fixation);
4. dacă utilizatorul **nu** are rol `admin` → logout imediat + redirect cu eroare;
5. dacă utilizatorul este admin → redirect la `/admin` (intended URL);
6. dacă login eșuează → înapoi la formular cu erori, păstrând email-ul completat.

### 11.2.5. Middleware-ul `EnsureUserIsAdmin`

[`App\Http\Middleware\EnsureUserIsAdmin`](../app/Http/Middleware/EnsureUserIsAdmin.php) verifică:

1. dacă utilizatorul este autentificat → dacă nu, redirect la `/login`;
2. dacă utilizatorul are rol admin → dacă nu, abort cu HTTP 403.

Înregistrat ca alias `admin` în [`bootstrap/app.php`](../bootstrap/app.php):

```php
$middleware->alias([
    'admin' => EnsureUserIsAdmin::class,
]);
```

Folosit în `routes/web.php`:

```php
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // ... toate rutele admin
});
```

Cele două middleware-uri lucrează împreună:
- `auth` (built-in Laravel) → verifică doar dacă există un user logat;
- `admin` (custom) → verifică în plus că user-ul este admin.

### 11.2.6. View-ul de login

Pagina `/login` ([`resources/views/auth/login.blade.php`](../resources/views/auth/login.blade.php)) folosește același layout `layouts.app` ca site-ul public (cu navbar/footer ascuns vizual, dar prezent). Conține:

- iconă mare „shield-lock";
- titlu + subtitlu de avertizare;
- câmpuri email + parolă (cu autocomplete corect: `username` și `current-password`);
- checkbox „Ține-mă minte";
- afișare erori de validare prin `@error('email')`;
- info credențiale demo în partea de jos (pentru evaluare).

### 11.2.7. Credențiale demo

Seederul [`AdminUserSeeder`](../database/seeders/AdminUserSeeder.php) creează 2 utilizatori pentru testare:

| Email | Parolă | Rol |
|---|---|---|
| `admin@infinity.local` | `admin1234` | admin (acces complet) |
| `editor@infinity.local` | `editor1234` | editor (nu poate accesa /admin în etapa curentă) |

> **Atenție:** aceste credențiale sunt strict pentru demonstrația de practică. La publicarea pe hosting (AS26), parolele trebuie schimbate cu valori complexe.

### 11.2.8. Securitate

Mecanisme aplicate:

- **CSRF** — token automat în toate formularele POST (`@csrf`);
- **password hashing** — bcrypt prin cast-ul nativ Laravel `'password' => 'hashed'`;
- **session fixation** — regenerare sesiune după login;
- **session invalidation** — `session()->invalidate()` la logout;
- **rate limiting** — Laravel aplică default 60 cereri/minut per IP pe rutele POST;
- **HTTPS recomandat** — în producție, sesiunile trebuie marcate `secure` în config.

## 11.3. Verificare

### Flux login admin

1. Accesează `/admin` (fără sesiune) → redirect la `/login`;
2. Completează `admin@infinity.local` / `admin1234` → click „Autentifică-te";
3. Redirect la `/admin` (dashboard);
4. Click „Ieșire" → redirect la `/` (logout, sesiune invalidată).

### Flux acces refuzat pentru editor

1. Login cu `editor@infinity.local` / `editor1234`;
2. Sistemul detectează lipsa rolului admin → logout automat;
3. Redirect la `/login` cu mesaj „Contul tău nu are permisiuni de administrator".

### Verificări automate

| Comandă | Rezultat așteptat |
|---|---|
| `curl -I /admin` (fără sesiune) | HTTP 302 → /login |
| `curl -I /admin` (cu sesiune admin) | HTTP 200 |
| `curl POST /newsletter -d "email=test@x.com"` | HTTP 302 + rând nou în DB |
| Tabel `newsletter_subscribers` după 2 încercări cu același email | 1 singur rând (UNIQUE constraint) |
