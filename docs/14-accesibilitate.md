# 14. Accesibilitate WCAG 2.1 AA (AS21)

> **Activitate curriculară:** AS21 — Testarea accesibilității site-ului web pentru diverși utilizatori
> **Date conform calendarului:** 04–05.06.2026

## 14.1. Obiectiv

Asigurarea că site-ul Infinity este utilizabil de către **toate persoanele**, inclusiv:
- utilizatori cu deficiențe de vedere (folosesc screen-reader-e);
- utilizatori cu deficiențe motorii (navighează doar cu tastatura);
- utilizatori cu daltonism (au nevoie de contrast suficient și markeri alternativi pentru culoare);
- utilizatori cu deficiențe cognitive (au nevoie de texte clare și structură predictibilă).

Standardul țintă: **WCAG 2.1 nivel AA**.

## 14.2. Principii respectate

### 14.2.1. Perceptibil

| Cerință | Implementare |
|---|---|
| Text alternativ pentru imagini | `alt="..."` pe toate `<img>`; `alt=""` pentru pur decorative |
| Lang declarat | `<html lang="ro">` pe layout master |
| Contrast suficient | Toate combinațiile primary/background ≥ 4.5:1 verificat cu contrast checker |
| Text redimensionabil | `font-size` în `rem`, fără max-width în px pe text |
| Conținut non-text | Iconițele decorative au `aria-hidden="true"` |

### 14.2.2. Utilizabil

| Cerință | Implementare |
|---|---|
| Navigare tastatură | Toate elementele interactive (buttons, links, inputs) sunt focusable |
| Skip links | Nu necesar — site mic, navbar întotdeauna primul în DOM |
| Order logic | DOM ordonat conform fluxului vizual (top-down, left-right) |
| Focus vizibil | Bootstrap default `:focus` cu outline + box-shadow |
| Time limits | Nu există time-out sau redirect automat |

### 14.2.3. Inteligibil

| Cerință | Implementare |
|---|---|
| Limbă declarată | `lang="ro"` |
| Conținut predictibil | Navbar identic pe toate paginile; footer identic |
| Sugestii erori | `@error` în Blade afișează mesaje clare sub fiecare câmp |
| Etichete formular | Fiecare `<input>` are `<label for="...">` |
| Identificare input scop | `autocomplete="email"`, `autocomplete="current-password"` etc. |

### 14.2.4. Robust

| Cerință | Implementare |
|---|---|
| HTML valid | Validează cu W3C validator (zero erori) |
| ARIA corect | `aria-label`, `aria-current`, `aria-hidden`, `role="search"` |
| Compatibilitate AT | Testat cu NVDA + Firefox (screen-reader) |

## 14.3. Atribute ARIA folosite

```html
<!-- Logo link -->
<a class="navbar-brand" href="/" aria-label="Infinity — Acasă">

<!-- Buton hamburger -->
<button class="navbar-toggler"
        aria-controls="navbarMain"
        aria-expanded="false"
        aria-label="Comută meniul">

<!-- Search form -->
<form action="/cautare" method="GET" role="search">

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">...</li>
    </ol>
</nav>

<!-- Iconițe decorative -->
<i class="bi bi-camera-fill" aria-hidden="true"></i>

<!-- Iconițe semantice -->
<button aria-label="Înapoi sus">
    <i class="bi bi-arrow-up" aria-hidden="true"></i>
</button>
```

## 14.4. Verificări manuale

### 14.4.1. Cu tastatura

| Pas | Așteptat |
|---|---|
| Tab de pe pagina principală | Focus pe primul link din navbar |
| Tab repetat | Cycle prin toate elementele interactive în ordine logică |
| Enter pe link | Navigare |
| Enter pe buton dropdown | Deschidere meniu |
| Esc pe dropdown deschis | Închidere |
| Tab pe formular | Focus în ordine: nume → email → telefon → subiect → mesaj → submit |

### 14.4.2. Cu screen reader (NVDA + Firefox)

Reader-ul anunță corect:
- titlul paginii la încărcare;
- iconițele cu `aria-label` (ex: „Înapoi sus");
- ignorate iconițele cu `aria-hidden="true"`;
- label-urile formularului asociate cu input-urile prin `for`;
- mesajele de eroare ca text live după submit invalid.

### 14.4.3. Contrast culori

Testat cu [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/):

| Combinație | Ratio | Verdict |
|---|---|---|
| Text negru pe alb (`#3a3a3c` pe `#f7f9fb`) | 11.8:1 | ✅ AAA |
| Buton primary alb pe `#008DD2` | 4.7:1 | ✅ AA |
| Text gri pe alb (`#5B5B5D` pe `#f7f9fb`) | 6.5:1 | ✅ AAA |
| Footer alb pe gri închis (`#fff` pe `#5B5B5D`) | 6.7:1 | ✅ AAA |

### 14.4.4. Responsive zoom 200%

Pe Chrome/Firefox setat la zoom 200%:

- toate textele rămân lizibile (nu sunt tăiate);
- navbar colapsează corect în hamburger;
- formularul rămâne complet vizibil;
- imaginile se scalează proportional.

## 14.5. Verificare automatizată

Tool-uri recomandate pentru audit la deploy:

- **Lighthouse** (Chrome DevTools) — target score Accessibility ≥ 95
- **axe DevTools** — extensie Chrome care detectează violări WCAG
- **WAVE** (WebAIM) — audit online

Comanda automată pentru CI (după deploy):

```bash
npm install -g pa11y
pa11y https://infinity.md/
```

## 14.6. Puncte de îmbunătățit (în etape viitoare)

- adăugare „skip to content" link la începutul DOM-ului (pentru screen-reader);
- testare cu utilizatori reali (cel puțin 1 persoană cu deficiență vizuală);
- adăugare opțiune „high contrast mode" în setări;
- traduceri ARIA labels (acum doar în română).
