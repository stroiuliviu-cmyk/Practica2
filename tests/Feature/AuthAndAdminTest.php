<?php

// Teste pentru fluxul de autentificare admin și protecția panoului.

use App\Models\Categorie;
use App\Models\Produs;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->admin = User::create([
        'name' => 'Admin Test',
        'email' => 'admin@test.local',
        'password' => Hash::make('parola1234'),
        'rol' => 'admin',
    ]);

    $this->editor = User::create([
        'name' => 'Editor Test',
        'email' => 'editor@test.local',
        'password' => Hash::make('parola1234'),
        'rol' => 'editor',
    ]);
});

it('autentifică un user admin cu credențiale corecte', function () {
    $response = $this->post(route('login.attempt'), [
        'email' => 'admin@test.local',
        'password' => 'parola1234',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticatedAs($this->admin);
});

it('respinge user editor de la /admin', function () {
    $response = $this->post(route('login.attempt'), [
        'email' => 'editor@test.local',
        'password' => 'parola1234',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

it('respinge parola greșită', function () {
    $response = $this->post(route('login.attempt'), [
        'email' => 'admin@test.local',
        'password' => 'gresita',
    ]);

    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

it('permite accesul admin la dashboard', function () {
    $this->actingAs($this->admin)->get(route('admin.dashboard'))
        ->assertStatus(200)
        ->assertSee('Dashboard');
});

it('blochează editor-ul de la dashboard cu HTTP 403', function () {
    $this->actingAs($this->editor)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

it('logout distruge sesiunea', function () {
    $this->actingAs($this->admin)
        ->post(route('logout'))
        ->assertRedirect(route('home'));

    $this->assertGuest();
});

it('helper isAdmin() returnează valori corecte', function () {
    expect($this->admin->isAdmin())->toBeTrue();
    expect($this->editor->isAdmin())->toBeFalse();
});

it('admin poate crea o categorie nouă', function () {
    $this->actingAs($this->admin)->post(route('admin.categorii.store'), [
        'denumire' => 'Categorie nouă din test',
        'descriere_scurta' => 'Descriere scurtă',
        'activ' => 1,
        'ordine_afisare' => 99,
    ])->assertRedirect(route('admin.categorii.index'));

    expect(Categorie::where('denumire', 'Categorie nouă din test')->exists())->toBeTrue();
});

it('admin poate edita o categorie existentă', function () {
    $cat = Categorie::create([
        'slug' => 'editabil',
        'denumire' => 'Original',
        'activ' => true,
    ]);

    $this->actingAs($this->admin)->put(route('admin.categorii.update', $cat), [
        'denumire' => 'Modificat',
        'slug' => 'editabil',
        'activ' => 1,
    ])->assertRedirect(route('admin.categorii.index'));

    expect($cat->fresh()->denumire)->toBe('Modificat');
});

it('admin poate șterge o categorie și produsele asociate', function () {
    $cat = Categorie::create(['slug' => 'sters', 'denumire' => 'De șters', 'activ' => true]);
    Produs::create(['categorie_id' => $cat->id, 'denumire' => 'Produs asociat', 'activ' => true]);

    expect(Produs::where('categorie_id', $cat->id)->count())->toBe(1);

    $this->actingAs($this->admin)->delete(route('admin.categorii.destroy', $cat));

    expect(Categorie::find($cat->id))->toBeNull();
    expect(Produs::where('categorie_id', $cat->id)->count())->toBe(0); // CASCADE
});

it('admin poate adăuga produs nou cu caracteristici JSON', function () {
    $cat = Categorie::create(['slug' => 'cat-prod', 'denumire' => 'Categorie produse', 'activ' => true]);

    $this->actingAs($this->admin)->post(route('admin.produse.store'), [
        'categorie_id' => $cat->id,
        'denumire' => 'Produs cu caracteristici',
        'descriere' => 'Test',
        'pret_de_la' => 250.00,
        'caracteristici_raw' => "material: ceramică\ndimensiune: 330ml",
        'activ' => 1,
    ])->assertRedirect();

    $produs = Produs::where('denumire', 'Produs cu caracteristici')->first();
    expect($produs)->not->toBeNull();
    expect($produs->caracteristici)->toBe([
        'material' => 'ceramică',
        'dimensiune' => '330ml',
    ]);
});
