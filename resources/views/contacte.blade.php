@extends('layouts.app')

@section('title', 'Contacte')
@section('description', 'Contactează echipa Infinity SRL — telefon, email, adresă în Chișinău, program de lucru. Formular online pentru cereri de ofertă.')

@section('content')
    <section class="categorie-hero">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Acasă</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contacte</li>
                </ol>
            </nav>

            <h1>Contactează-ne</h1>
            <p>
                Suntem aici să te ajutăm să găsești cadoul perfect.
                Trimite-ne un mesaj, sună-ne sau vino direct la atelier.
            </p>
        </div>
    </section>

    <section>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-4" aria-hidden="true"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-12 col-lg-5">
                    <div class="contact-info-card">
                        <h3>Date de contact</h3>

                        <div class="info-item">
                            <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                            <div class="text">
                                <strong>Telefon</strong>
                                <a href="tel:+37322123456" class="text-white">+373 22 123 456</a>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                            <div class="text">
                                <strong>Email</strong>
                                <a href="mailto:contact@fotomoments.local" class="text-white">contact@fotomoments.local</a>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                            <div class="text">
                                <strong>Adresă</strong>
                                Str. Ștefan cel Mare 100, Chișinău, Republica Moldova
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="bi bi-clock-fill" aria-hidden="true"></i>
                            <div class="text">
                                <strong>Program de lucru</strong>
                                Luni–Vineri: 09:00 – 18:00<br>
                                Sâmbătă: 09:00 – 14:00<br>
                                Duminică: închis
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="form-contact">
                        <h2 class="h4 mb-4">Trimite-ne un mesaj</h2>

                        <form action="{{ route('contacte.store') }}" method="POST" id="form-contact" novalidate>
                            @csrf

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="nume" class="form-label">Nume *</label>
                                    <input type="text"
                                           class="form-control @error('nume') is-invalid @enderror"
                                           id="nume"
                                           name="nume"
                                           value="{{ old('nume') }}"
                                           required
                                           minlength="2"
                                           maxlength="150">
                                    @error('nume')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           maxlength="150">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="telefon" class="form-label">Telefon</label>
                                    <input type="tel"
                                           class="form-control @error('telefon') is-invalid @enderror"
                                           id="telefon"
                                           name="telefon"
                                           value="{{ old('telefon') }}"
                                           maxlength="30"
                                           placeholder="+373 ...">
                                    @error('telefon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="subiect" class="form-label">Subiect *</label>
                                    <select class="form-select @error('subiect') is-invalid @enderror"
                                            id="subiect"
                                            name="subiect"
                                            required>
                                        <option value="" disabled {{ old('subiect') ? '' : 'selected' }}>Alege un subiect...</option>
                                        <option value="Întrebare generală" {{ old('subiect') === 'Întrebare generală' ? 'selected' : '' }}>Întrebare generală</option>
                                        <option value="Cerere ofertă" {{ old('subiect') === 'Cerere ofertă' ? 'selected' : '' }}>Cerere ofertă</option>
                                        <option value="Comandă mare (corporate)" {{ old('subiect') === 'Comandă mare (corporate)' ? 'selected' : '' }}>Comandă mare (corporate)</option>
                                        <option value="Suport / reclamație" {{ old('subiect') === 'Suport / reclamație' ? 'selected' : '' }}>Suport / reclamație</option>
                                        <option value="Altele" {{ old('subiect') === 'Altele' ? 'selected' : '' }}>Altele</option>
                                    </select>
                                    @error('subiect')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="mesaj" class="form-label">Mesaj *</label>
                                    <textarea class="form-control @error('mesaj') is-invalid @enderror"
                                              id="mesaj"
                                              name="mesaj"
                                              rows="6"
                                              required
                                              minlength="10"
                                              placeholder="Scrie-ne despre ce ai nevoie...">{{ old('mesaj') }}</textarea>
                                    @error('mesaj')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-send me-2" aria-hidden="true"></i>
                                        Trimite mesajul
                                    </button>
                                    <small class="text-muted ms-2">* Câmpuri obligatorii</small>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Hartă placeholder --}}
            <div class="harta-placeholder mt-5">
                <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                <h3 class="h5">Hartă — Chișinău</h3>
                <p class="mb-0">Str. Ștefan cel Mare 100, Chișinău, Republica Moldova</p>
                <small class="text-muted">(în viitor: hartă interactivă Google Maps)</small>
            </div>
        </div>
    </section>
@endsection
