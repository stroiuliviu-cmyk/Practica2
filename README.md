# FotoMoments — clonă (proiect de practică Laravel)

Site de prezentare cu catalog dinamic, modelat după [fotomoments.md](https://www.fotomoments.md/) — o firmă din Chișinău specializată în imprimare personalizată pe căni, tricouri, brelocuri, perne, puzzle, ceasuri, farfurii și tipar fotografii.

Proiectul este realizat ca livrabil pentru **săptămânile 1–2** (activitățile **AS1–AS10** din curriculum) ale stagiului de practică „Practica ce anticipează probele de absolvire" desfășurat la **Infinity SRL** între 27.04.2026 și 19.06.2026.

## Context

- **Stagiar:** elev anul IV, specialitatea Administrarea Aplicațiilor Web (Tehnician de site-uri web), IP Colegiul „Iulia Hasdeu" Cahul, grupa AAW 2241
- **Unitatea de practică:** Infinity SRL
- **Perioada acoperită de această livrare:** 27.04.2026 – 11.05.2026 (săptămânile 1–2)
- **Conducător practică (colegiu):** Bodlev Veaceslav
- **Scop:** documentație de planificare + prototip funcțional cu catalog dinamic citit din MySQL

## Tech stack

| Componentă | Versiune | Rol |
|---|---|---|
| PHP | 8.2+ | Limbaj server-side |
| Laravel | 12.x | Framework MVC |
| MySQL / MariaDB | 8.x / 10.x (XAMPP) | Bază de date relațională |
| Blade | (Laravel 12) | Templating |
| Bootstrap | 5.3.x | Framework CSS |
| Bootstrap Icons | 1.x | Iconițe SVG |
| Sass | 1.x | Preprocesor CSS |
| Vite | 7.x | Build front-end |
| Node.js | 18+ (folosit 24) | Runtime JS |
| npm | 10+ | Manager pachete JS |
| Composer | 2.x | Manager pachete PHP |
| Git | 2.x | Versionare |

> **NB:** NU folosesc Tailwind, Vue, React, Alpine sau Livewire — doar Blade + vanilla JS + Bootstrap pur, conform programei colegiului.

## Cum se rulează local

### Cerințe preliminare

Asigură-te că ai instalat:

- **PHP 8.2+** (verifică: `php --version`)
- **Composer 2.x** (verifică: `composer --version`)
- **Node.js 18+** și **npm** (verifică: `node --version` și `npm --version`)
- **MySQL/MariaDB** (recomandat: XAMPP, care include și phpMyAdmin)
- **Git** (opțional, pentru clonare)

### Pași de rulare

1. **Clonează repository-ul** sau extrage arhiva în folderul dorit.

2. **Instalează dependențele PHP:**
   ```bash
   composer install
   ```

3. **Instalează dependențele JavaScript:**
   ```bash
   npm install
   ```

4. **Configurează variabilele de mediu:**
   ```bash
   cp .env.example .env
   ```
   Verifică (sau modifică) datele de conectare la baza de date în `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=fotomoments
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generează cheia aplicației:**
   ```bash
   php artisan key:generate
   ```

6. **Creează baza de date `fotomoments`** în phpMyAdmin (sau prin orice alt client MySQL):
   - Deschide [http://localhost/phpmyadmin](http://localhost/phpmyadmin) (după ce ai pornit XAMPP)
   - Apasă „Nou" / „New"
   - Introdu numele `fotomoments`, alege colation `utf8mb4_unicode_ci`
   - Apasă „Creează" / „Create"

7. **Rulează migrațiile și populează datele de test:**
   ```bash
   php artisan migrate --seed
   ```
   După această comandă, baza de date va conține:
   - 8 categorii (`categorii`)
   - 48 produse, 6 pentru fiecare categorie (`produse`)
   - tabelele goale: `clienti`, `comenzi`, `mesaje_contact`, `users` (cu coloana `rol`)

8. **Pornește serverul de dezvoltare front-end (într-un terminal):**
   ```bash
   npm run dev
   ```

9. **Pornește serverul Laravel (în al doilea terminal):**
   ```bash
   php artisan serve
   ```

10. **Deschide site-ul** în browser:
    [http://127.0.0.1:8000](http://127.0.0.1:8000)

### Reset complet al bazei de date

Dacă vrei să resetezi totul și să re-populezi:

```bash
php artisan migrate:fresh --seed
```

## Structura folderelor (rezumat)

```
.
├── app/
│   ├── Http/Controllers/         (Home, Serviciu, Contacte, Despre)
│   ├── Models/                    (Categorie, Produs, MesajContact)
│   └── Providers/AppServiceProvider.php  (View::composer pentru navbar)
├── database/
│   ├── migrations/                (6 migrate-uri custom)
│   └── seeders/                   (Categorii + Produse + DatabaseSeeder)
├── docs/                          (8 fișiere documentație — AS1–AS9)
├── public/img/placeholders/       (58 SVG-uri categorii și produse)
├── resources/
│   ├── js/app.js                  (Bootstrap + smooth scroll + validare)
│   ├── sass/app.scss              (Bootstrap + custom, >450 linii)
│   └── views/
│       ├── layouts/app.blade.php  (layout master)
│       ├── partials/              (navbar, footer)
│       ├── home.blade.php
│       ├── despre.blade.php
│       ├── contacte.blade.php
│       └── servicii/              (index, show)
├── routes/web.php                  (6 rute publice nominalizate)
├── .env.example
├── composer.json
├── package.json
└── vite.config.js
```

## Pagini funcționale

### Site public

| Ruta | Metodă | Conținut |
|---|---|---|
| `/` | GET | Pagina principală — hero, carousel, beneficii, 8 categorii din DB, proces, CTA |
| `/despre` | GET | Despre noi — istoric, echipă, valori |
| `/servicii` | GET | Listă cu toate cele 8 categorii |
| `/servicii/{slug}` | GET | Detaliu categorie cu cele 6 produse din DB + sortare (preț/nume) |
| `/galerie` | GET | Galeria lucrărilor realizate + filtre + lightbox modal |
| `/cautare?q=...` | GET | Căutare produse după denumire/descriere |
| `/contacte` | GET | Date contact + formular |
| `/contacte` | POST | Validare + salvare mesaj în `mesaje_contact` |
| `/newsletter` | POST | Subscriere newsletter (formular din footer) |

### Autentificare & panou admin

| Ruta | Metodă | Conținut |
|---|---|---|
| `/login` | GET / POST | Formular login admin |
| `/logout` | POST | Distruge sesiunea |
| `/admin` | GET | Dashboard cu statistici |
| `/admin/categorii` | GET + CRUD | CRUD complet categorii |
| `/admin/produse` | GET + CRUD | CRUD complet produse (cu paginare + filtru categorie) |
| `/admin/galerie` | GET + CRUD | CRUD lucrări galerie |
| `/admin/mesaje` | GET + delete | Vizualizare mesaje contact (cu marcare citit) |
| `/admin/newsletter` | GET + delete | Listă abonați newsletter |

**Credențiale demo admin:** `admin@infinity.local` / `admin1234`

## Documentația proiectului

Toate documentele de planificare și dezvoltare se află în folderul [docs/](docs/):

**Planificare (AS1–AS9, săptămânile 1–2):**

1. [docs/01-unitatea-economica.md](docs/01-unitatea-economica.md) — Descrierea unității economice
2. [docs/02-obiectivele-siteului.md](docs/02-obiectivele-siteului.md) — Obiectivele site-ului
3. [docs/03-structura-generala.md](docs/03-structura-generala.md) — Structura generală și sitemap
4. [docs/04-elemente-de-continut.md](docs/04-elemente-de-continut.md) — Elemente de conținut
5. [docs/05-schitele-siteului.md](docs/05-schitele-siteului.md) — Schițele site-ului (wireframes)
6. [docs/06-instrumente-si-limbaje.md](docs/06-instrumente-si-limbaje.md) — Instrumente și limbaje folosite
7. [docs/07-specificatii-tehnice.md](docs/07-specificatii-tehnice.md) — Specificații tehnice
8. [docs/08-arhitectura-bazei-de-date.md](docs/08-arhitectura-bazei-de-date.md) — Arhitectura bazei de date

**Dezvoltare faza 2 (AS11–AS17, săptămâna 3):**

9. [docs/09-elemente-navigare.md](docs/09-elemente-navigare.md) — Elemente de navigare (AS11)
10. [docs/10-grafica-multimedia.md](docs/10-grafica-multimedia.md) — Zone grafice și multimedia (AS12-AS13)
11. [docs/11-formulare-autentificare.md](docs/11-formulare-autentificare.md) — Formulare dinamice și autentificare (AS14-AS15)
12. [docs/12-panou-administrativ.md](docs/12-panou-administrativ.md) — Panou administrativ CRUD (AS16-AS17)

## Stadiul curent

**Prototip funcțional Laravel — săptămânile 1-3 (AS1–AS17)**

Implementat:
- ✅ Documentație completă de planificare (12 fișiere `docs/`)
- ✅ Schema BD prin 8 migrate-uri Laravel
- ✅ Catalog dinamic populat prin seedere (8 categorii + 48 produse + 12 lucrări galerie + 2 useri)
- ✅ 8 pagini publice (home, despre, servicii index/show, galerie, căutare, contacte, login)
- ✅ Navbar dinamic + dropdown servicii + bară căutare + footer cu newsletter
- ✅ Formular de contact + formular newsletter (cu validare client + server)
- ✅ Autentificare admin (custom, middleware role admin)
- ✅ Panou administrativ complet (`/admin`) cu CRUD: categorii, produse, galerie, mesaje, newsletter
- ✅ Carousel hero + galerie cu lightbox + animații scroll reveal + back-to-top
- ✅ Sortare/filtrare produse + filtre galerie
- ✅ Design responsive (375 / 768 / 1200 px)
- ✅ Branding Infinity SRL (logo SVG, paletă albastru #008DD2 + gri #5B5B5D)

Neimplementat în această etapă (intenționat — următoarele săptămâni):
- ❌ Sistem de comenzi online (coș, plată) — beyond curriculum scope
- ❌ Upload imagini de către admin (curent: cale text)
- ❌ Notificări email pentru noile mesaje contact
- ❌ Testare automatizată (PHPUnit/Pest) — AS18–AS23
- ❌ Deploy pe hosting — AS26

## Roadmap următoarele săptămâni

Pentru săptămânile 4–8 ale stagiului de practică (activitățile **AS18–AS28**):

- **Săpt. 4–5 (AS18–AS23):** Testare interfață + automated tests (Pest), accesibilitate, securitate, încărcare
- **Săpt. 6 (AS24–AS25):** Mentenanță + adăugare tehnologii noi (sitemap.xml, robots.txt, cache, optimizări SEO)
- **Săpt. 6 (AS26):** Publicare pe hosting (recomandat: Hetzner / Cloudways / DigitalOcean)
- **Săpt. 7 (AS27):** Elaborarea raportului final de practică
- **Săpt. 8 (AS28):** Susținerea raportului în fața comisiei

## Autor

- **Stagiar:** `<numele tău>` (de completat după rulare)
- **Conducător practică (colegiu):** Bodlev Veaceslav
- **Unitatea de practică:** Infinity SRL, Chișinău
- **Specialitate:** AAW 2241 — Administrarea Aplicațiilor Web (Tehnician de site-uri web)
- **Instituție:** IP Colegiul „Iulia Hasdeu" Cahul

## Licență

Proiect academic realizat în scop didactic. Nu este destinat utilizării comerciale fără acordul autorului și al unității de practică.
