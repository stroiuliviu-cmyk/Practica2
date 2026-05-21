<header>
    <nav class="navbar navbar-expand-lg navbar-fotomoments sticky-top" aria-label="Meniu principal">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-camera-fill" aria-hidden="true"></i>FotoMoments
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
                        <a class="nav-link {{ request()->routeIs('contacte.*') ? 'active' : '' }}"
                           href="{{ route('contacte.index') }}">Contacte</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary btn-sm"
                           href="tel:+37322123456">
                            <i class="bi bi-telephone-fill me-1" aria-hidden="true"></i>
                            +373 22 123 456
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
