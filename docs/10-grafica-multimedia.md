# 10. Zone grafice și multimedia (AS12-AS13)

> **Activități curriculare:**
> - AS12 — Crearea și poziționarea corectă a zonelor grafice și multimedia în structura site-ului
> - AS13 — Stilizarea paginilor web pentru îmbunătățirea aspectului vizual al site-ului
>
> **Date conform calendarului:** 15.05.2026 și 18.05.2026

## 10.1. Elemente grafice și multimedia

### 10.1.1. Logo Infinity SRL (vectorial)

Logo-ul oficial al firmei este un fișier SVG (`public/img/logo.svg`) care folosește palette-ul brand:

- **#008DD2** — albastru Infinity (culoarea principală)
- **#5B5B5D** — gri închis Infinity (culoarea secundară)

Logo-ul este afișat:
- **în navbar** — versiune normală, înălțime 38 px (32 px pe mobil);
- **în footer** — versiune invertită (alb pe gri închis), înălțime 44 px;
- **pe pagina de login** — sub formă de iconiță de tip „shield-lock";
- **în zona admin** — cu badge „ADMIN" lângă.

### 10.1.2. Imagini placeholder SVG generate local

În folderul `public/img/placeholders/` există **58 fișiere SVG** (8 categorii × 7 — 1 categorie + 6 produse — plus 2 fallback `cat-default.svg` și `prod-default.svg`).

Fiecare SVG:
- folosește gradient liniar cu culorile brand;
- include text descriptiv (denumire categorie + număr produs);
- este generat cu un script PHP local one-shot (nu necesită conexiune internet);
- ocupă în medie ~500 octeți (mult mai puțin decât JPG-uri raster).

Avantaje față de imagini raster:
- scalabile fără pierdere de calitate;
- consistente vizual (toate folosesc paleta brand);
- foarte mici ca dimensiune;
- pot fi înlocuite ulterior cu fotografii reale, păstrând structura.

### 10.1.3. Carousel hero pe pagina principală

Pe homepage, după secțiunea hero, există un carousel Bootstrap 5 (`<div class="carousel slide hero-carousel">`) care:

- rulează automat la 5 secunde per slide (`data-bs-interval="5000"`);
- afișează primele 4 categorii ca fundal (din `categorii` ordonate după `ordine_afisare`);
- include butoane previous/next pentru navigare manuală;
- include indicatori (puncte) sub carousel;
- are caption cu titlu, descriere scurtă și buton „Vezi detalii";
- are gradient overlay pentru lizibilitate text.

### 10.1.4. Galeria de lucrări (`/galerie`)

O nouă pagină dedicată afișării lucrărilor reale executate pentru clienți. Include:

- **grilă responsive** (CSS Grid) cu carduri pătrate auto-fill;
- **lightbox** — la click pe o imagine, se deschide un modal Bootstrap care arată imaginea mare + titlu + descriere + categorie;
- **filtre** — butoane pentru filtrarea după categorie (vezi `categorie_id` foreign key);
- **animație hover** — efect zoom-in și overlay cu informații.

Datele galeriei sunt stocate în noua tabelă `galerie` (creată prin migrate), cu următoarele coloane:

| Coloană | Tip | Descriere |
|---|---|---|
| `id` | BIGINT | PK |
| `titlu` | VARCHAR(200) | Titlul lucrării |
| `descriere` | VARCHAR(500) | Descriere scurtă |
| `imagine` | VARCHAR(255) | Cale către imagine |
| `categorie_id` | BIGINT FK | Categoria asociată (nullable) |
| `ordine_afisare` | INT | Pentru sortare |
| `activ` | BOOLEAN | Permite ascunderea |
| timestamps | | Standard Laravel |

Seedat cu 12 lucrări exemplificative prin [`GalerieSeeder`](../database/seeders/GalerieSeeder.php).

### 10.1.5. Bootstrap Icons

