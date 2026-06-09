<?php

// Teste pentru formularul de contact — validare client + server + persistență DB.

use App\Models\MesajContact;

it('respinge formularul gol cu erori de validare', function () {
    $response = $this->from(route('contacte.index'))->post(route('contacte.store'), []);
    $response->assertRedirect(route('contacte.index'));
    $response->assertSessionHasErrors(['nume', 'email', 'subiect', 'mesaj']);
});

it('respinge email-ul invalid', function () {
    $response = $this->from(route('contacte.index'))->post(route('contacte.store'), [
        'nume' => 'Ion Popescu',
        'email' => 'nu-este-email',
        'subiect' => 'Test subiect',
        'mesaj' => 'Acesta este un mesaj de test suficient de lung.',
    ]);
    $response->assertSessionHasErrors(['email']);
});

it('respinge mesajul prea scurt', function () {
    $response = $this->from(route('contacte.index'))->post(route('contacte.store'), [
        'nume' => 'Ion Popescu',
        'email' => 'ion@test.local',
        'subiect' => 'Test',
        'mesaj' => 'scurt',
    ]);
    $response->assertSessionHasErrors(['mesaj']);
});

it('salvează mesajul valid în baza de date', function () {
    expect(MesajContact::count())->toBe(0);

    $response = $this->post(route('contacte.store'), [
        'nume' => 'Maria Ionescu',
        'email' => 'maria@test.local',
        'telefon' => '+37312345678',
        'subiect' => 'Cerere ofertă',
        'mesaj' => 'Doresc o ofertă pentru 50 de căni personalizate pentru un eveniment corporativ.',
    ]);

    $response->assertRedirect(route('contacte.index'));
    $response->assertSessionHas('success');

    expect(MesajContact::count())->toBe(1);
    expect(MesajContact::first())->toMatchArray([
        'nume' => 'Maria Ionescu',
        'email' => 'maria@test.local',
        'subiect' => 'Cerere ofertă',
        'citit' => false,
    ]);
});

it('acceptă telefonul ca opțional', function () {
    $this->post(route('contacte.store'), [
        'nume' => 'Test fără telefon',
        'email' => 'fara@telefon.local',
        'subiect' => 'Întrebare generală',
        'mesaj' => 'Acesta este un mesaj fără telefon completat.',
    ]);

    expect(MesajContact::where('email', 'fara@telefon.local')->first()->telefon)->toBeNull();
});

it('protejează endpoint-ul cu CSRF token', function () {
    // RefreshDatabase + middleware CSRF activ în testing
    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
    $response = $this->post(route('contacte.store'), [
        'nume' => 'Test CSRF',
        'email' => 'csrf@test.local',
        'subiect' => 'CSRF test',
        'mesaj' => 'Acesta este un test de funcționalitate a token-ului CSRF.',
    ]);
    $response->assertRedirect();
    expect(MesajContact::where('email', 'csrf@test.local')->exists())->toBeTrue();
});
