# 12. Panou administrativ — CRUD complet (AS16-AS17)

> **Activități curriculare:**
> - AS16 — Crearea conexiunii bazei de date cu site-ul în vederea colectării și actualizării datelor
> - AS17 — Administrarea conținutului dinamic al site-ului
>
> **Date conform calendarului:** 21.05.2026 și 22.05.2026

## 12.1. Obiectiv

Crearea unui **panou administrativ web** complet, accesibil la `/admin`, care permite gestionarea tuturor datelor dinamice ale site-ului fără a fi nevoie de acces direct la baza de date sau modificări de cod.

## 12.2. Structura panoului

### 12.2.1. Layout dedicat admin

Panoul folosește un layout separat de site-ul public: [`resources/views/admin/layouts/app.blade.php`](../resources/views/admin/layouts/app.blade.php). Acesta conține:

- **header admin** — cu logo + badge „ADMIN" + buton „Vezi site-ul" + numele user-ului + buton logout;
- **sidebar vertical** (col-md-3) cu link-uri către toate secțiunile;
- **zona de content** (col-md-9) unde se randează `@yield('content')`;
- **alerte flash** — `success` (verde) și erori validare (roșu).

Layout-ul include `<meta name="robots" content="noindex,nofollow">` pentru a preveni indexarea în motoarele de căutare.

### 12.2.2. Sidebar — 6 secțiuni

| Iconă | Titlu | Rută | Funcție |
|---|---|---|---|
| `bi-speedometer2` | Dashboard | `/admin` | Statistici generale + ultimele mesaje |
| `bi-grid-3x3-gap` | Categorii | `/admin/categorii` | CRUD categorii |
| `bi-box-seam` | Produse | `/admin/produse` | CRUD produse |
| `bi-images` | Galerie | `/admin/galerie` | CRUD lucrări galerie |
| `bi-envelope` | Mesaje contact | `/admin/mesaje` | Vizualizare + marcare ca citit/șters |
| `bi-megaphone` | Newsletter | `/admin/newsletter` | Listare + ștergere abonați |

### 12.2.3. Dashboard cu statistici

`/admin` afișează 6 carduri „stat":

