# 09. Elemente de navigare (AS11)

> **Activitate curriculară:** AS11 — Crearea elementelor de navigare pentru facilitarea parcurgerii conținutului paginii.
> **Data conform calendarului:** 14.05.2026

## 9.1. Obiectiv

Îmbunătățirea experienței utilizatorului prin adăugarea de elemente care facilitează parcurgerea conținutului site-ului — în special pe paginile lungi (detaliu categorie, galerie) și pentru găsirea rapidă a unui produs anume.

## 9.2. Elemente implementate

### 9.2.1. Navbar responsive cu dropdown dinamic

Bara de navigare principală a fost extinsă cu:

- **Logo** (imagine SVG cu logo-ul oficial Infinity SRL) care linkează la pagina principală;
- **Link „Acasă"** către `/`;
- **Link „Despre noi"** către `/despre`;
- **Dropdown „Servicii"** care listează automat cele 8 categorii din baza de date (populat prin `View::composer` în [AppServiceProvider](../app/Providers/AppServiceProvider.php));
- **Link „Galerie"** către `/galerie` (nou — vezi AS12);
- **Link „Contacte"** către `/contacte`;
- **Buton telefon** clicabil (`tel:`) pe partea dreaptă;
- **Buton Admin** (vizibil doar pentru utilizatorii autentificați cu rol admin).

Pe ecrane sub 992 px, navbar-ul colapsează într-un buton „hamburger".

### 9.2.2. Breadcrumbs

Toate paginile interne (servicii, categorii, galerie, contacte, login, admin) afișează un breadcrumb Bootstrap în partea de sus, sub formatul:

```
Acasă > Servicii > Căni personalizate
```

Aceasta permite utilizatorului să înțeleagă instant unde se află și să navigheze înapoi cu un click.

### 9.2.3. Bara de căutare în navbar

În navbar a fost adăugat un mic formular de căutare (`<form role="search">`) care trimite cererea către ruta `GET /cautare?q={query}`. Logica este implementată în [`ServiciuController@search`](../app/Http/Controllers/ServiciuController.php) și caută în coloanele `denumire` și `descriere` ale tabelei `produse`.

Pagina `resources/views/servicii/search.blade.php` afișează rezultatele ca o grilă de carduri produs, cu badge pentru categoria fiecărui produs.

**Reguli:** căutarea necesită minim 2 caractere (validare HTML5 + verificare PHP), limită 50 de rezultate.

### 9.2.4. Sortare pe pagina detaliu categorie

Pe `/servicii/{slug}` a fost adăugat un dropdown de sortare care permite afișarea produselor în 4 ordini diferite:

| Opțiune | Comportament |
|---|---|
| Implicit | Ordinea din DB (`order by id`) |
| Preț crescător | `order by pret_de_la asc` |
| Preț descrescător | `order by pret_de_la desc` |
| Denumire A–Z | `order by denumire asc` |

Sortarea se face server-side prin parametrul `?sort=pret_asc` etc. La schimbarea valorii din dropdown, formularul este trimis automat prin JavaScript (`onchange="this.form.submit()"`).

### 9.2.5. Buton „Înapoi sus" (back-to-top)

Un buton flotant a fost adăugat în colțul din dreapta-jos al tuturor paginilor. Devine vizibil când utilizatorul a derulat mai mult de 400 px în jos, iar la click derulează lin (smooth scroll) la începutul paginii.

Implementarea folosește IntersectionObserver-ul nativ al browserului (fără jQuery sau librării externe).

### 9.2.6. Highlight automat în navbar

Link-ul activ din navbar este evidențiat automat prin clasa `.active` (gestionată atât server-side via `request()->routeIs(...)` cât și client-side în [`resources/js/app.js`](../resources/js/app.js)).

### 9.2.7. Filtru categorii pe pagina galerie

Pe pagina `/galerie` (introdusă la AS12) există un set de butoane de filtrare după categorie. La click, pagina se reîncarcă cu parametrul `?categorie={slug}`, afișând doar lucrările din categoria respectivă.

## 9.3. Accesibilitate

Toate elementele de navigare respectă cerințele WCAG 2.1 AA:

- atribute `aria-label` pe butoane fără text vizibil;
- atribut `role="search"` pe formularul de căutare;
- atribut `aria-current="page"` pe link-ul activ din breadcrumb;
- atribut `aria-hidden="true"` pe iconițele decorative;
- navigare completă cu tastatura (Tab, Enter, Esc pentru închidere dropdown).

## 9.4. Verificare

| URL | Comportament așteptat |
|---|---|
| `/` | Carusel + carduri categorii + buton telefon |
| `/cautare?q=cana` | Listă produse care conțin „cana" în denumire/descriere |
| `/servicii/cani?sort=pret_asc` | Cele 6 căni, sortate crescător după preț |
| `/galerie?categorie=cani` | Doar lucrările din categoria căni |
| (scroll > 400px pe orice pagină) | Buton ↑ apare în colțul din dreapta-jos |
