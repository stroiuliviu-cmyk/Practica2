@extends('layouts.app')

@section('title', 'Servicii')
@section('description', 'Toate categoriile noastre de imprimare personalizată: căni, tricouri, brelocuri, perne, puzzle, ceasuri, farfurii și tipar fotografii.')

@section('content')
    <section class="categorie-hero">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Acasă</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Servicii</li>
                </ol>
            </nav>

            <h1>Serviciile noastre</h1>
            <p>
                Descoperă cele 8 categorii principale de produse personalizate pe care le oferim.
                Toate sunt executate cu materiale premium și echipamente moderne, direct în atelierul nostru din Chișinău.
            </p>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row g-4">
                @foreach($categorii as $categorie)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <article class="card card-serviciu">
                            <img src="{{ asset($categorie->imagine ?? 'img/placeholders/cat-default.svg') }}"
                                 class="card-img-top"
                                 alt="{{ $categorie->denumire }}"
                                 loading="lazy">
                            <div class="card-body">
                                <h2 class="card-title h5">{{ $categorie->denumire }}</h2>
                                <p class="card-text">{{ $categorie->descriere_scurta }}</p>
                                <a href="{{ route('servicii.show', $categorie->slug) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    Vezi detalii
                                    <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
