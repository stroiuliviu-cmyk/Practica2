# 07. Specificațiile tehnice (AS8)

## 7.1. Cerințe nefuncționale

### 7.1.1. Performanță

- Timp de încărcare al paginilor sub 2 secunde pe o conexiune obișnuită (≥ 5 Mbps);
- Bundle CSS final sub 350 KB (inclusiv Bootstrap și Bootstrap Icons);
- Bundle JS final sub 100 KB (inclusiv Bootstrap JS și Popper);
- Imagini optimizate (SVG pentru placeholders, JPG/WebP pentru fotografii reale când vor fi adăugate);
- Folosirea cache-ului de view-uri Blade (compilare la prima cerere, apoi servire din `storage/framework/views`).

### 7.1.2. Compatibilitate

- Browsere suportate: ultimele 2 versiuni majore ale **Chrome**, **Firefox**, **Edge**, **Safari**;
- Sistem de operare client: Windows 10/11, macOS, Linux (orice distribuție recentă), iOS, Android;
- Rezoluții: de la 320 px (smartphone mic) până la 1920 px (desktop full HD) și mai sus.

### 7.1.3. Accesibilitate (WCAG 2.1 nivel AA)

- Tot textul are contrast suficient față de fundal (minim 4.5:1 pentru text normal, 3:1 pentru text mare);
- Imaginile decorative au `alt=""`, imaginile semnificative au text alternativ descriptiv;
- Toate formularele au `<label>` asociat fiecărui câmp prin atributul `for`;
- Navigarea poate fi efectuată complet cu tastatura (Tab, Shift+Tab, Enter);
- Există un atribut `lang="ro"` pe elementul `<html>`;
- Iconițele decorative au `aria-hidden="true"`; iconițele cu sens semantic au `aria-label`.

### 7.1.4. SEO de bază

- Fiecare pagină are `<title>` unic și descriptiv;
- Fiecare pagină are `<meta name="description">` unic;
- Structură HTML semantică (`<header>`, `<nav>`, `<main>`, `<footer>`);
- O singură etichetă `<h1>` per pagină;
- URL-uri curate, cu slug-uri lizibile (`/servicii/cani` în loc de `/servicii?id=1`);
- Link-urile interne folosesc `route()` Laravel, nu URL-uri hardcoded.

### 7.1.5. Securitate

- Protecție CSRF activată pe toate rutele POST (token automat în formulare prin directiva `@csrf`);
- Validare strictă a tuturor datelor de intrare prin reguli Laravel (`$request->validate(...)`);
- Folosirea exclusivă a Eloquent ORM și Query Builder — fără concatenare de SQL brut;
- Toate variabilele afișate în view-uri sunt escape-uite automat de Blade (`{{ $variabila }}` echivalent cu `htmlspecialchars`);
- Fișierul `.env` este în `.gitignore` și nu este publicat;
- Parolele admin (în viitor) vor fi hashate cu `bcrypt` (default Laravel).

## 7.2. Lista rutelor Laravel

Toate rutele definite în `routes/web.php`:

| Metodă HTTP | URL | Controller@Metodă | Nume rută | Conținut afișat |
|---|---|---|---|---|
| GET | `/` | `HomeController@index` | `home` | Pagina principală (hero + beneficii + categorii + proces + CTA) |
| GET | `/despre` | `DespreController@index` | `despre` | Pagina „Despre noi" (istoric, echipă, valori) |
| GET | `/servicii` | `ServiciuController@index` | `servicii.index` | Listă cu toate cele 8 categorii |
| GET | `/servicii/{slug}` | `ServiciuController@show` | `servicii.show` | Pagina unei singure categorii + cele 6 produse |
| GET | `/contacte` | `ContacteController@index` | `contacte.index` | Formular contact + date contact |
| POST | `/contacte` | `ContacteController@store` | `contacte.store` | Procesează formularul: validează → salvează → redirect cu flash |

### 7.2.1. Exemplu de utilizare a numelor de rute în view-uri

```blade
<a href="{{ route('home') }}">Acasă</a>
<a href="{{ route('servicii.show', ['slug' => $categorie->slug]) }}">{{ $categorie->denumire }}</a>
<form action="{{ route('contacte.store') }}" method="POST"> ... </form>
```

## 7.3. Procesul funcțional al formularului de contact

Diagrama detaliată a fluxului:

```
┌─────────────────────────────────────────────────────────────┐
│ 1. Utilizatorul accesează /contacte (GET)                   │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│ 2. Pagina afișează formularul cu câmpurile:                 │
│    nume, email, telefon (opțional), subiect (dropdown),     │
│    mesaj                                                    │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│ 3. Utilizatorul completează și apasă „Trimite mesajul"      │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│ 4. JavaScript client-side (resources/js/app.js):            │
│    - verifică nume.length >= 2                              │
│    - verifică email valid (regex)                           │
│    - verifică subiect.length >= 3                           │
│    - verifică mesaj.length >= 10                            │
│                                                             │
│    DACĂ invalid → alert() cu lista erorilor → STOP          │
│    DACĂ valid   → formularul este trimis spre server (POST) │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│ 5. POST /contacte → ContacteController@store                │
│    Token CSRF verificat automat de Laravel                  │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│ 6. Validare server-side ($request->validate):               │
│    nume     → required|string|min:2|max:150                 │
│    email    → required|email|max:150                        │
│    telefon  → nullable|string|max:30                        │
│    subiect  → required|string|min:3|max:200                 │
│    mesaj    → required|string|min:10                        │
│                                                             │
│    DACĂ invalid → redirect()->back()->withErrors()          │
│                    → pagina re-afișată cu erorile sub câmp  │
│                       prin @error('nume')...@enderror       │
│    DACĂ valid   → continuă                                  │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│ 7. MesajContact::create([...]) — salvare în DB              │
│    Tabela: mesaje_contact                                   │
│    Coloane: nume, email, telefon, subiect, mesaj, citit=0   │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│ 8. redirect()->route('contacte.index')                      │
│       ->with('success', 'Mesajul a fost trimis...')         │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│ 9. Pagina /contacte re-afișată cu mesajul de succes verde   │
│    prin @if(session('success')) ... @endif                  │
└─────────────────────────────────────────────────────────────┘
```

