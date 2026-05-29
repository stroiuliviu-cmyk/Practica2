@extends('layouts.app')

@section('title', 'Galerie')
@section('description', 'Galeria lucrărilor realizate de Infinity SRL — exemple de comenzi executate pentru clienții noștri.')

@section('content')
    <section class="categorie-hero">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Acasă</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Galerie</li>
                </ol>
            </nav>

            <h1>Galeria lucrărilor</h1>
            <p>Exemple reale de comenzi executate de echipa Infinity pentru clienții noștri din Chișinău.</p>
        </div>
    </section>

    <section>
        <div class="container">
            {{-- Filtru categorii --}}
            <div class="filter-bar d-flex flex-wrap align-items-center gap-2">
                <span class="me-2">
                    <i class="bi bi-funnel me-1" aria-hidden="true"></i>
                    Filtrează:
                </span>
                <a href="{{ route('galerie.index') }}"
                   class="btn btn-sm {{ empty($filterCategorie) ? 'btn-primary' : 'btn-outline-primary' }}">
                    Toate
                </a>
                @foreach($categorii as $cat)
                    <a href="{{ route('galerie.index', ['categorie' => $cat->slug]) }}"
                       class="btn btn-sm {{ $filterCategorie === $cat->slug ? 'btn-primary' : 'btn-outline-primary' }}">
                        {{ $cat->denumire }}
                    </a>
                @endforeach
                <span class="text-muted small ms-auto">{{ $itemuri->count() }} {{ $itemuri->count() === 1 ? 'lucrare' : 'lucrări' }}</span>
            </div>

            @if($itemuri->isEmpty())
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2" aria-hidden="true"></i>
                    Nu există lucrări în această categorie momentan.
                </div>
            @else
                <div class="galerie-grid">
                    @foreach($itemuri as $item)
                        <div class="galerie-item"
                             data-reveal
                             data-bs-toggle="modal"
                             data-bs-target="#lightboxModal"
                             data-image="{{ asset($item->imagine) }}"
                             data-title="{{ $item->titlu }}"
                             data-description="{{ $item->descriere }}"
                             data-categorie="{{ $item->categorie->denumire ?? '' }}"
                             tabindex="0"
                             role="button"
                             aria-label="Deschide {{ $item->titlu }}">
                            <img src="{{ asset($item->imagine) }}"
                                 alt="{{ $item->titlu }}"
                                 loading="lazy">
                            <div class="galerie-overlay">
                                <i class="bi bi-zoom-in" aria-hidden="true"></i>
                                <strong>{{ $item->titlu }}</strong>
                                @if($item->categorie)
                                    <small>{{ $item->categorie->denumire }}</small>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Modal lightbox --}}
    <div class="modal fade" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lightboxLabel">Vizualizare lucrare</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Închide"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="lightboxImage" src="" alt="" class="img-fluid rounded">
                    <p id="lightboxDescription" class="mt-3 text-start"></p>
                    <span id="lightboxCategorie" class="badge bg-primary"></span>
                </div>
            </div>
        </div>
    </div>
@endsection
