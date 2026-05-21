# 05. Schițele site-ului (wireframes) (AS5)

Schițele de mai jos prezintă structura vizuală a fiecărei pagini importante, sub formă de wireframe în format ASCII. Pentru fiecare pagină este indicată și comportarea responsive (cum se reorganizează pe ecrane mai mici).

## 5.1. Pagina principală — `/`

### 5.1.1. Wireframe desktop (≥ 992 px)

```
┌──────────────────────────────────────────────────────────────────────────┐
│  [LOGO FotoMoments]    Acasă  Despre  Servicii ▼  Contacte               │ ← navbar
├──────────────────────────────────────────────────────────────────────────┤
│                                                                          │
│   ┌──────────────────────────────────┐  ┌──────────────────────────┐   │
│   │ Momentele tale prețioase,        │  │                          │   │
│   │ imprimate pentru totdeauna       │  │   [Imagine hero          │   │
│   │                                  │  │    decorativă]           │   │
│   │ Lorem ipsum scurt despre firmă...│  │                          │   │
│   │                                  │  │                          │   │
│   │ [Vezi serviciile] [Contactează]  │  │                          │   │
│   └──────────────────────────────────┘  └──────────────────────────┘   │
│                                                                          │ ← hero
├──────────────────────────────────────────────────────────────────────────┤
│              De ce să alegi FotoMoments?                                 │
│   ┌──────────────┐    ┌──────────────┐    ┌──────────────┐              │
│   │  [icon ⭐]   │    │  [icon ⚡]   │    │  [icon ❤]    │              │
│   │ Experiență   │    │ Execuție pe  │    │ Calitate     │              │
│   │ din 2006     │    │ loc 10-20min │    │ înaltă       │              │
│   └──────────────┘    └──────────────┘    └──────────────┘              │ ← beneficii
├──────────────────────────────────────────────────────────────────────────┤
│              Serviciile noastre                                          │
│   ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐                │
│   │ [imagine]│  │ [imagine]│  │ [imagine]│  │ [imagine]│                │
│   │ Căni     │  │ Tricouri │  │Brelocuri │  │ Perne    │                │
│   │ [Detalii]│  │ [Detalii]│  │ [Detalii]│  │ [Detalii]│                │
│   └──────────┘  └──────────┘  └──────────┘  └──────────┘                │
│   ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐                │
│   │ Puzzle   │  │ Ceasuri  │  │ Farfurii │  │  Tipar   │                │
│   │          │  │          │  │          │  │  foto    │                │
│   └──────────┘  └──────────┘  └──────────┘  └──────────┘                │ ← grilă categorii
├──────────────────────────────────────────────────────────────────────────┤
│              Cum se comandă                                              │
│   ┌──────┐    ┌──────┐    ┌──────┐    ┌──────┐                          │
│   │  1   │    │  2   │    │  3   │    │  4   │                          │
│   │Alegi │    │Trimit│    │Verif │    │Primi │                          │
│   │obiec │    │ poza │    │mache │    │produs│                          │ ← proces
│   └──────┘    └──────┘    └──────┘    └──────┘                          │
├──────────────────────────────────────────────────────────────────────────┤
│   ┌──────────────────────────────────────────────────────┐              │
│   │  Ai nevoie de un cadou personalizat?                 │              │
│   │  +373 22 123 456                                     │              │
│   │  [Sună acum]                                         │              │
│   └──────────────────────────────────────────────────────┘              │ ← CTA contact
├──────────────────────────────────────────────────────────────────────────┤
│  Despre noi  │  Servicii  │  Contact   │  Program                       │
│  [text]      │  - Căni    │  Tel       │  L-V 09-18                     │
│              │  - ...     │  Email     │  S 09-14                       │
│              │            │  Adresă    │                                │ ← footer
│  ────────── © 2026 FotoMoments. Toate drepturile rezervate. ──────────  │
└──────────────────────────────────────────────────────────────────────────┘
```

### 5.1.2. Wireframe mobil (< 768 px)

