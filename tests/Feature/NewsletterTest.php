<?php

// Teste pentru formularul de newsletter.

use App\Models\NewsletterSubscriber;

it('respinge email-ul invalid', function () {
    $response = $this->from('/')->post(route('newsletter.subscribe'), ['email' => 'invalid']);
    $response->assertSessionHasErrors(['email']);
});

it('salvează abonatul nou și afișează flash de succes', function () {
    expect(NewsletterSubscriber::count())->toBe(0);

    $response = $this->from('/')->post(route('newsletter.subscribe'), [
        'email' => 'abonat-nou@test.local',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('newsletter_success');
    expect(NewsletterSubscriber::count())->toBe(1);
});

it('nu duplică un abonat existent', function () {
    NewsletterSubscriber::create(['email' => 'existing@test.local', 'activ' => true]);

    $this->from('/')->post(route('newsletter.subscribe'), [
        'email' => 'existing@test.local',
    ]);

    expect(NewsletterSubscriber::where('email', 'existing@test.local')->count())->toBe(1);
});

it('afișează mesaj diferit pentru abonatul existent', function () {
    NewsletterSubscriber::create(['email' => 'deja@aici.local', 'activ' => true]);

    $response = $this->from('/')->post(route('newsletter.subscribe'), [
        'email' => 'deja@aici.local',
    ]);

    $response->assertSessionHas('newsletter_success', fn ($m) => str_contains($m, 'deja abonat'));
});
