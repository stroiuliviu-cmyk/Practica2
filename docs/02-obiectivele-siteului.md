# 02. Obiectivele site-ului (AS2)

## 2.1. Obiectivul principal

**Realizarea unui site web de prezentare modern, responsive și ușor de utilizat**, care să promoveze serviciile de imprimare personalizată oferite de FotoMoments (clientul Infinity SRL), să afișeze dinamic catalogul de produse din baza de date și să faciliteze contactul clienților cu firma prin formular online și date complete de contact.

## 2.2. Obiective secundare

1. **Creșterea vizibilității online** a firmei și consolidarea brandului FotoMoments pe piața din Chișinău, prin prezentarea profesională a serviciilor și a produselor.
2. **Educarea publicului** privind tipurile de obiecte care pot fi personalizate și procesul concret de comandă (alegere obiect → trimitere fișier → verificare machetă → primire produs).
3. **Captarea cererilor de ofertă și a întrebărilor** prin formularul de contact validat și prin afișarea telefonului, adresei și programului de lucru pe toate paginile.
4. **Reducerea numărului de apeluri repetitive** cu întrebări frecvente, prin includerea informațiilor relevante (preț de la, materiale, dimensiuni, timp de execuție) direct în paginile de servicii.
5. **Pregătirea infrastructurii** pentru o etapă ulterioară de dezvoltare (autentificare clienți, panou administrativ pentru gestionarea catalogului, sistem de comenzi online), prin folosirea unei arhitecturi MVC clare (Laravel) și a unei baze de date relaționale normalizate.

## 2.3. Cerințe funcționale exprimate de client

Clientul (Infinity SRL) a formulat următoarele cerințe funcționale pentru prima etapă de dezvoltare (săptămânile 1–2 ale stagiului de practică):

1. **CF-01:** Site-ul trebuie să afișeze o pagină principală (home) cu mesaj de întâmpinare, prezentare scurtă a firmei și grila celor 8 categorii principale de servicii.
2. **CF-02:** Site-ul trebuie să conțină o pagină dedicată „Despre noi" cu istoricul firmei, valorile sale și prezentarea echipei.
3. **CF-03:** Site-ul trebuie să afișeze o pagină centralizatoare a tuturor categoriilor de servicii, cu link individual către fiecare.
4. **CF-04:** Pentru fiecare categorie, site-ul trebuie să afișeze o pagină dedicată cu produsele specifice și detaliile lor (denumire, descriere, preț de pornire, caracteristici tehnice).
5. **CF-05:** Site-ul trebuie să conțină o pagină de contacte cu date complete (telefon, email, adresă, program de lucru) și un formular de contact funcțional.
6. **CF-06:** Formularul de contact trebuie să valideze datele introduse (atât client-side, cât și server-side) și să salveze mesajele într-o tabelă dedicată a bazei de date.
7. **CF-07:** Toate datele afișate (categorii, produse) trebuie să fie citite **dinamic din baza de date**, nu codate static în view-uri, pentru a permite actualizarea ulterioară fără modificări de cod.
8. **CF-08:** Site-ul trebuie să fie **complet responsive** (compatibil cu telefoane, tablete și desktop) și să respecte standardele de accesibilitate de bază (WCAG AA).

## 2.4. Cerințe nefuncționale

- **Performanță:** timp de încărcare al paginilor sub 2 secunde pe o conexiune obișnuită (≥ 5 Mbps);
- **Compatibilitate:** funcționare corectă pe ultimele două versiuni majore ale browserelor Chrome, Firefox, Edge, Safari;
- **Limba:** tot conținutul în limba română, cu diacritice corecte;
- **Securitate:** protecție CSRF pe toate formularele POST, validare strictă a datelor de intrare, parametrizare prin Eloquent ORM (fără SQL brut);
- **Scalabilitate:** arhitectură modulară care să permită adăugarea ulterioară a unui panou administrativ și a unui sistem de comenzi.

## 2.5. Criterii de succes

Site-ul va fi considerat un livrabil reușit dacă, la sfârșitul săptămânilor 1–2 de practică, sunt îndeplinite cumulativ următoarele criterii:

1. Există 5 pagini publice funcționale: **Acasă, Despre, Servicii (index), Servicii (detaliu categorie), Contacte**;
2. Pagina principală afișează cele **8 categorii** încărcate dinamic din tabela `categorii`;
3. Pagina de detaliu categorie afișează **6 produse** încărcate dinamic din tabela `produse` (filtrate după `categorie_id`);
4. Formularul de contact validează corect datele și **salvează un rând** în tabela `mesaje_contact`, iar utilizatorul primește un mesaj de confirmare;
5. Site-ul este responsive la breakpoint-urile **375 px, 768 px și 1200 px** (smartphone, tabletă, desktop);
6. Codul respectă convențiile **PSR-12** pentru PHP și separarea clară între logica de business (controllere), date (modele) și prezentare (view-uri Blade);
7. Există documentație completă în folderul `docs/` care acoperă toate activitățile **AS1–AS9** din curriculum;
8. Proiectul rulează local fără erori cu comanda `php artisan serve` + `npm run dev`, după ce baza de date a fost creată și populată cu seederele (`php artisan migrate --seed`).
