# 04. Elementele de conținut (AS4)

## 4.1. Categoriile de produse / servicii

Site-ul prezintă **8 categorii principale** de servicii, fiecare având 6 produse exemplificative. Toate categoriile și produsele sunt stocate în baza de date și citite dinamic în view-urile Blade.

| # | Slug (URL) | Denumire | Descriere scurtă | Tipuri de obiecte personalizabile |
|---|---|---|---|---|
| 1 | `cani` | Căni personalizate | Cadou clasic și emoțional, perfect pentru orice ocazie. | Cană albă ceramică 330ml, cană magică termoactivă, cană bicoloră, cană cu interior colorat, cană termică din inox, cană pentru copii |
| 2 | `tricouri-maiouri` | Tricouri și maiouri | Imprimare durabilă pe textile de calitate, pentru orice vârstă. | Tricou alb bumbac 100%, tricou polo, tricou copii, tricou damă fit, maiou damă, tricou cu mâneci raglan |
| 3 | `brelocuri` | Brelocuri | Mici, practice, ușor de purtat — un cadou cu impact emoțional. | Breloc metal dreptunghi, breloc inimă, breloc din lemn, breloc plexiglas, breloc dublu (foto față-verso), breloc rotund |
| 4 | `perne` | Perne personalizate | Confort și amintiri, într-un singur cadou. | Pernă decorativă 40×40, pernă călătorie tip C, pernă copii cu desene, pernă mare 50×70, pernă cu față foto + spate text, pernă rotundă |
| 5 | `puzzle` | Puzzle personalizate | Jocul de copilărie reinterpretat ca amintire vie. | Puzzle 60 piese A5, puzzle 120 piese A4, puzzle 240 piese A4, puzzle 500 piese A3, puzzle din lemn, puzzle pentru copii formă inimă |
| 6 | `ceasuri` | Ceasuri personalizate | Timpul tău, decorat cu cele mai dragi imagini. | Ceas de perete rotund 30cm, ceas de perete pătrat 30×30, ceas mare 40cm, ceas de masă cu poză, ceas digital cu cadran personalizat, ceas pentru copii |
| 7 | `farfurii` | Farfurii personalizate | Decorative sau funcționale — un cadou rafinat. | Farfurie ceramică Ø20cm, farfurie Ø25cm decorativă, farfurie rectangulară 20×25, farfurie cu suport, set 2 farfurii, farfurie pentru copii |
| 8 | `tipar-fotografii` | Tipar fotografii | Fotografii imprimate profesional, în orice format. | Format 10×15 cm, format 13×18 cm, format 15×20 cm, format A4 (21×29.7), format A3 (29.7×42), pachet 50 poze 10×15 |

## 4.2. Date stocate pentru fiecare categorie

În tabela `categorii`:

- `slug` — identificatorul unic folosit în URL (ex: `cani` → `/servicii/cani`);
- `denumire` — afișată în carduri, titluri și meniu;
- `descriere_scurta` — o singură propoziție evocativă, folosită pe carduri;
- `descriere_completa` — 3–4 propoziții, afișate în pagina detaliu;
- `imagine` — calea către fișierul SVG/JPG din `public/img/placeholders/`;
- `ordine_afisare` — număr întreg pentru sortare în meniu și grilă;
- `activ` — flag boolean (permite ascunderea unei categorii fără ștergere).

## 4.3. Date stocate pentru fiecare produs

În tabela `produse`:

- `categorie_id` — cheie străină către categoria părinte (relație 1:N);
- `denumire` — titlul produsului;
- `descriere` — text descriptiv (2–4 propoziții);
- `imagine` — calea către fișierul de placeholder;
- `pret_de_la` — preț de pornire în MDL (decimal 8,2);
- `caracteristici` — câmp JSON care stochează detalii tehnice flexibile (material, dimensiune, capacitate etc.);
- `activ` — flag boolean.

## 4.4. Elemente de conținut comune

În afara catalogului dinamic, site-ul conține:

- **Texte statice de prezentare** — în paginile `home`, `despre`, `contacte`;
- **Imagini placeholder** — SVG-uri generate local în `public/img/placeholders/`, suficiente pentru demonstrație (vor putea fi înlocuite ulterior cu fotografii reale);
- **Date de contact** — telefon, email, adresă, program de lucru (stocate inițial direct în Blade, urmând a fi mutate într-un fișier `config` într-o etapă ulterioară);
- **Conținut SEO de bază** — `<title>`, `<meta description>` setate per pagină prin secțiuni Blade.

## 4.5. Tipul site-ului ales și justificarea

### 4.5.1. Tipul ales

**Site de prezentare cu catalog dinamic** (fără e-commerce real în această etapă).

### 4.5.2. Justificarea alegerii

Pentru săptămânile 1–2 ale stagiului de practică s-a optat pentru un **site de prezentare cu catalog dinamic** din următoarele motive:

1. **Scop principal informativ:** clientul (Infinity SRL) și-a exprimat ca prioritate prezentarea profesională a serviciilor, nu vânzarea online directă. Comenzile se finalizează în continuare prin contact telefonic sau vizită la atelier, conform modelului real FotoMoments.
2. **Complexitate adecvată stagiului:** un site de prezentare cu catalog dinamic îmi permite să demonstrez în primele 2 săptămâni competențele de bază (Laravel, Eloquent, Blade, Bootstrap, MySQL, migrate-uri, seedere, validare formular). Un e-commerce real ar necesita integrare de plăți (Stripe, MAIB, mobilPay), gestiune coș de cumpărături și procesare comenzi — toate funcționalități rezervate săptămânilor ulterioare (AS11–AS28).
3. **Pregătirea pentru extindere:** schema bazei de date include deja tabelele `clienti` și `comenzi`, neumplute încă, dar care anticipează viitorul flux de e-commerce. Astfel, etapa de astăzi nu este o „fundătură" tehnică, ci o fundație validă pentru creșterea ulterioară.
4. **Coerență cu modelul real:** site-ul fotomoments.md este în sine un site de prezentare cu catalog, nu un magazin online complet — deci clonarea respectă fidel modelul cerut de client.

### 4.5.3. Caracteristicile site-ului de prezentare cu catalog dinamic

- Cataloagele de categorii și produse sunt **citite din baza de date** la fiecare cerere (sau cache-uite pentru performanță);
- Nu există coș de cumpărături, sesiune de cumpărător, sau procesare plăți;
- Există un **formular de contact funcțional** care salvează cererile în baza de date și poate, opțional, trimite un email firmei (funcționalitate ce poate fi adăugată ulterior);
- Site-ul este **public, fără autentificare** (autentificarea va fi adăugată doar pentru un eventual panou administrativ în săptămânile 3–8).

## 4.6. Evoluția planificată

În etapele următoare (săptămânile 3–8, activitățile AS11–AS28), conținutul va fi îmbogățit cu:

- Galerie reală de fotografii cu produse executate;
- Mărturii și recenzii de la clienți;
- Blog cu sfaturi pentru cadouri personalizate;
- Panou administrativ pentru actualizarea catalogului fără a modifica codul;
- (Opțional) sistem complet de comenzi online, integrat cu plata și livrarea.