- Categorii (total + active)
- Produse (total + active)
- Lucrări galerie
- Abonați newsletter
- Mesaje contact (necitite/total)
- Status sistem (vizual „shield-check")

Sub statistici, o tabelă cu ultimele 5 mesaje primite, cu link rapid către detalii.

## 12.3. CRUD-uri implementate

Toate operațiunile CRUD folosesc pattern-ul standard **Resource Controller** Laravel:

| Acțiune | Rută | Metodă HTTP | View |
|---|---|---|---|
| Listă | `admin.X.index` | GET | `index.blade.php` |
| Adăugare formular | `admin.X.create` | GET | `form.blade.php` |
| Salvare nou | `admin.X.store` | POST | (redirect) |
| Editare formular | `admin.X.edit` | GET | `form.blade.php` (reutilizat) |
| Actualizare | `admin.X.update` | PUT/PATCH | (redirect) |
| Ștergere | `admin.X.destroy` | DELETE | (redirect) |

### 12.3.1. CRUD Categorii

[`Admin\CategorieController`](../app/Http/Controllers/Admin/CategorieController.php)

**Operațiuni:**
- listare cu numărător produse per categorie (`withCount('produse')`);
- creare cu auto-generare slug din denumire dacă nu e specificat manual;
- editare cu validare unique-slug (exclude propriul ID);
- ștergere CASCADE — la ștergerea unei categorii, se șterg și produsele asociate (constrângere FK în migrate);
- toggle activ/inactiv prin checkbox.

**Validări:**

```php
'denumire' => ['required', 'string', 'min:2', 'max:150'],
'slug' => ['nullable', 'string', 'max:100', 'unique:categorii,slug,{excludeId}'],
'descriere_scurta' => ['nullable', 'string', 'max:300'],
'descriere_completa' => ['nullable', 'string'],
'imagine' => ['nullable', 'string', 'max:255'],
'ordine_afisare' => ['nullable', 'integer', 'min:0'],
'activ' => ['nullable', 'boolean'],
```

### 12.3.2. CRUD Produse

[`Admin\ProdusController`](../app/Http/Controllers/Admin/ProdusController.php)

**Operațiuni:**
- listare paginată (20/pagina) cu filtrare după categorie;
- creare cu select de categorie + câmpuri text + textarea pentru caracteristici;
- editare cu pre-completare valori existente;
- ștergere directă (cu confirmare JS).

**Format „caracteristici":**

În formular, utilizatorul introduce caracteristici sub formă text:

```
material: ceramică
dimensiune: 330 ml
culoare: alb mat
```

Controller-ul parsează automat acest format în array asociativ → JSON salvat în DB. La editare, JSON-ul este convertit înapoi în acest format text.

### 12.3.3. CRUD Galerie

[`Admin\GalerieController`](../app/Http/Controllers/Admin/GalerieController.php)

**Operațiuni:**
- listare paginată cu thumbnail (60×60 px);
- creare cu titlu, descriere, cale imagine, categorie asociată opțională;
- editare;
- ștergere.

**Validări:**

```php
'titlu' => ['required', 'string', 'min:2', 'max:200'],
'descriere' => ['nullable', 'string', 'max:500'],
'imagine' => ['required', 'string', 'max:255'],
'categorie_id' => ['nullable', 'exists:categorii,id'],
'ordine_afisare' => ['nullable', 'integer', 'min:0'],
'activ' => ['nullable', 'boolean'],
```

### 12.3.4. Mesaje contact

[`Admin\MesajContactController`](../app/Http/Controllers/Admin/MesajContactController.php)

**Operațiuni (read-only + delete):**
- listare paginată cu evidențiere vizuală a mesajelor necitite (font bold);
- vizualizare detaliu — marchează automat mesajul ca „citit" la prima accesare;
- toggle citit/necitit prin buton dedicat;
- buton „Răspunde prin email" → deschide client-ul de mail cu subiect pre-completat;
- ștergere mesaj.

### 12.3.5. Newsletter

[`Admin\NewsletterController`](../app/Http/Controllers/Admin/NewsletterController.php)

**Operațiuni (read + delete):**
- listare paginată cu email, status, dată înscriere;
- ștergere abonat (cu confirmare).

> Acțiunile de adăugare/editare nu sunt necesare în zona admin — utilizatorii se înscriu prin formularul public din footer.

## 12.4. Securitate panou

Toate rutele `/admin/*` sunt protejate de două middleware-uri în lanț:

```php
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // ...
    });
```

- `auth` — verifică sesiunea Laravel;
- `admin` — verifică rolul `admin` în coloana `users.rol`.

Toate formularele includ `@csrf` token. Acțiunile destructive (DELETE) au confirmare JavaScript (`onsubmit="return confirm(...)"`).

## 12.5. Experiența utilizatorului în admin

- **mesaje flash** — toate operațiunile CRUD afișează un mesaj de succes verde după redirect;
- **erori validare** — listate într-un alert roșu la începutul paginii formular;
- **breadcrumbs** — pe paginile de editare („Categorii > Editare");
- **acțiuni rapide** — fiecare rând din tabelă are butoane mici (eye/edit/delete) cu iconițe;
- **link „Vezi pe site"** — deschide pagina publică în tab nou pentru verificare imediată.

## 12.6. Conexiunea bază de date — site public

În etapele anterioare (AS10) am stabilit deja conexiunea read-only — site-ul public consumă datele din DB prin Eloquent (categorii și produse afișate dinamic).

În această etapă (AS16) **am completat conexiunea bidirecțională**:

| Tabel | Citit de site public | Actualizat de | Actualizat de site public |
|---|---|---|---|
| `categorii` | ✅ navbar, home, /servicii, /galerie | ✅ panou admin | ❌ |
| `produse` | ✅ /servicii/{slug}, /cautare | ✅ panou admin | ❌ |
| `galerie` | ✅ /galerie | ✅ panou admin | ❌ |
| `mesaje_contact` | ❌ | ✅ panou admin (read + delete) | ✅ formular contact (insert) |
| `newsletter_subscribers` | ❌ | ✅ panou admin (read + delete) | ✅ formular footer (insert) |
| `users` | ❌ | (manual prin seeder) | ❌ |

## 12.7. Verificare

### Test rapid CRUD categorie

1. Login admin (admin@infinity.local / admin1234)
2. Click „Categorii" în sidebar → vezi cele 8 categorii
3. Click „Adaugă categorie" → completează denumire „Test" → Submit
4. Verifică în tabel că a apărut „Test" cu slug auto-generat
5. Click iconă „pencil" → editează → salvează
6. Click iconă „trash" → confirmă ștergerea
7. Verifică în DB că rândul a dispărut

### Test mesaj contact end-to-end

1. (tab privat, fără login) Accesează `/contacte`
2. Completează formularul → submit
3. Vezi mesajul de succes
4. (tab admin) Refresh `/admin` → vezi mesajul nou în lista „Ultimele mesaje" + counter „necitite" incrementat
5. Click pe mesaj → se marchează automat ca citit
6. Counter „necitite" decrementat

### Test newsletter

1. (oricine) Completează email în footer → submit
2. Vezi mesaj „Mulțumim pentru abonare!"
3. (admin) `/admin/newsletter` → vezi rândul nou
4. Reîncearcă cu același email → mesaj „Ești deja abonat" (UNIQUE constraint)
