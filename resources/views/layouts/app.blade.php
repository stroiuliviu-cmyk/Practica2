<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'FotoMoments — imprimare personalizată pe căni, tricouri, brelocuri și multe altele. Chișinău, din 2006.')">
    <meta name="theme-color" content="#e91e63">
    <title>@yield('title', 'FotoMoments') — Imprimare personalizată Chișinău</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
