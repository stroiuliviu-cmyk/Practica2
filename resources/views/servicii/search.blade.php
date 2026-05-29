@extends('layouts.app')

@section('title', 'Căutare')
@section('description', 'Caută produse personalizate Infinity SRL — căni, tricouri, brelocuri și multe altele.')

@section('content')
    <section class="categorie-hero">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Acasă</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Căutare</li>
                </ol>
            </nav>

            <h1>Rezultate căutare</h1>

            <form action="{{ route('servicii.search') }}" method="GET" class="mt-3" role="search">
                <div class="input-group input-group-lg" style="max-width: 600px;">
                    <input type="search"
                           class="form-control"
                           name="q"
                           value="{{ $q }}"
                           placeholder="Caută produs..."
                           minlength="2"
                           required
                           autofocus>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search me-1" aria-hidden="true"></i>Caută
                    </button>
                </div>
            </form>

            @if($q !== '')
                <p class="mt-3 mb-0">
                    @if($rezultate->isEmpty())
                        Nu am găsit rezultate pentru <strong>„{{ $q }}"</strong>.
                    @else
                        Am găsit <strong>{{ $rezultate->count() }}</strong>
                        {{ $rezultate->count() === 1 ? 'rezultat' : 'rezultate' }}
                        pentru <strong>„{{ $q }}"</strong>.
                    @endif
                </p>
            @endif
        </div>
    </section>

    <section>
        <div class="container">
            @if($rezultate->isEmpty() && $q !== '')
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2" aria-hidden="true"></i>
                    Nu am găsit niciun produs care să se potrivească căutării.
                    Încearcă alți termeni sau navighează direct prin
                    <a href="{{ route('servicii.index') }}" class="alert-link">categorii</a>.
                </div>
            @endif

            @if($q === '')
                <div class="alert alert-secondary">
                    <i class="bi bi-search me-2" aria-hidden="true"></i>
                    Introdu cel puțin 2 caractere pentru a căuta în catalog.
                </div>
            @endif

            <div class="row g-4">
                @foreach($rezultate as $produs)
                    <div class="col-12 col-md-6 col-lg-4" data-reveal>
                        <article class="card card-produs h-100">
                            <img src="{{ asset($produs->imagine ?? 'img/placeholders/prod-default.svg') }}"
                                 class="card-img-top"
                                 alt="{{ $produs->denumire }}"
                                 loading="lazy">
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-secondary mb-2 align-self-start">
                                    {{ $produs->categorie->denumire ?? '—' }}
                                </span>
                                <h3 class="h6">{{ $produs->denumire }}</h3>
                                <p class="card-text small text-muted flex-grow-1">
                                    {{ \Illuminate\Support\Str::limit($produs->descriere, 120) }}
                                </p>
                                @if($produs->pret_de_la)
                                    <div class="pret">de la {{ number_format($produs->pret_de_la, 0, ',', ' ') }} MDL</div>
                                @endif
                                <a href="{{ route('servicii.show', $produs->categorie->slug) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    Vezi categoria
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
