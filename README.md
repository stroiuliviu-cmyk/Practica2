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

| Ruta | Metodă | Conținut |
|---|---|---|
| `/` | GET | Pagina principală — hero, beneficii, 8 categorii din DB, proces, CTA |
| `/despre` | GET | Despre noi — istoric, echipă, valori |
| `/servicii` | GET | Listă cu toate cele 8 categorii |
| `/servicii/{slug}` | GET | Detaliu categorie cu cele 6 produse din DB |
| `/contacte` | GET | Date contact + formular |
| `/contacte` | POST | Validare + salvare mesaj în `mesaje_contact` |

## Documentația proiectului

Toate documentele de planificare (AS1–AS9 din curriculum) se află în folderul [docs/](docs/):

1. [docs/01-unitatea-economica.md](docs/01-unitatea-economica.md) — Descrierea unității economice
2. [docs/02-obiectivele-siteului.md](docs/02-obiectivele-siteului.md) — Obiectivele site-ului
3. [docs/03-structura-generala.md](docs/03-structura-generala.md) — Structura generală și sitemap
4. [docs/04-elemente-de-continut.md](docs/04-elemente-de-continut.md) — Elemente de conținut
5. [docs/05-schitele-siteului.md](docs/05-schitele-siteului.md) — Schițele site-ului (wireframes)
6. [docs/06-instrumente-si-limbaje.md](docs/06-instrumente-si-limbaje.md) — Instrumente și limbaje folosite
7. [docs/07-specificatii-tehnice.md](docs/07-specificatii-tehnice.md) — Specificații tehnice
8. [docs/08-arhitectura-bazei-de-date.md](docs/08-arhitectura-bazei-de-date.md) — Arhitectura bazei de date

## Stadiul curent

**Prototip funcțional Laravel — săptămânile 1-2 (AS1–AS10)**

Implementat:
- ✅ Documentație completă de planificare (8 fișiere `docs/`)
- ✅ Schema bazei de date prin migrate-uri Laravel
- ✅ Catalog dinamic (categorii + produse) populat prin seedere
- ✅ 5 pagini publice cu Blade + Bootstrap 5
- ✅ Navbar și footer dinamic (categorii citite din DB)
- ✅ Formular de contact cu validare client + server și salvare în DB
- ✅ Design responsive (375 / 768 / 1200 px)
- ✅ SVG-uri placeholder generate local pentru toate categoriile și produsele

Neimplementat în această etapă (intenționat):
- ❌ Autentificare utilizatori / panou administrativ
- ❌ Sistem de comenzi online (coș, plată)
- ❌ Upload poze de către utilizator
- ❌ Sistem de notificări email
- ❌ Testare automatizată (PHPUnit/Pest)
- ❌ Deploy pe hosting

## Roadmap următoarele săptămâni

Pentru săptămânile 3–8 ale stagiului de practică (activitățile **AS11–AS28**), planurile includ:

- **Săpt. 3:** Sistem de autentificare admin (Laravel Breeze) + middleware acces
- **Săpt. 4:** Panou administrativ — CRUD categorii și produse
- **Săpt. 5:** Panou administrativ — gestiune mesaje contact + sistem comenzi
- **Săpt. 6:** Upload imagini reale, înlocuirea SVG-urilor placeholder, optimizare SEO
- **Săpt. 7:** Testare automatizată (Pest/PHPUnit) + securitate avansată
- **Săpt. 8:** Deploy pe hosting + documentație finală + prezentare publică

## Autor

- **Stagiar:** `<numele tău>` (de completat după rulare)
- **Conducător practică (colegiu):** Bodlev Veaceslav
- **Unitatea de practică:** Infinity SRL, Chișinău
- **Specialitate:** AAW 2241 — Administrarea Aplicațiilor Web (Tehnician de site-uri web)
- **Instituție:** IP Colegiul „Iulia Hasdeu" Cahul

## Licență

Proiect academic realizat în scop didactic. Nu este destinat utilizării comerciale fără acordul autorului și al unității de practică.
