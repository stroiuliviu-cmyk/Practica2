# 06. Instrumente și limbaje folosite (AS6)

## 6.1. Lista instrumentelor

| Instrument | Versiune | Rol în proiect | Justificare alegere |
|---|---|---|---|
| **Visual Studio Code** | 1.x curent | Editor de cod sursă | Editor modern, gratuit, cu suport excelent pentru PHP, Blade, JavaScript și SCSS prin extensii (Laravel Blade Snippets, PHP Intelephense). Familiar din anii anteriori de studiu. |
| **Git** | 2.x curent | Sistem de control al versiunilor | Standard industrial pentru versionarea codului. Permite urmărirea modificărilor, lucrul pe ramuri și colaborare. |
| **GitHub** | — | Hosting repository și demonstrație la prezentare | Cea mai populară platformă de hosting Git. Permite afișarea publică a proiectului către conducătorul de practică. |
| **Composer** | 2.x | Manager de dependențe PHP | Manager oficial pentru pachete PHP. Folosit pentru instalarea Laravel și a tuturor pachetelor PHP necesare. |
| **Node.js** | 18.x+ | Runtime JavaScript pentru build front-end | Necesar pentru a rula Vite, npm și instrumentele de build front-end. |
| **npm** | 9.x+ | Manager de dependențe JavaScript | Vine integrat cu Node.js. Folosit pentru instalarea Bootstrap, Sass și a celorlalte pachete front-end. |
| **Vite** | 5.x+ | Bundler / dev server modern | Build tool rapid, integrat nativ în Laravel începând cu versiunea 9. Compilează SCSS, transformă JS și oferă hot-reload în dezvoltare. |
| **Laravel** | 12.x | Framework PHP back-end | Cel mai popular framework PHP modern. Oferă MVC clar, ORM Eloquent, sistem de rute curat, migrate-uri, seedere, validare puternică și o ergonomie excelentă pentru dezvoltatori. |
| **Bootstrap 5** | 5.3.x | Framework CSS front-end | Cel mai utilizat framework CSS din lume. Oferă grilă responsive, componente gata făcute (navbar, carduri, formulare) și sistem de utilitare. Învățat la colegiu, conform programei curriculare. |
| **Bootstrap Icons** | 1.x | Bibliotecă de iconițe | Set oficial de iconițe Bootstrap, peste 2000 de SVG-uri. Instalat prin npm, fără CDN. |
| **Sass / SCSS** | 1.x | Preprocesor CSS | Permite scrierea CSS-ului cu variabile, nesting, mixin-uri, precum și override-ul variabilelor Bootstrap înainte de compilare. |
| **XAMPP** | 8.x | Stack local pentru server web + bază de date | Soluție all-in-one care include Apache, MySQL/MariaDB și phpMyAdmin. Setup rapid pe Windows pentru dezvoltare locală. |
| **MySQL / MariaDB** | 8.x / 10.x | Sistem de gestiune a bazei de date | Sistem RDBMS open-source, integrat în XAMPP. Performant, fiabil, suport excelent pentru relații, indexuri și constrângeri. |
| **phpMyAdmin** | 5.x | Interfață web pentru administrarea bazei de date | Permite vizualizarea tabelelor, datelor și execuția de interogări SQL fără a folosi linia de comandă. |

## 6.2. Lista limbajelor folosite

