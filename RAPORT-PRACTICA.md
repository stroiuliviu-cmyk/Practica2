<!--
================================================================================
INSTRUCȚIUNI DE CONVERTIRE ÎN WORD (după ce completezi placeholderele <...>):

1. Deschide acest fișier în Word (File → Open → schimbă filtrul la „All files").
   ALTERNATIV: în VS Code instalează extensia „Markdown PDF" sau folosește
   `pandoc RAPORT-PRACTICA.md -o raport.docx`.

2. Setări pagină (cerute de Curicula):
   - A4, margini: stânga 30mm, sus 20mm, jos 20mm, dreapta 10mm
   - Numerotare pagini: jos, centrat (Insert → Page Number → Bottom → Plain Number 2)

3. Stiluri (Format → Style):
   - Heading 1 (Titlu): Times New Roman, 14pt, Bold, Center
   - Heading 2 (Subtitlu): Times New Roman, 12pt, Bold, Left
   - Normal (Text): Times New Roman, 12pt, Justify, Line spacing 1.5
   - Code (Listing): Courier New, 10pt, Left, Line spacing 1.0

4. Cuprins automat (Insert → Table of Contents → Automatic Table 1) - se va popula
   automat din heading-urile pe care le marchezi.

5. Imagini (dacă adaugi screenshots ale site-ului):
   - Insert → Picture → centrează imaginea
   - Sub imagine: text centrat „Figura X. Descriere"

6. Bibliografie:
   - Folosește References → Insert Citation pentru fiecare sursă.

7. La final: salvează ca .docx și .pdf.
================================================================================
-->

---

**Ministerul Educației și Cercetării al Republicii Moldova**
**IP Colegiul „Iulia Hasdeu" din Cahul**
**Catedra TICEE**

# RAPORT

**Practica ce anticipează probele de absolvire**

**Specialitatea:** 61210 Administrarea aplicațiilor web

**Calificarea:** Tehnician de site-uri web

**Semestrul:** VIII

**Grupa:** AAW.2241

---

Efectuat: `<numele și prenumele elevului>`

Verificat: Bodlev Veaceslav, profesor de discipline TIC

Nota: __________

---

**Cahul, 2026**

\pagebreak

---

# Cuprins

<!-- În Word: Insert → Table of Contents → Automatic Table -->

1. Introducere
2. Descrierea unității economice
3. Conținutul activităților și sarcinilor de lucru
   3.1. Planul de dezvoltare a site-ului web
   3.2. Tehnologiile și instrumentele utilizate
   3.3. Planificarea site-ului web
   3.4. Designul paginilor site-ului web
   3.5. Codul sursă al aplicațiilor elaborate
   3.6. Testarea site-ului
   3.7. Publicarea site-ului
4. Observații personale
5. Concluzii
6. Bibliografie
7. Anexe

\pagebreak

# 1. Introducere

Prezentul raport descrie activitățile realizate pe parcursul stagiului de practică „Practica ce anticipează probele de absolvire" (codul P.08.O.004), desfășurat la unitatea economică **Infinity SRL** din Chișinău, în perioada **27.04.2026 – 19.06.2026** (8 săptămâni, 300 ore).

Stagiul a constat în dezvoltarea unei aplicații web complete pentru Infinity SRL, având ca model funcțional site-ul **fotomoments.md** — firmă moldovenească specializată în imprimare personalizată pe căni, tricouri, brelocuri și alte obiecte cadou. Aplicația acoperă toate cele 28 activități de stagiu (AS1–AS28) prevăzute în Curriculumul stagiului de practică, structurate în 5 etape mari:

1. **Planificarea site-ului Web** (AS1–AS6, 40 ore)
2. **Dezvoltarea site-ului Web** (AS7–AS17, 50 ore)
3. **Testarea site-ului Web** (AS18–AS23, 50 ore)
4. **Implementarea site-ului Web** (AS24–AS26, 30 ore)
5. **Perfectarea și susținerea raportului** (AS27–AS28, 22 ore)

Aplicația este dezvoltată folosind framework-ul **Laravel 12** (PHP 8.2), cu interfață Blade + **Bootstrap 5** pentru partea de prezentare, și **MySQL** (din XAMPP) ca sistem de gestiune a bazei de date. Codul sursă complet este versionat cu **Git** și publicat pe GitHub.

\pagebreak

# 2. Descrierea unității economice

## 2.1. Denumirea entității

- **Unitatea de practică:** Infinity SRL (Societate cu Răspundere Limitată)
- **Modelul real preluat ca exemplu:** FotoMoments — `https://www.fotomoments.md/`
- **Forma juridică:** SRL, conform legislației Republicii Moldova
- **Domeniul principal de activitate:** servicii de imprimare personalizată a fotografiilor, inscripțiilor și logo-urilor pe diverse obiecte de cadou și uz personal
- **Anul fondării modelului:** 2006
- **Localizarea:** Chișinău, Republica Moldova

## 2.2. Profilul de activitate

Infinity SRL este o firmă specializată în **imprimare personalizată pe suvenire și obiecte cadou**. Compania transformă fotografiile, inscripțiile sau logo-urile clienților în produse fizice unice. Tehnologia utilizată permite realizarea comenzilor pe loc, în 10–20 de minute, alături de capacitatea de a executa comenzi complexe pentru clienți corporate sau evenimente.

## 2.3. Servicii oferite (8 categorii)

1. **Căni personalizate** — ceramice albe, magice termoactive, bicolore, termice din inox
2. **Tricouri și maiouri** — bumbac 100%, polo, raglan, copii, damă fit
3. **Brelocuri** — metal, lemn, plexiglas, dreptunghi, inimă, rotund
4. **Perne personalizate** — decorative, călătorie tip C, copii, mari, rotunde
5. **Puzzle personalizate** — carton 60–500 piese, lemn
6. **Ceasuri personalizate** — perete rotund/pătrat, masă, digital, copii
7. **Farfurii personalizate** — ceramice Ø20–25cm, rectangulare, cu suport, set
8. **Tipar fotografii** — formate 10×15, 13×18, 15×20, A4, A3

## 2.4. Public țintă

- **Persoane fizice** care doresc cadouri personalizate (aniversări, sărbători)
- **Tineri și familii** căutând obiecte unice și emoționale
- **Companii și organizații** comandând produse promoționale
- **Organizatori de evenimente** (mărturii, materiale promoționale)

## 2.5. Avantaje competitive

1. Execuție rapidă pe loc (10–20 min pentru comenzi standard)
2. Experiență acumulată din 2006
3. Gamă largă (8 categorii) executate într-un singur atelier
4. Capacitate de procesare a comenzilor mari (corporate, evenimente)
5. Abordare individuală pentru fiecare client

\pagebreak

# 3. Conținutul activităților și sarcinilor de lucru

## 3.1. Planul de dezvoltare a site-ului web

Site-ul a fost dezvoltat pe parcursul a 6 săptămâni active de programare (săpt. 1–6 din curriculum), urmând un plan structurat în etape secvențiale, fiecare etapă livrând un produs intermediar verificabil. Detaliile complete sunt în fișierele [docs/01-unitatea-economica.md](docs/01-unitatea-economica.md) până la [docs/17-publicare.md](docs/17-publicare.md).

| Săptămâna | Date | Etapa | Activități |
|---|---|---|---|
| 1–2 | 27.04 – 11.05 | Planificare | AS1–AS10 |
| 3 | 14.05 – 22.05 | Dezvoltare faza 2 | AS11–AS17 |
| 4–5 | 25.05 – 08.06 | Testare | AS18–AS23 |
| 6 | 09.06 – 15.06 | Implementare | AS24–AS26 |
| 7–8 | 16.06 – 19.06 | Raport | AS27–AS28 |

## 3.2. Tehnologiile și instrumentele utilizate

### 3.2.1. Instrumente (mediul de lucru)

| Instrument | Versiune | Rol |
|---|---|---|
| Visual Studio Code | 1.x | Editor de cod |
| Git | 2.x | Versionare |
| GitHub | — | Hosting repository |
| Composer | 2.9 | Manager dependențe PHP |
| Node.js + npm | 24 / 11 | Runtime + pachete JS |
| Vite | 7.x | Bundler front-end |
| Laravel | 12.x | Framework PHP back-end |
| Bootstrap 5 | 5.3 | Framework CSS |
| Bootstrap Icons | 1.x | Set iconițe |
| Sass | 1.x | Preprocesor CSS |
| XAMPP | 8.x | Stack local (Apache + MySQL) |
| MySQL / MariaDB | 8 / 10 | Bază de date |
| phpMyAdmin | 5.x | Administrare BD |
| Pest 3 | 3.x | Testare automatizată |

### 3.2.2. Limbaje folosite

| Limbaj | Versiune | Folosit pentru |
|---|---|---|
| PHP | 8.2 | Logica server-side (Laravel, controllere, modele) |
| Blade | (Laravel 12) | Templating dinamic |
| HTML5 | — | Marcaje semantice |
| SCSS | (Sass 1.x) | Stilizare preprocesată |
| CSS3 | — | Stilizare finală |
| JavaScript ES6+ | — | Interactivitate client-side |
| SQL | (MySQL 8) | Interogări (prin Eloquent ORM) |

### 3.2.3. Argumentarea alegerii Laravel

Laravel este cel mai popular framework PHP modern și a fost ales pentru următoarele motive:

- **Structură MVC clară** — separare strictă model / view / controller, ușor de explicat;
- **ORM Eloquent** — manipularea bazei de date prin obiecte PHP, protecție automată împotriva SQL injection;
- **Migrate-uri reproductibile** — schema BD definită în cod PHP versionat, replicabilă cu o singură comandă;
- **Seedere** — date de test inserate automat (8 categorii + 48 produse + 12 lucrări galerie + 2 useri admin);
- **Sistem de rute curat** — rute nominate (`route('home')` în loc de URL-uri hardcoded);
- **Suport nativ autentificare** — folosit pentru panoul administrativ;
- **Validare puternică** — reguli declarative cu mesaje în română;
- **Comunitate mare și documentație excelentă** — laravel.com/docs + Laracasts.

### 3.2.4. Argumentarea alegerii Bootstrap 5 (nu Tailwind)

- Conform programei colegiului, la „Tehnologii web" se predă Bootstrap (Tailwind nu este în curriculum);
- Oferă componente gata făcute (navbar, modal, dropdown, breadcrumbs, alerte);
- Grila responsive `row` + `col-md-X` este intuitivă;
- Override prin SCSS pentru personalizare cu paleta brand (variabile Bootstrap).

## 3.3. Planificarea site-ului web

### 3.3.1. Obiectivul principal

Realizarea unui site web de prezentare modern, responsive și ușor de utilizat, care să promoveze serviciile de imprimare personalizată oferite de Infinity SRL, să afișeze dinamic catalogul de produse din baza de date și să faciliteze contactul clienților cu firma prin formular online și date complete de contact.

### 3.3.2. Obiective secundare (5)

1. Creșterea vizibilității online a firmei pe piața din Chișinău
2. Educarea publicului privind tipurile de obiecte personalizabile și procesul de comandă
3. Captarea cererilor de ofertă prin formularul de contact
4. Reducerea apelurilor repetitive cu întrebări frecvente
5. Pregătirea infrastructurii pentru extindere (autentificare, panou admin, comenzi)

### 3.3.3. Cerințe funcționale (8 cerințe formulate de client)

| # | Cerință funcțională |
|---|---|
| CF-01 | Pagina principală cu mesaj + grila celor 8 categorii |
| CF-02 | Pagină „Despre noi" (istoric, valori, echipă) |
| CF-03 | Pagină centralizatoare cu toate categoriile |
| CF-04 | Pagină detaliu per categorie cu produse + caracteristici + preț |
| CF-05 | Pagină contact cu date complete + formular |
| CF-06 | Formularul de contact cu validare client + server, salvare în BD |
| CF-07 | Toate datele afișate citite **dinamic din BD** (nu hardcoded) |
| CF-08 | Site complet responsive (mobil, tabletă, desktop) + WCAG AA |

### 3.3.4. Sitemap (structura paginilor)

```
Infinity SRL (Site)
│
├── /  (Acasă)                    → hero + carousel + 8 categorii + beneficii + proces + CTA
├── /despre                       → istoric, echipă (3 carduri), valori (3 carduri)
├── /servicii                     → grila celor 8 categorii
├── /servicii/{slug}              → detaliu categorie + 6 produse + cum se comandă
├── /cautare?q=...                → căutare în catalog
├── /galerie                      → lucrări realizate + filtre + lightbox
├── /contacte                     → date contact + formular + hartă placeholder
├── /login                        → autentificare admin
└── /admin/                       → panou admin protejat (CRUD)
    ├── /admin
    ├── /admin/categorii
    ├── /admin/produse
    ├── /admin/galerie
    ├── /admin/mesaje
    └── /admin/newsletter
```

### 3.3.5. Tipul site-ului ales

**Site de prezentare cu catalog dinamic** (fără e-commerce real).

**Justificare:** clientul prioritizează prezentarea profesională, nu vânzarea online directă. Comenzile se finalizează prin contact telefonic sau vizită la atelier, conform modelului fotomoments.md. Schema BD include tabelele `clienti` și `comenzi` pentru o viitoare extindere spre e-commerce.

### 3.3.6. Arhitectura bazei de date

Schemă **MySQL 8 normalizată (3NF)** cu 7 tabele principale + cele utilitare default ale Laravel. Tabelele sunt create prin **migrate-uri** (clase PHP versionate), nu prin SQL brut.

| Tabel | Coloane principale | Rol |
|---|---|---|
| `categorii` | slug (UQ), denumire, descriere, imagine, ordine, activ | Cele 8 categorii principale |
| `produse` | categorie_id (FK), denumire, descriere, pret_de_la, caracteristici (JSON), activ | Produsele specifice (48) |
| `clienti` | nume, prenume, telefon, email | Clienții (gol în această etapă) |
| `comenzi` | client_id (FK), produs_id (FK), cantitate, status (ENUM) | Comenzi (gol) |
| `mesaje_contact` | nume, email, telefon, subiect, mesaj, citit | Mesaje din formular |
| `newsletter_subscribers` | email (UQ), activ, confirmat_la | Abonați newsletter |
| `users` | name, email (UQ), password, rol (ENUM: admin/editor) | Useri panou admin |
| `galerie` | titlu, descriere, imagine, categorie_id (FK), ordine, activ | Lucrări realizate |

**Relații:**
- `categorii` → `produse` (1:N, CASCADE)
- `clienti` → `comenzi` (1:N)
- `produse` → `comenzi` (1:N)
- `categorii` → `galerie` (1:N, SET NULL)

## 3.4. Designul paginilor site-ului web

### 3.4.1. Branding

- **Logo:** SVG vectorial oficial al Infinity SRL (`public/img/logo.svg`)
- **Paleta brand:**
  - Primary: `#008DD2` (albastru Infinity)
  - Secondary: `#5B5B5D` (gri închis Infinity)
  - Body bg: `#f7f9fb`
- **Font:** Inter (Google Fonts), import în SCSS

### 3.4.2. SCSS organizat tematic

Fișierul `resources/sass/app.scss` are **~800 linii** structurate în 15+ secțiuni:

```
1. Google Fonts import
2. Override variabile Bootstrap (culori, font, border-radius)
3. Import Bootstrap complet
4. Import Bootstrap Icons
5. Stiluri custom:
   - navbar + brand
   - hero + CTA
   - butoane (hover transform, shadow)
   - carduri (servicii, produse, beneficii, valori, membri)
   - carousel hero
   - galerie (grilă + lightbox modal)
   - formular newsletter (fundal translucid)
   - panou admin (sidebar, stat cards, table)
   - back-to-top button
   - filter bar
   - animații scroll reveal (IntersectionObserver)
   - footer
   - responsive helpers
```

### 3.4.3. Componente UI dezvoltate

| Componentă | Element vizual |
|---|---|
| `.card-serviciu` | card cu imagine + denumire + descriere + buton, hover translateY(-6px) |
| `.card-beneficiu` | card cu icon-wrapper rotund + titlu + paragraf |
| `.card-produs` | card produs cu preț evidențiat |
| `.card-membru` / `.card-valoare` | carduri „Despre noi" cu avatar + rol |
| `.hero` | secțiune intro cu gradient liniar + cerc decorativ |
| `.hero-carousel` | Bootstrap carousel cu 4 sliduri auto-rotate |
| `.proces-pas` | pași numerotați (4 pași) |
| `.cta-banner` | banner cu telefon mare + buton |
| `.galerie-grid` | CSS Grid auto-fill cu lightbox modal |
| `.btn-back-to-top` | buton flotant apărut la scroll > 400px |
| `.admin-sidebar` | sidebar vertical pentru zona /admin |
| `.admin-stat-card` | carduri statistici dashboard |

### 3.4.4. Responsive design

Breakpoint-urile standard Bootstrap 5 sunt respectate:

| Breakpoint | Range | Comportament navbar | Grilă categorii |
|---|---|---|---|
| xs | < 576px | colapsat (☰) | 1 coloană |
| sm | 576–767 | colapsat | 1–2 coloane |
| md | 768–991 | colapsat | 2 coloane |
| lg | 992–1199 | orizontal complet | 3–4 coloane |
| xl | ≥ 1200 | orizontal complet | 4 coloane |

Testat manual la 375 / 768 / 1200 px — toate elementele se reorganizează corect.

### 3.4.5. Accesibilitate (WCAG 2.1 AA)

- `<html lang="ro">` declarat
- `alt=""` pe imagini decorative, descriptive pe imagini semnificative
- `aria-label`, `aria-current`, `aria-hidden` aplicate consistent
- Navigare completă cu tastatura (Tab, Enter, Esc)
- Focus vizibil (Bootstrap default + custom)
- Contrast text minim 4.5:1 (verificat cu WebAIM Contrast Checker)

## 3.5. Codul sursă al aplicațiilor elaborate

### 3.5.1. Structura proiectului Laravel

```
practica-2/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                          (panou admin)
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── CategorieController.php     (CRUD)
│   │   │   │   ├── ProdusController.php        (CRUD)
│   │   │   │   ├── GalerieController.php       (CRUD)
│   │   │   │   ├── MesajContactController.php  (read+delete)
│   │   │   │   └── NewsletterController.php    (read+delete)
│   │   │   ├── Auth/
│   │   │   │   └── LoginController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ServiciuController.php          (+ search, sort)
│   │   │   ├── GalerieController.php           (public + filtru)
│   │   │   ├── DespreController.php
│   │   │   ├── ContacteController.php          (+ store)
│   │   │   ├── NewsletterController.php        (+ subscribe)
│   │   │   └── SitemapController.php           (XML + robots)
│   │   └── Middleware/
│   │       └── EnsureUserIsAdmin.php
│   ├── Models/
│   │   ├── Categorie.php   (hasMany Produs)
│   │   ├── Produs.php      (belongsTo Categorie, cast JSON)
│   │   ├── Galerie.php
│   │   ├── MesajContact.php
│   │   ├── NewsletterSubscriber.php
│   │   └── User.php         (cu metoda isAdmin())
│   └── Providers/
│       └── AppServiceProvider.php   (View::composer + cache)
├── bootstrap/
│   └── app.php               (middleware alias 'admin')
├── database/
│   ├── migrations/           (8 migrate-uri custom)
│   ├── seeders/              (5 seedere)
│   └── factories/
├── deploy/                    (configuri publicare)
│   ├── apache-vhost.conf
│   ├── nginx-server.conf
│   └── deploy.sh
├── docs/                      (17 fișiere documentație .md)
├── public/
│   ├── build/                 (asset-uri Vite production)
│   ├── img/
│   │   ├── logo.svg
│   │   └── placeholders/      (58 SVG-uri)
│   └── index.php
├── resources/
│   ├── js/app.js             (~80 linii)
│   ├── sass/app.scss         (~800 linii)
│   └── views/
│       ├── admin/             (layout + 5 secțiuni)
│       ├── auth/login.blade.php
│       ├── errors/            (403, 404, 500, 503)
│       ├── layouts/app.blade.php
│       ├── partials/          (navbar, footer)
│       ├── servicii/          (index, show, search)
│       ├── home.blade.php
│       ├── despre.blade.php
│       ├── galerie.blade.php
│       ├── contacte.blade.php
│       └── sitemap.blade.php
├── routes/
│   └── web.php               (43 rute)
├── tests/
│   ├── Feature/               (6 fișiere, 49 teste)
│   ├── Unit/                  (1 fișier, 10 teste)
│   └── Pest.php
├── .env.example
├── .env.production.example
├── composer.json
├── package.json
├── vite.config.js
└── README.md
```

### 3.5.2. Rutele aplicației (43 total)

**Rute publice (10):**

| Metodă | URL | Controller@Metodă | Nume |
|---|---|---|---|
| GET | `/` | HomeController@index | home |
| GET | `/despre` | DespreController@index | despre |
| GET | `/servicii` | ServiciuController@index | servicii.index |
| GET | `/servicii/{slug}` | ServiciuController@show | servicii.show |
| GET | `/cautare` | ServiciuController@search | servicii.search |
| GET | `/galerie` | GalerieController@index | galerie.index |
| GET | `/contacte` | ContacteController@index | contacte.index |
| POST | `/contacte` | ContacteController@store | contacte.store |
| POST | `/newsletter` | NewsletterController@subscribe | newsletter.subscribe |
| GET | `/sitemap.xml` | SitemapController@index | sitemap |
| GET | `/robots.txt` | SitemapController@robots | robots |

**Rute autentificare (3):** `GET/POST /login`, `POST /logout`

**Rute admin (20):** resource CRUD pentru categorii, produse, galerie + listă/delete pentru mesaje și newsletter, toate protejate de middleware `[auth, admin]`.

### 3.5.3. Exemple de cod semnificative

**Controller cu validare (extras din `ContacteController.php`):**

```php
public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'nume'    => ['required', 'string', 'min:2', 'max:150'],
        'email'   => ['required', 'email', 'max:150'],
        'telefon' => ['nullable', 'string', 'max:30'],
        'subiect' => ['required', 'string', 'min:3', 'max:200'],
        'mesaj'   => ['required', 'string', 'min:10'],
    ], [
        'nume.required'    => 'Numele este obligatoriu.',
        'email.email'      => 'Adresa de email nu este validă.',
        'mesaj.min'        => 'Mesajul trebuie să aibă cel puțin :min caractere.',
    ]);

    MesajContact::create($validated);

    return redirect()
        ->route('contacte.index')
        ->with('success', 'Mesajul tău a fost trimis cu succes!');
}
```

**Model Eloquent cu relație (extras din `Categorie.php`):**

```php
class Categorie extends Model
{
    protected $table = 'categorii';

    protected $fillable = [
        'slug', 'denumire', 'descriere_scurta',
        'descriere_completa', 'imagine', 'ordine_afisare', 'activ',
    ];

    protected $casts = [
        'activ' => 'boolean',
        'ordine_afisare' => 'integer',
    ];

    public function produse(): HasMany
    {
        return $this->hasMany(Produs::class, 'categorie_id');
    }
}
```

**Middleware autentificare admin (`EnsureUserIsAdmin.php`):**

```php
public function handle(Request $request, Closure $next): Response
{
    if (! $request->user()) {
        return redirect()->route('login');
    }

    if (! $request->user()->isAdmin()) {
        abort(403, 'Accesul este permis doar administratorilor.');
    }

    return $next($request);
}
```

**Cache pentru categorii navbar (extras din `AppServiceProvider.php`):**

```php
View::composer(['partials.navbar', 'partials.footer'], function ($view) {
    $categoriiNavbar = Cache::remember(
        'navbar.categorii',
        now()->addHour(),
        fn () => Categorie::where('activ', true)
            ->orderBy('ordine_afisare')
            ->get(['id', 'slug', 'denumire'])
    );

    $view->with('categoriiNavbar', $categoriiNavbar);
});

Categorie::saved(fn () => Cache::forget('navbar.categorii'));
Categorie::deleted(fn () => Cache::forget('navbar.categorii'));
```

## 3.6. Testarea site-ului

### 3.6.1. Stack de testare

- **Pest 3** — framework de testare modern pentru PHP/Laravel
- **PHPUnit 11** — runner sub-iacent
- **SQLite in-memory** — bază de date efemeră, fără efect asupra DB-ului real
- **RefreshDatabase trait** — re-creează schema înainte de fiecare test

### 3.6.2. Acoperire

Total **69 teste pass + 1 risky** cu **175 aserțiuni**, durată rulare ~2 secunde.

| Fișier | Teste | Domeniu |
|---|---|---|
| `PublicRoutesTest.php` | 11 | Rute publice + 404 + redirect admin |
| `ContactFormTest.php` | 6 | Validare + persistență DB + CSRF |
| `NewsletterTest.php` | 4 | Subscribe + UNIQUE constraint |
| `AuthAndAdminTest.php` | 12 | Login + CRUD + role check |
| `SearchAndGalleryTest.php` | 7 | Căutare + filtrare galerie |
| `LinksAndNavigationTest.php` | 7 | Link integrity intern |
| `SecurityTest.php` | 14 | CSRF, XSS, SQL injection, auth |
| `Unit/ModelsTest.php` | 10 | Relații + casts + table names |

### 3.6.3. Categorii de teste

- **Funcționale (AS18-AS19):** verifică toate paginile răspund 200, validările funcționează, datele se salvează
- **Legături (AS20):** verifică linkurile interne (navbar, breadcrumbs, footer)
- **Accesibilitate (AS21):** verificată manual cu Lighthouse + NVDA screen reader
- **Securitate (AS22):** teste pentru CSRF, XSS escape, SQL injection prevention, auth boundaries, mass-assignment
- **Performanță (AS23):** cache strategic pentru categorii navbar (1h cu auto-invalidare)

### 3.6.4. Cum se rulează testele

```bash
./vendor/bin/pest                              # toate cele 70 de teste
./vendor/bin/pest tests/Feature/SecurityTest.php  # doar securitate
./vendor/bin/pest --filter="contact form"      # filtru text
./vendor/bin/pest --coverage                   # cu code coverage
```

### 3.6.5. Output exemplu

```
PASS  Tests\Feature\PublicRoutesTest
  ✓ it încarcă pagina principală cu status 200
  ✓ it afișează categoriile pe pagina principală
  ✓ ... (9 more)

PASS  Tests\Feature\ContactFormTest
  ✓ it respinge formularul gol cu erori de validare
  ✓ it salvează mesajul valid în baza de date
  ✓ ... (4 more)

Tests:    69 passed, 1 risky (175 assertions)
Duration: 2.03s
```

## 3.7. Publicarea site-ului

### 3.7.1. Pași de implementare pe hosting

Ghidul complet în [docs/17-publicare.md](docs/17-publicare.md). Pe scurt:

1. **Pregătire server Ubuntu 22.04+:** instalare PHP 8.2, MySQL, Nginx, Node.js
2. **Bază de date producție:** `CREATE DATABASE infinity_production`
3. **Clone repository:** `git clone … && composer install --no-dev --optimize-autoloader`
4. **Build production assets:** `npm ci --omit=dev && npm run build`
5. **Configurare `.env`:** copia `.env.production.example` și completare valori reale
6. **Migrate + seed:** `php artisan migrate --force && php artisan db:seed`
7. **Optimize:** `php artisan config:cache && route:cache && view:cache`
8. **Nginx config:** copierea `deploy/nginx-server.conf`
9. **SSL gratuit:** `sudo certbot --nginx -d infinity.md`
10. **Schimbare parole admin demo** + configurare SMTP real

### 3.7.2. Script automat de deploy

`deploy/deploy.sh` automatizează toți pașii cu maintenance mode + cache + restart.

### 3.7.3. Tehnologii noi adăugate (AS25)

- **sitemap.xml dinamic** generat din rute + categorii BD
- **robots.txt configurabil** (blochează /admin, /login)
- **Open Graph + Twitter Card** meta tags
- **JSON-LD LocalBusiness** structured data (Google business card)
- **Favicon SVG** scalabil
- **Cache Redis** pentru producție
- **Pagini eroare branded** (403, 404, 500, 503)
- **Headers securitate HTTP** (HSTS, X-Frame-Options, CSP)

\pagebreak

# 4. Observații personale

> **Notă:** secțiune completată personal de elev (5–10 paragrafe).

<observații personale despre experiența stagiului:>

- Cu ce dificultăți te-ai confruntat și cum le-ai depășit?
- Ce ai învățat nou (tehnologii, concepte, practici)?
- Cum ți s-a părut colaborarea cu conducătorul de practică?
- Ce activități ți s-au părut cele mai interesante?
- Ce ai face diferit dacă ai începe acum?
- Cum te-a ajutat acest stagiu pentru viitorul profesional?

<spațiu pentru text personal>

\pagebreak

# 5. Concluzii

> **Notă:** secțiune completată personal de elev (cel puțin 1 pagină).

Pe parcursul celor 8 săptămâni de stagiu de practică la Infinity SRL, am dezvoltat o aplicație web completă care îndeplinește toate cerințele Curriculumului P.08.O.004. Site-ul realizat acoperă întregul ciclu de viață al unei aplicații web profesionale — de la planificare și design, la dezvoltare, testare și publicare.

**Principalele realizări:**

1. Documentație completă în 17 fișiere care acoperă toate cele 28 activități curriculare (AS1–AS28);
2. Aplicație Laravel funcțională cu 43 rute, 12 controllere, 5 modele Eloquent și 8 tabele BD;
3. Panou administrativ cu CRUD complet pentru categorii, produse, galerie, mesaje și newsletter;
4. 69 teste automate Pest care validează funcționalitatea, securitatea și integritatea datelor;
5. Branding profesional (logo SVG + paletă culori) și design responsive;
6. SEO complet (sitemap, robots, Open Graph, JSON-LD) și pagini de eroare branded;
7. Documentație de deploy cu scripts automate și configuri Apache/Nginx + SSL.

<spațiu pentru concluzii personale: ce ai dovedit prin acest stagiu, cum se raportează rezultatele la obiective, ce posibile dezvoltări viitoare vezi (e.g., adăugare e-commerce real, upload imagini de către clienți, multilingv, PWA)>

\pagebreak

# 6. Bibliografie

> **Notă:** la inserare în Word, folosește References → Insert Citation → APA style.

## 6.1. Surse oficiale și documentație

1. Laravel 12 Documentation. URL: https://laravel.com/docs/12.x
2. Bootstrap 5 Documentation. URL: https://getbootstrap.com/docs/5.3/
3. PHP 8.2 Manual. URL: https://www.php.net/manual/en/
4. MySQL 8.0 Reference Manual. URL: https://dev.mysql.com/doc/refman/8.0/en/
5. Pest 3 Documentation. URL: https://pestphp.com/docs

## 6.2. Curriculum și planificare (resurse colegiu)

6. Curriculumul stagiului de practică P.08.O.004 „Practica ce anticipează probele de absolvire", Centrul de Excelență în Informatică și Tehnologii Informaționale, Chișinău, 2022.
7. Bodlev V., „Proiect Didactic De Lungă Durată", Colegiul „Iulia Hasdeu" Cahul, anul de învățământ 2025–2026.

## 6.3. Tutorialele recomandate de curriculum

8. Braicov A., „HTML. Ghid de inițiere", Editura Prut Internațional, Chișinău, 2008.
9. Anghel T., „Dezvoltarea aplicațiilor WEB folosind XHTML, PHP și MySQL", Polirom.
10. Anghel T., „Programarea în PHP. Ghid practic", Polirom, 2006.
11. Lerdorf R., Tatroe K., „Programming PHP", O'Reilly Media.
12. W3Schools HTML Tutorial. URL: https://www.w3schools.com/html/
13. W3Schools CSS Tutorial. URL: https://www.w3schools.com/css/
14. W3Schools Bootstrap Tutorial. URL: https://www.w3schools.com/bootstrap5/

## 6.4. Resurse suplimentare folosite în proiect

15. MDN Web Docs. URL: https://developer.mozilla.org/
16. WCAG 2.1 Guidelines. URL: https://www.w3.org/WAI/WCAG21/quickref/
17. OWASP Top 10. URL: https://owasp.org/Top10/
18. Schema.org structured data. URL: https://schema.org/LocalBusiness

\pagebreak

# 7. Anexe

## Anexa 1. Modelul de date (diagrama BD)

Vezi `docs/08-arhitectura-bazei-de-date.md` pentru diagrama ER completă în format Mermaid și ASCII.

## Anexa 2. Wireframe-urile site-ului

Vezi `docs/05-schitele-siteului.md` pentru wireframe-uri ASCII art ale tuturor paginilor (home, servicii index, servicii detaliu, galerie, contacte).

## Anexa 3. Output complet teste Pest

```
PASS  Tests\Feature\PublicRoutesTest                    (11 tests)
PASS  Tests\Feature\ContactFormTest                     (6 tests)
PASS  Tests\Feature\NewsletterTest                      (4 tests)
PASS  Tests\Feature\AuthAndAdminTest                    (12 tests)
PASS  Tests\Feature\SearchAndGalleryTest                (7 tests)
PASS  Tests\Feature\LinksAndNavigationTest              (7 tests)
PASS  Tests\Feature\SecurityTest                        (14 tests)
PASS  Tests\Unit\ModelsTest                             (10 tests)

Tests:    69 passed, 1 risky (175 assertions)
Duration: 2.03s
```

## Anexa 4. Screenshots site (de adăugat în Word)

> Adaugă screenshots cu următoarele pagini și marchează-le ca „Figura 1", „Figura 2", etc.:
>
> 1. Pagina principală (hero + carousel + categorii)
> 2. Detaliu categorie „Căni personalizate" cu sortare după preț
> 3. Pagina Galerie cu lightbox modal deschis
> 4. Pagina Contacte cu formularul completat
> 5. Panou admin Dashboard cu statistici
> 6. Panou admin Categorii (CRUD)
> 7. Pagina de eroare 404 custom
> 8. View mobil (375px) cu navbar colapsat

## Anexa 5. Linkul GitHub al proiectului

Repository public: `https://github.com/stroiuliviu-cmyk/Practica2`

---

**Sfârșitul raportului**
