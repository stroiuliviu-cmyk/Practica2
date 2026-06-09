<?php

// Teste pentru funcționalitățile de căutare și galerie (AS11-AS12).

use App\Models\Categorie;
use App\Models\Galerie;
use App\Models\Produs;

beforeEach(function () {
    $this->categorie = Categorie::create([
        'slug' => 'cani-search',
        'denumire' => 'Căni search',
        'activ' => true,
        'ordine_afisare' => 1,
    ]);

    Produs::create([
        'categorie_id' => $this->categorie->id,
        'denumire' => 'Cană magică termoactivă',
        'descriere' => 'O cană specială care își schimbă culoarea la cald',
        'pret_de_la' => 180,
        'activ' => true,
    ]);

    Produs::create([
        'categorie_id' => $this->categorie->id,
        'denumire' => 'Tricou polo personalizat',
        'descriere' => 'Tricou cu guler',
        'pret_de_la' => 320,
        'activ' => true,
    ]);
});

it('căutarea găsește produse după denumire', function () {
    $response = $this->get(route('servicii.search') . '?q=magic');
    $response->assertStatus(200);
    $response->assertSee('Cană magică termoactivă');
    $response->assertDontSee('Tricou polo');
});

it('căutarea găsește produse după descriere', function () {
    $response = $this->get(route('servicii.search') . '?q=guler');
    $response->assertSee('Tricou polo personalizat');
});

it('căutarea cu sub 2 caractere nu returnează rezultate', function () {
    $response = $this->get(route('servicii.search') . '?q=a');
    $response->assertStatus(200);
    $response->assertDontSee('Cană magică');
});

it('căutarea fără rezultate afișează mesaj informativ', function () {
    $response = $this->get(route('servicii.search') . '?q=inexistent-xyz');
    $response->assertStatus(200);
    $response->assertSee('Nu am găsit');
});

it('pagina galerie afișează toate lucrările active', function () {
    Galerie::create([
        'titlu' => 'Lucrare test 1',
        'descriere' => 'D1',
        'imagine' => 'img/x.svg',
        'activ' => true,
        'categorie_id' => $this->categorie->id,
    ]);

    $response = $this->get(route('galerie.index'));
    $response->assertSee('Lucrare test 1');
});

it('filtrul galeriei după categorie funcționează', function () {
    Galerie::create([
        'titlu' => 'Lucrare cani',
        'imagine' => 'img/c.svg',
        'activ' => true,
        'categorie_id' => $this->categorie->id,
    ]);

    Galerie::create([
        'titlu' => 'Lucrare orfană',
        'imagine' => 'img/o.svg',
        'activ' => true,
        'categorie_id' => null,
    ]);

    $response = $this->get(route('galerie.index') . '?categorie=' . $this->categorie->slug);
    $response->assertSee('Lucrare cani');
    $response->assertDontSee('Lucrare orfană');
});

it('nu afișează lucrările inactive', function () {
    Galerie::create([
        'titlu' => 'Inactiv',
        'imagine' => 'img/i.svg',
        'activ' => false,
    ]);

    $response = $this->get(route('galerie.index'));
    $response->assertDontSee('Inactiv');
});