| Limbaj | Versiune | Folosit pentru | Argumentare |
|---|---|---|---|
| **PHP** | 8.2+ | Logica server-side (controllere, modele, migrațiilor), rendering Blade | Limbaj server-side matur și foarte folosit în web. Versiunea 8 aduce performanță îmbunătățită, tipuri stricte, atribute, JIT compiler. Standard în Laravel. |
| **Blade** | (Laravel 12) | Sistemul de templating al Laravel — generare HTML dinamic | Permite ierarhizarea view-urilor (layout master + secțiuni), include-uri parțiale, componente reutilizabile, integrare nativă cu datele din Eloquent. Simplu, lizibil, foarte productiv. |
| **HTML5** | — | Marcarea structurii paginilor | Standardul actual. Folosesc etichete semantice: `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>` — bune pentru SEO și accesibilitate. |
| **SCSS** | (Sass 1.x) | Stilizarea (preprocesor CSS) | Permite scrierea CSS-ului cu variabile, mixins și nesting; integrarea cu sursele Bootstrap pentru override de teme. Compilat la CSS standard prin Vite. |
| **CSS3** | — | Rezultatul compilării SCSS, livrat browserului | Standardul web pentru stilizare. Compatibil cu toate browserele moderne. |
| **JavaScript ES6+** | (Node 18+) | Interactivitate client-side, validare formular, smooth scroll, tooltip-uri Bootstrap | Limbajul nativ al browserului. Folosesc sintaxă modernă: `let/const`, arrow functions, `template literals`, destructuring, `async/await`, modules. |
| **SQL** | (MySQL 8) | Interogări către baza de date (implicit, prin Eloquent) | Limbajul universal pentru baze de date relaționale. În Laravel, majoritatea interogărilor sunt generate automat de Eloquent ORM, dar pot fi scrise și manual prin `DB::raw()` dacă este nevoie. |

## 6.3. Subsecțiune specială — „De ce Laravel?"

Pentru proiectul de față am ales **Laravel** ca framework back-end, în defavoarea altor opțiuni (PHP pur, Symfony, CodeIgniter, sau soluții non-PHP precum Node/Express, Django, Rails). Motivele:

### 6.3.1. Structură MVC clară

Laravel impune o separare strictă între:
- **Modele** (`app/Models/`) — interacțiunea cu baza de date prin Eloquent ORM;
- **View-uri** (`resources/views/`) — prezentarea, prin templating Blade;
- **Controllere** (`app/Http/Controllers/`) — logica de business și legătura între modele și view-uri.

Această structură este predată la colegiu și este înțeleasă imediat de orice cadru didactic sau coleg care va analiza codul.

### 6.3.2. ORM Eloquent

Eloquent permite manipularea bazei de date prin obiecte PHP, fără a scrie SQL brut:

```php
// În loc de: SELECT * FROM produse WHERE categorie_id = 1 AND activ = 1
Produs::where('categorie_id', 1)->where('activ', true)->get();

// Relații încărcate automat:
$categorie->produse;  // returnează colecția produselor
$produs->categorie;   // returnează categoria părinte
```

Avantaje:
- protecție automată împotriva SQL injection (prepared statements);
- relații exprimate declarativ (`hasMany`, `belongsTo`);
- conversie automată a tipurilor (date, JSON, booleene).

### 6.3.3. Migrate-uri reproductibile

Schema bazei de date este definită în fișiere PHP versionate, în loc de SQL brut:

```php
Schema::create('produse', function (Blueprint $table) {
    $table->id();
    $table->foreignId('categorie_id')->constrained()->cascadeOnDelete();
    $table->string('denumire', 200);
    // ...
});
```

Orice coleg care primește proiectul rulează `php artisan migrate --seed` și obține **exact** aceeași bază de date — nu mai există problema „la mine funcționează, la tine nu".

### 6.3.4. Seedere pentru date de test

Cele 8 categorii și 48 de produse exemplificative sunt definite în clase PHP (`database/seeders/`) și pot fi populate cu o singură comandă. Acest lucru permite resetarea bazei de date la o stare cunoscută în câteva secunde, foarte util în timpul dezvoltării.

### 6.3.5. Sistem de rute curat și nominalizate

```php
Route::get('/servicii/{slug}', [ServiciuController::class, 'show'])->name('servicii.show');
```

În view-uri se folosește numele rutei, nu URL-ul direct:

```blade
<a href="{{ route('servicii.show', $categorie->slug) }}">Detalii</a>
```

