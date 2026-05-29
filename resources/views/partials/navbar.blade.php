<header>
    <nav class="navbar navbar-expand-lg navbar-fotomoments sticky-top" aria-label="Meniu principal">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}" aria-label="Infinity — Acasă">
                <img src="{{ asset('img/logo.svg') }}"
                     alt="Infinity SRL"
                     class="brand-logo">
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarMain"
                    aria-controls="navbarMain"
                    aria-expanded="false"
                    aria-label="Comută meniul">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ route('home') }}">Acasă</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('despre') ? 'active' : '' }}"
                           href="{{ route('despre') }}">Despre noi</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('servicii.*') ? 'active' : '' }}"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">Servicii</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('servicii.index') }}">
                                    <i class="bi bi-grid-3x3-gap me-2" aria-hidden="true"></i>Toate categoriile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach($categoriiNavbar ?? [] as $cat)
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('servicii.show', $cat->slug) }}">
                                        {{ $cat->denumire }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('galerie.*') ? 'active' : '' }}"
                           href="{{ route('galerie.index') }}">Galerie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacte.*') ? 'active' : '' }}"
                           href="{{ route('contacte.index') }}">Contacte</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <form action="{{ route('servicii.search') }}" method="GET" role="search" class="d-flex">
                            <input class="form-control form-control-sm me-2"
                                   type="search"
                                   name="q"
                                   placeholder="Caută produs..."
                                   aria-label="Caută"
                                   value="{{ request('q') }}"
                                   minlength="2"
                                   required>
                            <button class="btn btn-outline-primary btn-sm" type="submit" aria-label="Caută">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-primary btn-sm"
                           href="tel:+37322123456">
                            <i class="bi bi-telephone-fill me-1" aria-hidden="true"></i>
                            +373 22 123 456
                        </a>
                    </li>
                    @auth
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-shield-lock me-1" aria-hidden="true"></i>Admin
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
