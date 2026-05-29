<footer class="footer-fotomoments">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-3">
                <img src="{{ asset('img/logo.svg') }}"
                     alt="Infinity SRL"
                     class="footer-logo mb-3">
                <p>
                    Imprimare personalizată de calitate pe căni, tricouri, brelocuri, perne și multe altele.
                    Activăm din 2006 în Chișinău.
                </p>
                <div class="social-icons mt-3">
                    <a href="#" aria-label="Facebook" title="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Instagram" title="Instagram"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                    <a href="#" aria-label="WhatsApp" title="WhatsApp"><i class="bi bi-whatsapp" aria-hidden="true"></i></a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <h5>Servicii</h5>
                <ul>
                    @foreach($categoriiNavbar ?? [] as $cat)
                        <li>
                            <a href="{{ route('servicii.show', $cat->slug) }}">{{ $cat->denumire }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <h5>Contact</h5>
                <ul>
                    <li>
                        <i class="bi bi-telephone-fill me-2" aria-hidden="true"></i>
                        <a href="tel:+37322123456">+373 22 123 456</a>
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill me-2" aria-hidden="true"></i>
                        <a href="mailto:contact@fotomoments.local">contact@fotomoments.local</a>
                    </li>
                    <li>
                        <i class="bi bi-geo-alt-fill me-2" aria-hidden="true"></i>
                        Str. Ștefan cel Mare 100, Chișinău
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <h5>Program de lucru</h5>
                <ul>
                    <li><i class="bi bi-clock me-2" aria-hidden="true"></i>Luni–Vineri: 09:00 – 18:00</li>
                    <li><i class="bi bi-clock me-2" aria-hidden="true"></i>Sâmbătă: 09:00 – 14:00</li>
                    <li><i class="bi bi-clock me-2" aria-hidden="true"></i>Duminică: închis</li>
                </ul>

                <h5 class="mt-4" id="newsletter">Newsletter</h5>
                <p class="small mb-2">Primește ofertele noastre pe email.</p>

                @if(session('newsletter_success'))
                    <div class="alert alert-success alert-sm py-2 px-3 small mb-2" role="alert">
                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>
                        {{ session('newsletter_success') }}
                    </div>
                @endif

                @if($errors->has('email'))
                    <div class="alert alert-danger alert-sm py-2 px-3 small mb-2" role="alert">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="adresa@email.com"
                               required
                               maxlength="150"
                               aria-label="Adresa de email pentru newsletter">
                        <button type="submit" class="btn btn-primary" aria-label="Abonează-te">
                            <i class="bi bi-send" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="copyright">
            © {{ date('Y') }} Infinity SRL. Toate drepturile rezervate.
            Proiect de practică — clonă după modelul fotomoments.md.
        </div>
    </div>
</footer>