Dacă mai târziu URL-ul se schimbă (ex: `/servicii/{slug}` → `/categorii/{slug}`), nu trebuie modificate toate view-urile, ci doar fișierul de rute.

### 6.3.6. Suport nativ pentru autentificare

În Laravel, sistemul de autentificare (login, register, parolă uitată, sesiune, hash-uri parole) este integrat și poate fi activat cu o singură comandă (`php artisan install:api` sau Breeze). Acest lucru este **esențial** pentru săptămânile 3–8, când voi adăuga panou administrativ pentru gestiunea catalogului.

### 6.3.7. Validare puternică

Laravel oferă reguli de validare declarative, atât în controllere cât și în clase dedicate `FormRequest`:

```php
$request->validate([
    'nume'    => 'required|string|min:2|max:150',
    'email'   => 'required|email|max:150',
    'mesaj'   => 'required|string|min:10',
]);
```

Validarea se face server-side și mesajele de eroare se afișează automat în view-uri prin `@error('nume')`.

### 6.3.8. Comunitate și documentație

Laravel are una dintre cele mai mari comunități open-source din lume:
- documentație oficială excelentă (laravel.com/docs);
- Laracasts.com — sute de tutoriale video gratuite și plătite;
- multe pachete de la terți (Spatie, Filament, Livewire);
- forum activ pe Reddit, Stack Overflow și Discord.

În cazul unei probleme tehnice, soluția este aproape întotdeauna la o căutare distanță — un avantaj important pentru un elev aflat la prima experiență de stagiu.

### 6.3.9. Compatibilitate cu cerințele AAW

Curriculumul calificării „Tehnician de site-uri web" (Administrarea Aplicațiilor Web) include explicit:
- Limbaj PHP — îndeplinit;
- Bază de date relaționale — îndeplinit prin MySQL;
- Arhitectură MVC — îndeplinit;
- Validare formularelor — îndeplinit;
- Securitate (CSRF, XSS) — îndeplinit prin protecțiile native Laravel.

Astfel, alegerea Laravel respectă atât cerințele clientului (cod modern, ușor de menținut), cât și cerințele formative ale colegiului.

## 6.4. De ce Bootstrap 5 (și nu Tailwind)?

- **Aliniere cu programa colegiului:** la disciplina „Tehnologii web" se predă Bootstrap. Tailwind este o tehnologie diferită (utility-first), care nu a fost încă introdusă în curriculum.
- **Componente gata făcute:** Bootstrap oferă navbar, modal, dropdown, breadcrumbs, alerte etc. — componente care altfel ar trebui scrise manual.
- **Curbă de învățare scurtă:** grila Bootstrap (`row` + `col-md-X`) este intuitivă și am exersat-o în anii anteriori.
- **Override prin SCSS:** se pot personaliza variabilele de culoare și tipografice fără a renunța la sistemul Bootstrap.

## 6.5. De ce vanilla JavaScript (și nu Vue / React / Alpine)?

- **Scop limitat al interactivității:** site-ul are doar 2–3 momente de interacțiune client-side (smooth scroll, validare formular, tooltip-uri). Un framework JavaScript ar fi o supra-inginerie.
- **Performanță:** bundle-ul JS final rămâne sub 100 KB, fără dependențe inutile.
- **Pregătire pentru viitor:** dacă proiectul evoluează spre componente complexe, voi putea adăuga Alpine.js sau Livewire ulterior, fără a fi obligat de la început.

## 6.6. De ce XAMPP (și nu Docker / Laravel Sail)?

- **Setup rapid pe Windows:** XAMPP se instalează cu un singur fișier .exe și este gata în 5 minute.
- **Familiar de la cursuri:** XAMPP este folosit la colegiu pentru toate lucrările practice.
- **Cerințe minime:** Docker necesită hardware mai puternic (virtualizare activată în BIOS, WSL2, RAM ≥ 8 GB), ceea ce nu este garantat pe toate computerele disponibile la stagiu.
