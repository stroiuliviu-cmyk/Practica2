<?php

// AS20: Teste pentru funcționalitatea legăturilor interne ale site-ului.
// Verifică că linkurile principale din navbar și footer duc la pagini valide (HTTP 200).

use App\Models\Categorie;
use App\Models\Produs;

beforeEach(function () {
    $this->cat = Categorie::create([
        'slug' => 'link-cat',
        'denumire' => 'Link test categorie',
        'activ' => true,
        'ordine_afisare' => 1,
    ]);
    Produs::create([
        'categorie_id' => $this->cat->id,
        'denumire' => 'P1',
        'activ' => true,
    ]);
});

it('toate rutele publice principale returnează HTTP 200', function () {
    $rute = [
        '/',
        '/despre',
        '/servicii',
        '/galerie',
        '/contacte',
        '/login',
    ];

    foreach ($rute as $url) {
        $this->get($url)->assertStatus(200);
    }
});

it('navbar conține link către toate paginile principale', function () {
    $html = $this->get('/')->getContent();

    expect($html)
        ->toContain('href="' . url('/') . '"')
        ->toContain('href="' . route('despre') . '"')
        ->toContain('href="' . route('servicii.index') . '"')
        ->toContain('href="' . route('galerie.index') . '"')
        ->toContain('href="' . route('contacte.index') . '"');
});

it('navbar dropdown conține link către categoria existentă', function () {
    $html = $this->get('/')->getContent();
    expect($html)->toContain(route('servicii.show', $this->cat->slug));
});

it('footer conține telefon clicabil și email mailto', function () {
    $html = $this->get('/')->getContent();
    expect($html)
        ->toContain('tel:+37322123456')
        ->toContain('mailto:contact@fotomoments.local');
});

it('breadcrumbs pe pagina detaliu categorie includ Acasă și Servicii', function () {
    $html = $this->get(route('servicii.show', $this->cat->slug))->getContent();
    expect($html)
        ->toContain('breadcrumb')
        ->toContain('href="' . url('/') . '"')
        ->toContain('href="' . route('servicii.index') . '"');
});

it('linkul logo duce la pagina principală', function () {
    $html = $this->get('/despre')->getContent();
    expect($html)->toContain('class="navbar-brand" href="' . url('/') . '"');
});

it('butonul back-to-top este prezent pe toate paginile', function () {
    foreach (['/', '/despre', '/servicii', '/galerie', '/contacte'] as $url) {
        $html = $this->get($url)->getContent();
        expect($html)->toContain('btnBackToTop');
    }
});
