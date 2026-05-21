# 03. Structura generală a site-ului (AS3)

## 3.1. Sitemap (arbore al paginilor)

```
FotoMoments (Site)
│
├── /  (Acasă)
│   ├── Secțiune: Hero (titlu + CTA)
│   ├── Secțiune: Beneficii (3 carduri)
│   ├── Secțiune: Servicii (grilă cu 8 categorii)
│   ├── Secțiune: Proces de lucru (4 pași)
│   └── Secțiune: CTA contact (banner)
│
├── /despre  (Despre noi)
│   ├── Secțiune: Istoric firmă
│   ├── Secțiune: Echipa (3 carduri)
│   └── Secțiune: Valori (3 carduri)
│
├── /servicii  (Listă toate categoriile)
│   └── Grilă cu 8 carduri categorii (link către detalii)
│
├── /servicii/{slug}  (Detaliu categorie)
│   ├── Breadcrumbs
│   ├── Hero categorie (titlu + descriere)
│   ├── Grilă produse (6 produse din categorie)
│   ├── Secțiune: Cum se comandă
│   └── Secțiune: Detalii tehnice
│
└── /contacte  (Contacte)
    ├── Date contact (telefon, email, adresă, program)
    ├── Formular contact (POST → /contacte)
    └── Hartă embed (placeholder)

— Comune tuturor paginilor —
├── Header (navbar responsive)
│   ├── Logo „FotoMoments"
│   ├── Link: Acasă
│   ├── Link: Despre noi
│   ├── Dropdown: Servicii (8 categorii dinamice)
│   └── Link: Contacte
│
└── Footer
    ├── Coloana 1: Despre noi (scurt)
    ├── Coloana 2: Servicii (link-uri)
    ├── Coloana 3: Contact (date)
    ├── Coloana 4: Program de lucru
    └── Linie copyright
```

## 3.2. Descrierea fiecărei pagini

### 3.2.1. Pagina principală (Acasă) — `/`

- **Rol:** punctul de intrare al utilizatorului. Trebuie să comunice rapid identitatea firmei (cine este FotoMoments), ce face (imprimare personalizată) și de ce ar trebui ales (rapid, calitativ, experiență).
- **Conținut principal:**
  - Hero cu titlu evocativ („Momentele tale prețioase, imprimate pentru totdeauna"), subtitlu descriptiv și 2 butoane CTA („Vezi serviciile" / „Contactează-ne");
  - 3 carduri de beneficii (Experiență din 2006, Executare pe loc 10–20 min, Calitate înaltă) cu iconițe;
  - Grila celor 8 categorii (citită dinamic din tabela `categorii`), fiecare card având imagine, denumire, descriere scurtă și buton către detalii;
  - Secțiune cu cei 4 pași ai procesului de comandă;
  - Banner CTA contact cu telefon afișat mare.
- **Public țintă:** vizitatori noi care descoperă firma pentru prima dată.

### 3.2.2. Pagina „Despre noi" — `/despre`

- **Rol:** consolidarea încrederii vizitatorului prin prezentarea istoricului, echipei și valorilor firmei.
- **Conținut principal:**
  - 3–4 paragrafe despre istoricul firmei (din 2006);
  - 3 carduri „membri echipă" (placeholder);
  - 3 carduri „valori" (Calitate, Rapiditate, Abordare individuală).
- **Public țintă:** vizitatori care doresc să afle mai multe despre firmă înainte de a comanda.

### 3.2.3. Pagina „Servicii" (index) — `/servicii`

- **Rol:** punctul central de explorare a tuturor categoriilor de servicii.
- **Conținut principal:**
  - Titlu paginii + paragraf introductiv;
  - Grila cu toate cele 8 categorii (carduri identice cu cele de pe pagina principală, dar fără limitare).
- **Public țintă:** vizitatori care caută un anumit tip de personalizare.

### 3.2.4. Pagina detaliu categorie — `/servicii/{slug}`

- **Rol:** prezentarea concretă a unei singure categorii și a produselor sale, cu detaliile necesare pentru o decizie de comandă.
- **Conținut principal:**
  - Breadcrumbs (Acasă / Servicii / Numele categoriei);
  - Hero al categoriei cu titlu și descriere completă;
  - Grila cu cele 6 produse (imagine, denumire, descriere, preț „de la X MDL", buton de comandă);
  - Secțiune „Cum se comandă" cu 4 pași;
  - Secțiune „Detalii tehnice" (materiale, dimensiuni standard, timp de execuție).
- **Public țintă:** vizitatori interesați de o categorie specifică.

### 3.2.5. Pagina „Contacte" — `/contacte`

- **Rol:** facilitarea contactului direct cu firma.
- **Conținut principal:**
  - Card cu date complete (telefon clicabil `tel:`, email clicabil `mailto:`, adresă, program de lucru);
  - Formular de contact (nume, email, telefon opțional, subiect dropdown, mesaj textarea, buton submit);
  - Placeholder hartă embed.
- **Public țintă:** vizitatori pregătiți să ia legătura cu firma.

## 3.3. Fluxul de navigare al utilizatorului

```
START ─┐
       ▼
┌──────────────┐   click „Vezi serviciile"
│   /  (Home)  ├──────────────────────────────┐
└──────┬───────┘                              │
       │ click card categorie                 ▼
       │                            ┌──────────────────┐
       │                            │   /servicii      │
       │                            │  (index)         │
       │                            └────────┬─────────┘
       │                                     │ click card categorie
       ▼                                     ▼
┌────────────────────────────────────────────────┐
│              /servicii/{slug}                  │
│           (detaliu categorie)                  │
└────────┬───────────────────────────┬───────────┘
         │ click „Comandă"           │ click navbar „Despre"
         ▼                           ▼
┌────────────────┐         ┌──────────────┐
│  /contacte     │         │   /despre    │
│  (formular)    │         └──────┬───────┘
└────────┬───────┘                │
         │ submit valid           │
         ▼                        ▼
   ┌─────────────────┐   ┌──────────────┐
   │ flash succes +  │   │  navigare    │
   │ rând în DB      │   │  spre orice  │
   └─────────────────┘   │  altă pagină │
                         └──────────────┘
```

### Scenarii principale de navigare

- **Scenariul „vizitator nou":** Acasă → click pe o categorie → pagina detaliu categorie → click „Comandă" → pagina contacte → completare formular → mesaj salvat în DB.
- **Scenariul „client interesat":** Acasă → Despre noi → Servicii (index) → detaliu categorie → contacte.
- **Scenariul „cerere ofertă corporativă":** Acasă → Contacte → completare formular cu subiectul „Cerere ofertă".

## 3.4. Sistemul de navigare

- **Navbar** este prezent pe toate paginile, fix în partea de sus.
- **Pe desktop** (≥ 992 px): toate link-urile sunt vizibile orizontal.
- **Pe tabletă/mobil** (< 992 px): meniul colapsează într-un buton „hamburger" și se deschide ca dropdown vertical.
- **Dropdown-ul „Servicii"** din navbar este populat **dinamic** cu cele 8 categorii din baza de date, prin `View::composer` în `AppServiceProvider`.
- **Footer-ul** repetă structura navigației și adaugă date de contact, pentru a oferi acces rapid din partea de jos a oricărei pagini.