```
┌──────────────────────┐
│ [LOGO]      [☰ menu] │ ← navbar colapsată
├──────────────────────┤
│                      │
│  Titlu hero          │
│  Subtitlu...         │
│                      │
│  [Vezi serviciile]   │
│  [Contactează-ne]    │ ← butoanele unul sub altul
│                      │
│  [Imagine hero]      │ ← imaginea trece sub text
├──────────────────────┤
│  ┌─────────────┐     │
│  │ Beneficiu 1 │     │ ← 1 card pe linie
│  └─────────────┘     │
│  ┌─────────────┐     │
│  │ Beneficiu 2 │     │
│  └─────────────┘     │
│  ┌─────────────┐     │
│  │ Beneficiu 3 │     │
│  └─────────────┘     │
├──────────────────────┤
│  Serviciile noastre  │
│  ┌─────────────┐     │
│  │ Card        │     │ ← 1 categorie pe linie
│  │ categorie   │     │
│  └─────────────┘     │
│  (×8 carduri)        │
├──────────────────────┤
│  Footer (4 secțiuni  │
│   stivuite vertical) │
└──────────────────────┘
```

## 5.2. Pagina listă servicii — `/servicii`

```
┌────────────────────────────────────────────────────────────┐
│  [LOGO]    Acasă  Despre  Servicii ▼  Contacte             │
├────────────────────────────────────────────────────────────┤
│                                                            │
│   Serviciile noastre                                       │
│   ─────────────────                                        │
│   Paragraf introductiv...                                  │
│                                                            │
│   ┌────────┐  ┌────────┐  ┌────────┐  ┌────────┐          │
│   │ Categ 1│  │ Categ 2│  │ Categ 3│  │ Categ 4│          │ ← 4 coloane desktop
│   └────────┘  └────────┘  └────────┘  └────────┘          │
│   ┌────────┐  ┌────────┐  ┌────────┐  ┌────────┐          │
│   │ Categ 5│  │ Categ 6│  │ Categ 7│  │ Categ 8│          │
│   └────────┘  └────────┘  └────────┘  └────────┘          │
│                                                            │
├────────────────────────────────────────────────────────────┤
│   FOOTER                                                   │
└────────────────────────────────────────────────────────────┘
```

**Responsive:**
- Desktop (≥ 992 px): 4 coloane.
- Tabletă (768–991 px): 2 coloane.
- Mobil (< 768 px): 1 coloană.

## 5.3. Pagina detaliu categorie — `/servicii/{slug}`

```
┌────────────────────────────────────────────────────────────┐
│  [LOGO]    Acasă  Despre  Servicii ▼  Contacte             │
├────────────────────────────────────────────────────────────┤
│  Acasă > Servicii > Căni personalizate                     │ ← breadcrumbs
├────────────────────────────────────────────────────────────┤
│   Căni personalizate                                       │
│   Descriere completă a categoriei...                       │ ← hero categorie
├────────────────────────────────────────────────────────────┤
│   Produse disponibile                                      │
│   ┌────────┐  ┌────────┐  ┌────────┐                       │
│   │[imag.] │  │[imag.] │  │[imag.] │                       │ ← 3 col desktop
│   │ Produs1│  │ Produs2│  │ Produs3│                       │
│   │ de la X│  │ de la X│  │ de la X│                       │
│   │[Comand]│  │[Comand]│  │[Comand]│                       │
│   └────────┘  └────────┘  └────────┘                       │
│   ┌────────┐  ┌────────┐  ┌────────┐                       │
│   │ Produs4│  │ Produs5│  │ Produs6│                       │
│   └────────┘  └────────┘  └────────┘                       │
├────────────────────────────────────────────────────────────┤
│   Cum se comandă (4 pași)                                  │
├────────────────────────────────────────────────────────────┤
│   Detalii tehnice                                          │
│   - Material...                                            │
│   - Dimensiuni...                                          │
│   - Timp execuție...                                       │
├────────────────────────────────────────────────────────────┤
│   FOOTER                                                   │
└────────────────────────────────────────────────────────────┘
```

**Responsive:**
- Desktop: 3 coloane produse.
- Tabletă: 2 coloane.
- Mobil: 1 coloană.

## 5.4. Pagina de contacte — `/contacte`

