@extends('layouts.app')

@section('title', $categorie->denumire)
@section('description', $categorie->descriere_scurta)

@section('content')
    <section class="categorie-hero">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Acasă</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('servicii.index') }}">Servicii</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $categorie->denumire }}</li>
                </ol>
            </nav>

            <h1>{{ $categorie->denumire }}</h1>
            <p>{{ $categorie->descriere_completa ?? $categorie->descriere_scurta }}</p>
        </div>
    </section>

    {{-- Produse --}}
    <section>
        <div class="container">
            <div class="section-title text-start">
                <h2 class="text-start">Produse disponibile</h2>
            </div>

            <div class="row g-4">
                @forelse($produse as $produs)
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card card-produs h-100">
                            <img src="{{ asset($produs->imagine ?? 'img/placeholders/prod-default.svg') }}"
                                 class="card-img-top"
                                 alt="{{ $produs->denumire }}"
                                 loading="lazy">
                            <div class="card-body d-flex flex-column">
                                <h3 class="h6">{{ $produs->denumire }}</h3>
                                <p class="card-text small text-muted flex-grow-1">{{ $produs->descriere }}</p>

                                @if(! empty($produs->caracteristici))
                                    <ul class="list-unstyled small mb-3">
                                        @foreach($produs->caracteristici as $cheie => $valoare)
                                            <li>
                                                <i class="bi bi-check-circle-fill text-primary me-1" aria-hidden="true"></i>
                                                <strong>{{ ucfirst($cheie) }}:</strong> {{ $valoare }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if($produs->pret_de_la)
                                    <div class="pret">de la {{ number_format($produs->pret_de_la, 0, ',', ' ') }} MDL</div>
                                @endif

                                <a href="{{ route('contacte.index') }}#form-contact"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-cart-plus me-1" aria-hidden="true"></i>Comandă
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Nu există produse active în această categorie momentan.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Cum se comandă --}}
    <section class="bg-white">
        <div class="container">
            <div class="section-title">
                <h2>Cum se comandă</h2>
                <p>Procesul nostru de comandă, simplu și transparent.</p>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="proces-pas">
                        <div class="numar">1</div>
                        <h4>Alege produsul</h4>
                        <p>Selectează din lista de mai sus produsul care ți se potrivește.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="proces-pas">
                        <div class="numar">2</div>
                        <h4>Contactează-ne</h4>
                        <p>Trimite-ne un mesaj sau sună-ne direct pentru a discuta detaliile.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="proces-pas">
                        <div class="numar">3</div>
                        <h4>Trimite fișierul</h4>
                        <p>Trimite-ne fotografia, logo-ul sau textul ce urmează să fie imprimat.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="proces-pas">
                        <div class="numar">4</div>
                        <h4>Primește produsul</h4>
                        <p>În 10–20 de minute pentru comenzi standard sau în 1–3 zile pentru cele complexe.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detalii tehnice --}}
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="section-title text-start">
                        <h2 class="text-start">Detalii tehnice</h2>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent">
                            <i class="bi bi-tools text-primary me-2" aria-hidden="true"></i>
                            <strong>Tehnologie de imprimare:</strong> sublimare termică, DTG sau gravare laser, în funcție de material.
                        </li>
                        <li class="list-group-item bg-transparent">
                            <i class="bi bi-droplet text-primary me-2" aria-hidden="true"></i>
                            <strong>Cerneluri:</strong> originale, ecologice, certificate non-toxice.
                        </li>
                        <li class="list-group-item bg-transparent">
                            <i class="bi bi-shield-check text-primary me-2" aria-hidden="true"></i>
                            <strong>Garanție durabilitate:</strong> minim 3 ani la utilizare normală.
                        </li>
                        <li class="list-group-item bg-transparent">
                            <i class="bi bi-clock-history text-primary me-2" aria-hidden="true"></i>
                            <strong>Timp execuție:</strong> 10–20 minute pentru comenzi standard, până la 3 zile pentru comenzi mari.
                        </li>
                        <li class="list-group-item bg-transparent">
                            <i class="bi bi-truck text-primary me-2" aria-hidden="true"></i>
                            <strong>Livrare:</strong> ridicare din atelier sau curier în Chișinău.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
