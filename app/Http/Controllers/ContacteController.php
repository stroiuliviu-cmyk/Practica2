<?php

namespace App\Http\Controllers;

use App\Models\MesajContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContacteController extends Controller
{
    public function index(): View
    {
        return view('contacte');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nume'    => ['required', 'string', 'min:2', 'max:150'],
            'email'   => ['required', 'email', 'max:150'],
            'telefon' => ['nullable', 'string', 'max:30'],
            'subiect' => ['required', 'string', 'min:3', 'max:200'],
            'mesaj'   => ['required', 'string', 'min:10'],
        ], [
            'nume.required'    => 'Numele este obligatoriu.',
            'nume.min'         => 'Numele trebuie să aibă cel puțin :min caractere.',
            'email.required'   => 'Adresa de email este obligatorie.',
            'email.email'      => 'Adresa de email nu este validă.',
            'subiect.required' => 'Subiectul este obligatoriu.',
            'subiect.min'      => 'Subiectul trebuie să aibă cel puțin :min caractere.',
            'mesaj.required'   => 'Mesajul este obligatoriu.',
            'mesaj.min'        => 'Mesajul trebuie să aibă cel puțin :min caractere.',
        ]);

        MesajContact::create($validated);

        return redirect()
            ->route('contacte.index')
            ->with('success', 'Mesajul tău a fost trimis cu succes! Te vom contacta în cel mai scurt timp.');
    }
}
