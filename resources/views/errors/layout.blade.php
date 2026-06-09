@extends('layouts.app')

@section('title', $code . ' — ' . $titlu)
@section('description', $descriere)

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="display-1 fw-bold text-primary mb-3" style="font-size: 8rem;">{{ $code }}</div>
                    <h1 class="h2 mb-3">{{ $titlu }}</h1>
                    <p class="text-muted mb-4">{{ $descriere }}</p>

                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="bi bi-house me-2" aria-hidden="true"></i>Înapoi acasă
                        </a>
                        <a href="{{ route('servicii.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-grid-3x3-gap me-2" aria-hidden="true"></i>Vezi serviciile
                        </a>
                        <a href="{{ route('contacte.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-envelope me-2" aria-hidden="true"></i>Contactează-ne
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
