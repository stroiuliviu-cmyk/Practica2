<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Infinity SRL — imprimare personalizată pe căni, tricouri, brelocuri și multe altele. Chișinău, din 2006.')">
    <meta name="theme-color" content="#008DD2">
    <title>@yield('title', 'Infinity') — Imprimare personalizată Chișinău</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
