@extends('layouts.app')

@section('title', 'Despre noi')
@section('description', 'Despre FotoMoments — istoricul firmei, echipa și valorile care ne ghidează din 2006.')

@section('content')
    <section class="categorie-hero">
        <div class="container">
            <h1>Despre FotoMoments</h1>
            <p>
                Suntem o echipă pasionată de personalizare, dedicată să transforme amintirile clienților noștri
                în obiecte unice. Activăm din 2006 în Chișinău.
            </p>
        </div>
    </section>

    {{-- Istoric --}}
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="section-title text-start">
                        <h2 class="text-start">Povestea noastră</h2>
                    </div>

                    <p>
                        FotoMoments a luat naștere în anul 2006, în Chișinău, dintr-o idee simplă: oamenii merită cadouri
                        care să spună o poveste personală. Atunci, un grup mic de pasionați a deschis un atelier modest,
                        echipat cu o singură presă de sublimare termică, și a început să imprime fotografii pe căni
                        ceramice pentru clienții din cartier.
                    </p>

                    <p>
                        În anii care au urmat, am investit constant în tehnologii moderne: presă DTG (Direct to Garment)
                        pentru tricouri, gravare cu laser pentru brelocuri din lemn și metal, hârtie foto profesională
                        Fujifilm pentru tipar fotografic. Am extins gama de produse de la căni la perne, puzzle, ceasuri,
                        farfurii și textile diverse — astăzi acoperim 8 categorii principale, cu zeci de variante pe categorie.
                    </p>

                    <p>
                        Am crescut împreună cu clienții noștri, învățând din fiecare comandă. Astăzi, FotoMoments este o
                        referință pe piața din Chișinău pentru calitate și rapiditate. Executăm comenzi standard pe loc,
                        în 10–20 de minute, dar și proiecte complexe pentru companii și evenimente — nunți, botezuri,
                        conferințe corporate, materiale promoționale.
                    </p>

                    <p>
                        Misiunea noastră rămâne aceeași ca în 2006: să transformăm amintirile clienților în obiecte de
                        cadou care durează o viață. Pentru fiecare comandă, lucrăm cu atenție la detalii, indiferent
                        dacă este o cană sau un set de 100 de tricouri pentru o firmă.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Echipa --}}
    <section class="bg-white">
        <div class="container">
            <div class="section-title">
                <h2>Echipa noastră</h2>
                <p>Oamenii din spatele fiecărei comenzi.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="card-membru">
                        <i class="bi bi-person-circle" style="font-size: 7rem; color: #e91e63;" aria-hidden="true"></i>
                        <h3 class="h5 mt-3">Andrei Popescu</h3>
                        <p class="text-muted">Fondator &amp; Director</p>
                        <p>Pasiunea pentru personalizare l-a determinat să fondeze FotoMoments în 2006.</p>
                    </article>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="card-membru">
                        <i class="bi bi-person-circle" style="font-size: 7rem; color: #3498db;" aria-hidden="true"></i>
                        <h3 class="h5 mt-3">Maria Ionescu</h3>
                        <p class="text-muted">Designer Grafic</p>
                        <p>Creează machetele și se asigură că fiecare comandă arată impecabil.</p>
                    </article>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="card-membru">
                        <i class="bi bi-person-circle" style="font-size: 7rem; color: #2ecc71;" aria-hidden="true"></i>
                        <h3 class="h5 mt-3">Victor Cebotari</h3>
                        <p class="text-muted">Operator imprimare</p>
                        <p>Operează echipamentele de imprimare și control de calitate al produselor.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    {{-- Valori --}}
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Valorile noastre</h2>
                <p>Trei principii care ne ghidează în fiecare zi.</p>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <article class="card-valoare">
                        <i class="bi bi-stars" aria-hidden="true"></i>
                        <h3 class="h5">Calitate</h3>
                        <p>Folosim materiale premium și echipamente profesionale pentru rezultate care durează ani de zile.</p>
                    </article>
                </div>
                <div class="col-12 col-md-4">
                    <article class="card-valoare">
                        <i class="bi bi-lightning-charge" aria-hidden="true"></i>
                        <h3 class="h5">Rapiditate</h3>
                        <p>Executăm comenzile standard pe loc, în 10–20 de minute. Timpul tău este valoros.</p>
                    </article>
                </div>
                <div class="col-12 col-md-4">
                    <article class="card-valoare">
                        <i class="bi bi-people" aria-hidden="true"></i>
                        <h3 class="h5">Abordare individuală</h3>
                        <p>Fiecare client este unic. Ascultăm, sfătuim și creăm produse care reflectă povestea ta.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