Toate iconițele site-ului folosesc setul **Bootstrap Icons** (peste 2000 icoane SVG, integrate prin npm). Acestea oferă:

- iconițe de status (check, info, warning, danger);
- iconițe pentru acțiuni (edit, delete, plus, save);
- iconițe semantice (telephone, envelope, map-pin, clock);
- iconițe pentru rețele sociale (facebook, instagram, whatsapp).

Fiecare iconiță are atributul `aria-hidden="true"` când este pur decorativă, sau `aria-label` când are sens semantic propriu.

## 10.2. Stilizare (AS13)

### 10.2.1. SCSS organizat tematic

Fișierul [`resources/sass/app.scss`](../resources/sass/app.scss) conține peste **800 de linii** organizate în secțiuni:

1. Import Google Fonts (Inter)
2. Override variabile Bootstrap (culori, font, border-radius)
3. Import Bootstrap complet
4. Import Bootstrap Icons
5. Stiluri custom pe componente:
   - navbar și brand
   - hero și CTA
   - butoane (hover transform, shadow)
   - carduri (servicii, produse, beneficii)
   - carousel hero
   - galerie (grilă + lightbox)
   - formular newsletter (input cu fundal translucid)
   - panou admin (sidebar, stat cards, table)
   - back-to-top button
   - filter bar
   - animații scroll reveal
   - footer
   - responsive helpers

### 10.2.2. Paleta de culori brand

Toate culorile derivă din logo:

```scss
$primary:    #008DD2;  // albastru Infinity
$secondary:  #5B5B5D;  // gri închis Infinity
$info:       #00aef0;  // variantă mai deschisă
$body-bg:    #f7f9fb;  // gri-bleu foarte deschis
```

### 10.2.3. Animații scroll reveal

Elementele cu atributul `data-reveal` apar treptat când intră în viewport. Implementarea folosește `IntersectionObserver`:

```javascript
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            revealObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.15 });
```

În CSS, elementele încep cu `opacity: 0` și `transform: translateY(24px)`, iar la activare devin opace și se mută în poziție prin tranziție de 0.6s.

Variante de direcție disponibile: `data-reveal="left"` și `data-reveal="right"`.

### 10.2.4. Hover effects polishaje

- **Carduri servicii** — translateY(-6px) + shadow mai mare la hover;
- **Butoane primary** — translateY(-2px) + shadow accentuat;
- **Galerie** — scale(1.02) + overlay cu informații;
- **Link-uri footer** — schimbare culoare la lighten($primary).

### 10.2.5. Typography

Fontul principal este **Inter** (de la Google Fonts), încărcat la începutul SCSS-ului. Inter are caracteristici de citire optime pentru ecrane și suportă diacriticele românești (ă, â, î, ș, ț).

Ierarhia tipografică:

| Element | Greutate | Mărime |
|---|---|---|
| `h1` (hero) | 800 | clamp(2rem, 5vw, 3.5rem) |
| `h2` (secțiuni) | 800 | 2.25rem |
| `h3` (subsecțiuni) | 700 | 1.2-1.5rem |
| `body` | 400 | 1rem (16px) |
| `small` | 400 | 0.875rem |

## 10.3. Responsivitate

Toate elementele grafice respectă breakpoint-urile Bootstrap standard:

- **xs** (<576px): carduri 1 coloană, carousel mai mic, navbar colapsat
- **sm** (576-767px): 1-2 coloane
- **md** (768-991px): 2-3 coloane
- **lg** (992-1199px): 3-4 coloane, navbar complet vizibil
- **xl** (≥1200px): 4 coloane maxim

## 10.4. Verificare

| URL | Element vizual de verificat |
|---|---|
| `/` | Carousel rotește automat, scroll reveal pe carduri |
| `/galerie` | Click pe imagine → modal lightbox |
| `/galerie?categorie=cani` | Filtrare după categorie |
| (orice pagină, scroll) | Animații apar la intrarea în viewport |
| (orice pagină, mobil 375px) | Layout reflowed corect |
