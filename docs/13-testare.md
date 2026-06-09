# 13. Testare automată și manuală (AS18–AS20)

> **Activități curriculare:**
> - AS18 — Testarea interfeței cu utilizatorul a site-ului web
> - AS19 — Aplicarea tehnicilor și instrumentelor de testare la testarea site-lui web
> - AS20 — Testarea funcționalității legăturilor interne și externe a site-ului
>
> **Date conform calendarului:** 25.05–03.06.2026

## 13.1. Stack de testare ales

- **Pest 3** — framework de testare modern pentru PHP/Laravel (sintaxă mai concisă decât PHPUnit clasic);
- **PHPUnit 11** — runner sub-iacent folosit de Pest;
- **SQLite in-memory** — bază de date efemeră pentru fiecare suite de teste (rulare rapidă, fără efect asupra DB-ului real);
- **RefreshDatabase trait** — re-creează schema înainte de fiecare test, garantând izolare.

Configurația este în [`phpunit.xml`](../phpunit.xml) și [`tests/Pest.php`](../tests/Pest.php).

## 13.2. Structura testelor

```
tests/
├── Pest.php                          (bootstrap Pest)
├── TestCase.php                      (clasa de bază)
├── Feature/
│   ├── PublicRoutesTest.php          (11 teste — rute publice)
│   ├── ContactFormTest.php           (6 teste — validare + persistență)
│   ├── NewsletterTest.php            (4 teste — formular footer)
│   ├── AuthAndAdminTest.php          (12 teste — login + CRUD admin)
│   ├── SearchAndGalleryTest.php      (7 teste — căutare + galerie)
│   ├── LinksAndNavigationTest.php    (7 teste — link integrity AS20)
│   └── SecurityTest.php              (14 teste — securitate AS22)
└── Unit/
    └── ModelsTest.php                 (10 teste — relații + casts modele)
```

**Total: 71 teste cu ~180 aserțiuni**, durata totală ~2 secunde.

## 13.3. Cum se rulează

### Toate testele

```bash
./vendor/bin/pest
```

### Doar un fișier

```bash
./vendor/bin/pest tests/Feature/PublicRoutesTest.php
```

### Cu cod coverage (necesită xdebug)

```bash
./vendor/bin/pest --coverage
```

### Doar testele care au eșuat la rularea precedentă

```bash
./vendor/bin/pest --filter=failed
```

## 13.4. AS18 — Testarea interfeței

Acoperită prin `PublicRoutesTest.php`:

- toate cele 9 rute publice principale returnează HTTP 200;
- pagina principală conține numele brandului „Infinity";
- categoriile se afișează corect (citite din DB);
- pagina detaliu categorie afișează cele 3 produse de test;
- 404 pe slug inexistent;
- redirect 302 pentru `/admin` fără sesiune.

Și prin `SearchAndGalleryTest.php`:

- căutarea găsește produse după denumire ȘI după descriere;
- query string < 2 caractere nu returnează rezultate;
- filtrul galeriei după categorie funcționează;
- lucrările inactive nu se afișează.

## 13.5. AS19 — Tehnici și instrumente de testare

### 13.5.1. Tehnici aplicate

| Tehnică | Unde |
|---|---|
| Smoke testing | toate paginile returnează 200 |
| Boundary testing | căutarea sub 2 caractere, mesaj sub 10 caractere |
| Equivalence partitioning | email valid vs invalid (clasă de validare) |
| Negative testing | parolă greșită, slug inexistent, payload SQL injection |
| Database state assertions | `expect(MesajContact::count())->toBe(1)` |
| Behavior assertions | `assertRedirect`, `assertSessionHas`, `assertSee` |
| Authenticated testing | `$this->actingAs($user)` |

### 13.5.2. Patterns Pest folosite

```php
beforeEach(function () { ... });   // setup comun
it('descriere', function () { ... }); // test individual
expect($x)->toBe(...);             // assertions
$this->get('/url');                // HTTP request
$this->actingAs($user);            // autentificare
```

## 13.6. AS20 — Testarea legăturilor

Acoperită prin `LinksAndNavigationTest.php`:

- toate cele 6 rute principale → HTTP 200;
- navbar conține link-urile către toate paginile principale (verificare prin `assertSee` pe href);
- dropdown servicii conține link-uri către categoriile din DB;
- footer conține `tel:` și `mailto:` valide;
- breadcrumbs conțin link-uri către părinte;
- logo este link către `/`;
- buton back-to-top există pe toate paginile.

### Audit manual link-uri externe

Tabel cu link-urile externe din site:

| Locație | URL | Status |
|---|---|---|
| Footer / Social | `#` (placeholder Facebook) | ❌ inactiv intenționat |
| Footer / Social | `#` (placeholder Instagram) | ❌ inactiv intenționat |
| Footer / Social | `#` (placeholder WhatsApp) | ❌ inactiv intenționat |
| Layout SCSS | `fonts.googleapis.com/css2?family=Inter` | ✅ activ |

În producție (după AS26), linkurile sociale vor fi înlocuite cu URL-uri reale.

## 13.7. Beneficii observate

- **regression prevention** — orice modificare în controllere/modele/rute care strică funcționalitatea existentă este prinsă imediat;
- **documentație vie** — testele descriu în română comportamentul așteptat (`it încarcă pagina principală cu status 200`);
- **CI-ready** — testele pot rula pe GitHub Actions, GitLab CI sau orice runner.

## 13.8. Output exemplu

```
PASS  Tests\Feature\PublicRoutesTest
  ✓ it încarcă pagina principală cu status 200
  ✓ it afișează categoriile pe pagina principală
  ✓ it încarcă pagina despre
  ✓ ... (8 more)

PASS  Tests\Feature\ContactFormTest
  ✓ ... (6 tests)

...

Tests:    70 passed, 1 risky (175 assertions)
Duration: 1.80s
```
