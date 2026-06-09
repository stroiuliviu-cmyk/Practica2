<?php

// Teste pentru rutele publice — verifică că fiecare pagină răspunde corect
// și că datele din DB sunt afișate.

use App\Models\Categorie;
use App\Models\Produs;

beforeEach(function () {
    // Populează DB cu o categorie + 3 produse pentru fiecare test
    $this->categorie = Categorie::create([
        'slug' => 'test-cani',
        'denumire' => 'Căni test',
        'descriere_scurta' => 'Descriere scurtă căni',
        'descriere_completa' => 'Descriere completă căni',
        'ordine_afisare' => 1,
        'activ' => true,
    ]);

    foreach (range(1, 3) as $i) {
        Produs::create([
            'categorie_id' => $this->categorie->id,
            'denumire' => "Cană test {$i}",
            'descriere' => "Descriere cană {$i}",
            'pret_de_la' => 100.00 + ($i * 50),
            'activ' => true,
        ]);
    }
});

it('încarcă pagina principală cu status 200', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('Infinity', false);
});

it('afișează categoriile pe pagina principală', function () {
    $response = $this->get('/');
    $response->assertSee('Căni test');
});

it('încarcă pagina despre', function () {
    $this->get(route('despre'))->assertStatus(200)->assertSee('Despre Infinity', false);
});

it('încarcă lista de servicii', function () {
    $this->get(route('servicii.index'))
        ->assertStatus(200)
        ->assertSee('Căni test');
});

it('afișează detaliu categorie cu produsele asociate', function () {
    $response = $this->get(route('servicii.show', $this->categorie->slug));
    $response->assertStatus(200);
    $response->assertSee('Căni test');
    $response->assertSee('Cană test 1');
    $response->assertSee('Cană test 2');
    $response->assertSee('Cană test 3');
});

it('returnează 404 pentru slug inexistent', function () {
    $this->get('/servicii/inexistent-xyz')->assertStatus(404);
});

it('sortează produsele crescător după preț', function () {
    $response = $this->get(route('servicii.show', $this->categorie->slug) . '?sort=pret_asc');
    $response->assertStatus(200);
    $html = $response->getContent();

    $pozCana1 = strpos($html, 'Cană test 1');
    $pozCana3 = strpos($html, 'Cană test 3');
    expect($pozCana1)->toBeLessThan($pozCana3);
});

it('încarcă pagina galerie', function () {
    $this->get(route('galerie.index'))->assertStatus(200);
});

it('încarcă pagina contacte', function () {
    $this->get(route('contacte.index'))
        ->assertStatus(200)
        ->assertSee('Trimite-ne un mesaj');
});

it('încarcă formularul de login', function () {
    $this->get(route('login'))
        ->assertStatus(200)
        ->assertSee('Autentificare');
});

it('redirecționează vizitatorii neautentificați de la /admin la /login', function () {
    $this->get('/admin')->assertRedirect(route('login'));
});
