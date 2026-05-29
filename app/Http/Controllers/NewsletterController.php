<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:150'],
        ], [
            'email.required' => 'Adresa de email este obligatorie.',
            'email.email' => 'Adresa de email nu este validă.',
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $validated['email']],
            ['activ' => true]
        );

        $mesaj = $subscriber->wasRecentlyCreated
            ? 'Mulțumim pentru abonare! Vei primi noutățile noastre pe email.'
            : 'Ești deja abonat la newsletter. Mulțumim!';

        return redirect()
            ->back()
            ->with('newsletter_success', $mesaj)
            ->withFragment('newsletter');
    }
}
