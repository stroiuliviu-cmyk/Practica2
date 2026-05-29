<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panou admin') — Infinity SRL</title>
    <meta name="robots" content="noindex,nofollow">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">

{{-- Header admin --}}
<nav class="navbar navbar-expand-lg navbar-fotomoments border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('img/logo.svg') }}" alt="Infinity SRL" class="brand-logo">
            <span class="badge bg-primary ms-2 align-middle">ADMIN</span>
        </a>

        <div class="ms-auto d-flex align-items-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary" target="_blank" rel="noopener">
                <i class="bi bi-box-arrow-up-right me-1" aria-hidden="true"></i>Vezi site-ul
            </a>
            <span class="text-muted small d-none d-md-inline">
                <i class="bi bi-person-circle me-1" aria-hidden="true"></i>
                {{ Auth::user()->name }}
            </span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-1" aria-hidden="true"></i>Ieșire
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <aside class="col-12 col-md-3 col-lg-2 admin-sidebar px-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categorii.index') }}"
                       class="nav-link {{ request()->routeIs('admin.categorii.*') ? 'active' : '' }}">
                        <i class="bi bi-grid-3x3-gap"></i>Categorii
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.produse.index') }}"
                       class="nav-link {{ request()->routeIs('admin.produse.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam"></i>Produse
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.galerie.index') }}"
                       class="nav-link {{ request()->routeIs('admin.galerie.*') ? 'active' : '' }}">
                        <i class="bi bi-images"></i>Galerie
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mesaje.index') }}"
                       class="nav-link {{ request()->routeIs('admin.mesaje.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope"></i>Mesaje contact
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.newsletter.index') }}"
                       class="nav-link {{ request()->routeIs('admin.newsletter.*') ? 'active' : '' }}">
                        <i class="bi bi-megaphone"></i>Newsletter
                    </a>
                </li>
            </ul>
        </aside>

        {{-- Content --}}
        <main class="col-12 col-md-9 col-lg-10 admin-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Închide"></button>
                </div>
            @endif

            @if($errors->any() && ! $errors->has('email'))
                <div class="alert alert-danger">
                    <strong>A apărut o problemă:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
