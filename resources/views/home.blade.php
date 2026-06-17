@extends('layouts.app')

@section('title', 'Acasă')
@section('description', 'Infinity SRL — imprimare personalizată pe căni, tricouri, brelocuri, perne, puzzle, ceasuri, farfurii și tipar fotografii. Cahul, din 2006.')

@php
    $heroSlides = $categorii->take(4);
@endphp

@section('content')
    {{-- Hero — gradient + blob + stacked product images + trust strip --}}
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge rounded-pill text-bg-light mb-2"
                          style="background: var(--color-accent-tint) !important; color: var(--color-accent) !important; padding: 0.4rem 0.8rem; font-weight: 500;">
                        <i class="bi bi-geo-alt-fill me-1" aria-hidden="true"></i>Cahul · din 2006
                    </span>
                    <h1 class="hero-title">
                        Momentele tale prețioase,<br>
                        imprimate pentru totdeauna.
                    </h1>
                    <p class="hero-subtitle">
                        Transformăm fotografiile, inscripțiile și logo-urile tale în cadouri unice —
                        căni, tricouri, brelocuri, perne, puzzle, ceasuri și farfurii.
                        Executăm comenzile pe loc, în 10–20 de minute.
                    </p>
                    <div class="hero-buttons d-flex flex-wrap gap-3">
                        <a href="{{ route('servicii.index') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-grid-3x3-gap me-2" aria-hidden="true"></i>
                            Vezi serviciile
                        </a>
                        <a href="{{ route('contacte.index') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-chat-dots me-2" aria-hidden="true"></i>
                            Contactează-ne
                        </a>
                    </div>
                    <div class="hero-trust">
                        <span><strong>19+</strong> ani experiență</span>
                        <span><strong>8</strong> categorii produse</span>
                        <span><strong>10–20</strong> min execuție</span>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="hero-art">
                        <div class="hero-blob"></div>
                        <img src="{{ asset('img/cani/cana-alba-330ml.jpg') }}"
                             alt="Cană personalizată"
                             class="hero-img hero-img--1">
                        <img src="{{ asset('img/categorii/cat-tricouri-maiouri.jpg') }}"
                             alt="Tricou personalizat"
                             class="hero-img hero-img--2">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Carousel servicii populare --}}
    @if($heroSlides->count() > 0)
        <section class="pt-4 pb-0">
            <div class="container">
                <div id="serviciiCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-indicators">
                        @foreach($heroSlides as $i => $cat)
                            <button type="button"
                                    data-bs-target="#serviciiCarousel"
                                    data-bs-slide-to="{{ $i }}"
                                    @class(['active' => $i === 0])
                                    @if($i === 0) aria-current="true" @endif
                                    aria-label="Slide {{ $i + 1 }}: {{ $cat->denumire }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($heroSlides as $i => $cat)
                            <div @class(['carousel-item', 'active' => $i === 0])
                                 style="background-image: url('{{ asset($cat->imagine ?? 'img/placeholders/cat-default.svg') }}');">
                                <div class="carousel-caption">
                                    <h3>{{ $cat->denumire }}</h3>
                                    <p class="mb-2">{{ $cat->descriere_scurta }}</p>
                                    <a href="{{ route('servicii.show', $cat->slug) }}" class="btn btn-light btn-sm">
                                        Vezi detalii
                                        <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#serviciiCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#serviciiCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Următor</span>
                    </button>
                </div>
            </div>
        </section>
    @endif

    {{-- Beneficii --}}
    <section id="beneficii">
        <div class="container">
            <div class="section-title" data-reveal>
                <h2>De ce să alegi Infinity?</h2>
                <p>Trei motive solide care ne diferențiază pe piața din Cahul.</p>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-4" data-reveal>
                    <div class="card-beneficiu">
                        <div class="icon-wrapper">
                            <i class="bi bi-award" aria-hidden="true"></i>
                        </div>
                        <h3>Experiență din 2006</h3>
                        <p>Peste 19 ani de activitate pe piața de imprimare personalizată din Republica Moldova.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4" data-reveal>
                    <div class="card-beneficiu">
                        <div class="icon-wrapper">
                            <i class="bi bi-lightning-charge" aria-hidden="true"></i>
                        </div>
                        <h3>Execuție pe loc</h3>
                        <p>Comenzile standard sunt gata în 10–20 de minute. Vino, alege, primește.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4" data-reveal>
                    <div class="card-beneficiu">
                        <div class="icon-wrapper">
                            <i class="bi bi-heart" aria-hidden="true"></i>
                        </div>
                        <h3>Calitate înaltă</h3>
                        <p>Materiale premium, imprimare durabilă și abordare individuală pentru fiecare client.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Categorii servicii --}}
    <section id="servicii" class="bg-white">
        <div class="container">
            <div class="section-title">
                <h2>Serviciile noastre</h2>
                <p>8 categorii principale de produse personalizate, pentru orice ocazie și buget.</p>
            </div>

            <div class="row g-4">
                @foreach($categorii as $categorie)
                    <div class="col-12 col-md-6 col-lg-3" data-reveal>
                        <article class="card card-serviciu">
                            <img src="{{ asset($categorie->imagine ?? 'img/placeholders/cat-default.svg') }}"
                                 class="card-img-top"
                                 alt="{{ $categorie->denumire }}"
                                 loading="lazy">
                            <div class="card-body">
                                <h3 class="card-title h5">{{ $categorie->denumire }}</h3>
                                <p class="card-text">{{ $categorie->descriere_scurta }}</p>
                                <a href="{{ route('servicii.show', $categorie->slug) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    Detalii
                                    <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Proces --}}
    <section id="proces">
        <div class="container">
            <div class="section-title">
                <h2>Cum se comandă</h2>
                <p>Un proces simplu, transparent, în 4 pași.</p>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="proces-pas">
                        <div class="numar">1</div>
                        <h4>Alege obiectul</h4>
                        <p>Navighează prin cele 8 categorii și găsește produsul potrivit pentru tine.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="proces-pas">
                        <div class="numar">2</div>
                        <h4>Trimite poza</h4>
                        <p>Trimite-ne fotografia, inscripția sau logo-ul pe care vrei să-l imprimi.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="proces-pas">
                        <div class="numar">3</div>
                        <h4>Verifică macheta</h4>
                        <p>Îți trimitem o previzualizare a produsului final pentru aprobare.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="proces-pas">
                        <div class="numar">4</div>
                        <h4>Primește produsul</h4>
                        <p>În 10–20 de minute pentru comenzi standard, mai mult pentru cele complexe.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA contact --}}
    <section id="cta">
        <div class="container">
            <div class="cta-banner">
                <h2>Ai nevoie de un cadou personalizat?</h2>
                <p class="mb-3">Sună-ne acum sau trimite-ne un mesaj — îți răspundem rapid!</p>
                <div class="telefon">
                    <a href="tel:+37329912345">
                        <i class="bi bi-telephone-fill me-2" aria-hidden="true"></i>+373 299 12 345
                    </a>
                </div>
                <a href="{{ route('contacte.index') }}" class="btn btn-light btn-lg">
                    <i class="bi bi-envelope me-2" aria-hidden="true"></i>
                    Trimite un mesaj
                </a>
            </div>
        </div>
    </section>
@endsection
