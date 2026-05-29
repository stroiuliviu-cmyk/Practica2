@extends('layouts.app')

@section('title', 'Autentificare')
@section('description', 'Acces panou administrativ Infinity SRL.')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 col-lg-5">
                    <div class="form-contact">
                        <div class="text-center mb-4">
                            <i class="bi bi-shield-lock" style="font-size: 3rem; color: var(--bs-primary);" aria-hidden="true"></i>
                            <h1 class="h3 mt-3 mb-1">Autentificare</h1>
                            <p class="text-muted small">Accesul este permis doar administratorilor.</p>
                        </div>

                        @if(session('status'))
                            <div class="alert alert-info">{{ session('status') }}</div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autocomplete="username"
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Parolă *</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       required
                                       autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="remember"
                                       value="1"
                                       id="remember">
                                <label class="form-check-label" for="remember">Ține-mă minte</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2" aria-hidden="true"></i>
                                Autentifică-te
                            </button>
                        </form>

                        <hr class="my-4">
                        <p class="text-muted small text-center mb-0">
                            <i class="bi bi-info-circle me-1" aria-hidden="true"></i>
                            Credențiale demo:<br>
                            <code>admin@infinity.local</code> / <code>admin1234</code>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