## 7.4. Procesul funcțional pentru o viitoare comandă online (conceptual)

> **Notă:** acest proces NU este implementat în săptămânile 1–2. Este descris doar conceptual, pentru a justifica prezența tabelelor `clienti` și `comenzi` în schema BD.

```
1. Client navighează în /servicii/{slug}
2. Pe pagina produsului, apasă butonul „Comandă"
3. Se deschide un modal/formular de comandă cu:
   - date client (nume, prenume, telefon, email)
   - cantitate
   - observații (text liber)
   - upload fișier (poza care va fi imprimată)
4. La submit:
   - se creează un rând în `clienti` (sau se reutilizează dacă există)
   - se creează un rând în `comenzi` cu status='noua'
5. Email automat către administrator + email confirmare către client
6. Administratorul (din viitor panou /admin) procesează comanda:
   status: noua → in_procesare → finalizata
```

## 7.5. Convenții de cod

### 7.5.1. PHP — PSR-12

- Indentare cu 4 spații;
- Fără tab-uri;
- Bracket de clasă / funcție pe linie nouă;
- Namespace-uri PSR-4 (`App\Models\Categorie`);
- Nume de clase **PascalCase** (`CategoriiSeeder`);
- Nume de metode **camelCase** (`getProduse()`);
- Constante în **SNAKE_CASE_MAJUSCULE**.

Exemplu:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class ServiciuController extends Controller
{
    public function show(string $slug)
    {
        $categorie = Categorie::where('slug', $slug)->firstOrFail();
        $produse = $categorie->produse()->where('activ', true)->get();

        return view('servicii.show', compact('categorie', 'produse'));
    }
}
```

### 7.5.2. CSS / SCSS

Folosesc o combinație de:
- **utilitare Bootstrap** pentru aspecte generice (`d-flex`, `justify-content-center`, `mb-3`, `text-primary`);
- **clase semantice custom** pentru componente unice, cu nume descriptive în română (`.card-serviciu`, `.hero-title`, `.cta-banner`).

Numele claselor custom respectă convenția kebab-case (`.card-serviciu`, nu `.cardServiciu` sau `.CardServiciu`).

### 7.5.3. JavaScript

- Sintaxă **ES6+**: `let`, `const`, arrow functions, template literals, destructuring;
- Comentarii descriptive pentru fiecare bloc important;
- Fără `var`, fără `function()` clasice când arrow e adecvată;
- Eveniment `DOMContentLoaded` pentru tot codul care manipulează DOM.

### 7.5.4. Blade

- Indentare cu 4 spații;
- Folosirea consecventă a `{{ }}` pentru afișare cu escape, `{!! !!}` doar când chiar e nevoie de HTML brut (în acest proiect: niciodată);
- Folosirea `@csrf` în toate formularele POST;
- Layout master extins cu `@extends('layouts.app')`;
- Secțiuni denumite clar: `@section('title')`, `@section('content')`, etc.;
- Parțiale incluse prin `@include('partials.navbar')`.

## 7.6. Structura folderelor proiectului (rezumat)

```
practica-2/
├── app/
│   ├── Http/
│   │   └── Controllers/    (HomeController, ServiciuController, etc.)
│   ├── Models/             (Categorie, Produs, MesajContact)
│   └── Providers/          (AppServiceProvider — View::composer)
├── bootstrap/              (cod intern Laravel — neatins)
├── config/                 (configurare — neatins)
├── database/
│   ├── migrations/         (6 migrate-uri custom)
│   ├── seeders/            (CategoriiSeeder, ProduseSeeder, DatabaseSeeder)
│   └── factories/          (folosit la nevoie, în viitor)
├── docs/                   (8 fișiere de documentație .md)
├── public/
│   ├── build/              (asset-uri Vite generate)
│   ├── img/placeholders/   (SVG-uri categorii / produse)
│   └── index.php           (entry point)
├── resources/
│   ├── js/app.js           (Bootstrap + smooth scroll + validare)
│   ├── sass/app.scss       (Bootstrap import + variabile + custom)
│   └── views/              (toate Blade-urile)
│       ├── layouts/
│       ├── partials/
│       └── servicii/
├── routes/
│   └── web.php             (rute publice)
├── storage/                (logs, cache — neatins)
├── tests/                  (gol în această etapă)
├── vendor/                 (dependențe Composer — gitignored)
├── .env                    (config local — gitignored)
├── .env.example            (template config)
├── composer.json
├── package.json
├── vite.config.js
└── README.md
```