```
┌──────────────────────────────────────────────────────────────────────────┐
│  [LOGO]    Acasă  Despre  Servicii ▼  Contacte                           │
├──────────────────────────────────────────────────────────────────────────┤
│                                                                          │
│   Contactează-ne                                                         │
│                                                                          │
│   ┌─────────────────────────┐    ┌────────────────────────────────────┐ │
│   │  Date contact           │    │  Trimite-ne un mesaj               │ │
│   │  ─────────────          │    │  ─────────────────                 │ │
│   │  📞 +373 22 123 456     │    │  Nume:    [_________________]      │ │
│   │  ✉ contact@...          │    │  Email:   [_________________]      │ │
│   │  📍 Chișinău, str. ...  │    │  Telefon: [_________________]      │ │
│   │  🕒 L-V 09:00-18:00     │    │  Subiect: [▼ Întrebare generală  ] │ │
│   │      S   09:00-14:00    │    │  Mesaj:                            │ │
│   │      D   închis         │    │  [_____________________________]   │ │
│   │                         │    │  [_____________________________]   │ │
│   │                         │    │  [_____________________________]   │ │
│   │                         │    │                                    │ │
│   │                         │    │  [Trimite mesajul]                 │ │
│   └─────────────────────────┘    └────────────────────────────────────┘ │
│                                                                          │
│   ┌──────────────────────────────────────────────────────────────────┐  │
│   │            🗺  HARTĂ CHIȘINĂU (placeholder)                       │  │
│   │            (în viitor: iframe Google Maps)                       │  │
│   └──────────────────────────────────────────────────────────────────┘  │
├──────────────────────────────────────────────────────────────────────────┤
│   FOOTER                                                                 │
└──────────────────────────────────────────────────────────────────────────┘
```

**Responsive:**
- Desktop: 2 coloane (date contact + formular, alăturate).
- Tabletă / mobil: 1 coloană (datele de contact apar primele, apoi formularul, apoi harta).

**Comportament la submit:**
- Validare client-side (JS) → dacă invalid, se afișează alert.
- Validare server-side (Laravel) → dacă invalid, se reîncarcă pagina cu erorile afișate sub fiecare câmp prin `@error`.
- Dacă valid: salvare în `mesaje_contact` + redirect cu flash `session('success')`.

## 5.5. Pagina „Despre noi" — `/despre`

```
┌────────────────────────────────────────────────────────────┐
│  [LOGO]    Acasă  Despre  Servicii ▼  Contacte             │
├────────────────────────────────────────────────────────────┤
│   Despre FotoMoments                                       │
│                                                            │
│   ┌──────────────────────────────────────────────────┐    │
│   │ Istoric (3-4 paragrafe text)                     │    │
│   │ ...                                              │    │
│   └──────────────────────────────────────────────────┘    │
├────────────────────────────────────────────────────────────┤
│   Echipa noastră                                           │
│   ┌────────┐  ┌────────┐  ┌────────┐                       │
│   │[avatar]│  │[avatar]│  │[avatar]│                       │
│   │ Nume 1 │  │ Nume 2 │  │ Nume 3 │                       │
│   │ Rol    │  │ Rol    │  │ Rol    │                       │
│   └────────┘  └────────┘  └────────┘                       │
├────────────────────────────────────────────────────────────┤
│   Valorile noastre                                         │
│   ┌────────┐  ┌────────┐  ┌────────┐                       │
│   │ [icon] │  │ [icon] │  │ [icon] │                       │
│   │Calitate│  │Rapidit.│  │ Abord. │                       │
│   │        │  │        │  │indiv.  │                       │
│   └────────┘  └────────┘  └────────┘                       │
├────────────────────────────────────────────────────────────┤
│   FOOTER                                                   │
└────────────────────────────────────────────────────────────┘
```

**Responsive:**
- Desktop: 3 carduri pe rând (echipă și valori).
- Tabletă: 2 + 1 sau 3 dacă încap.
- Mobil: 1 card pe rând.

## 5.6. Reguli generale de responsive

| Element | Desktop (≥ 992 px) | Tabletă (768–991 px) | Mobil (< 768 px) |
|---|---|---|---|
| Navbar | Orizontal complet | Colapsat sub buton ☰ | Colapsat sub buton ☰ |
| Grila categorii (home) | 4 coloane | 2 coloane | 1 coloană |
| Grila produse | 3 coloane | 2 coloane | 1 coloană |
| Hero (text + imagine) | Două coloane (50%/50%) | Două coloane (50%/50%) | Stivuite vertical |
| Beneficii / valori | 3 coloane | 3 sau 2 coloane | 1 coloană |
| Footer | 4 coloane | 2 coloane | 1 coloană (stivuit) |
| Formular contact | 2 coloane | 1 coloană | 1 coloană |

Toate componentele folosesc clasele Bootstrap 5 `col-12 col-md-6 col-lg-4 col-xl-3` (sau similare) pentru a obține comportarea de mai sus fără media queries custom.
