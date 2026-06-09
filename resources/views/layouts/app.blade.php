<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Infinity SRL — imprimare personalizată pe căni, tricouri, brelocuri și multe altele. Cahul, din 2006.')">
    <meta name="theme-color" content="#008DD2">
    <title>@yield('title', 'Infinity') — Imprimare personalizată Cahul</title>

    {{-- Open Graph (Facebook, LinkedIn, etc.) --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Infinity SRL">
    <meta property="og:locale" content="ro_RO">
    <meta property="og:title" content="@yield('title', 'Infinity') — Imprimare personalizată Cahul">
    <meta property="og:description" content="@yield('description', 'Infinity SRL — imprimare personalizată pe căni, tricouri, brelocuri și multe altele.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('img/logo.svg') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title', 'Infinity') — Imprimare personalizată Cahul">
    <meta name="twitter:description" content="@yield('description', 'Infinity SRL — imprimare personalizată pe căni, tricouri, brelocuri și multe altele.')">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon (logo-mark — design system) --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo-mark.svg') }}">

    {{-- JSON-LD structured data (LocalBusiness) — construit ca array PHP pentru a evita conflictul @type cu Blade --}}
    @php
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Infinity SRL',
            'image' => asset('img/logo.svg'),
            'url' => url('/'),
            'telephone' => '+373 299 12 345',
            'email' => 'contact@infinity.md',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Str. Independenței 10',
                'addressLocality' => 'Cahul',
                'addressCountry' => 'MD',
            ],
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    'opens' => '09:00',
                    'closes' => '18:00',
                ],
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => 'Saturday',
                    'opens' => '09:00',
                    'closes' => '14:00',
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('head')
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Buton back-to-top (apare la scroll) --}}
    <button id="btnBackToTop"
            class="btn-back-to-top"
            type="button"
            aria-label="Înapoi sus"
            title="Înapoi sus">
        <i class="bi bi-arrow-up" aria-hidden="true"></i>
    </button>
</body>
</html>
