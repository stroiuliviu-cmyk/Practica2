<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MesajContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MesajContactController extends Controller
{
    public function index(): View
    {
        $mesaje = MesajContact::orderByDesc('created_at')->paginate(20);
        return view('admin.mesaje.index', compact('mesaje'));
    }

    public function show(MesajContact $mesaj): View
    {
        if (! $mesaj->citit) {
            $mesaj->update(['citit' => true]);
        }
        return view('admin.mesaje.show', compact('mesaj'));
    }

    public function toggleCitit(MesajContact $mesaj): RedirectResponse
    {
        $mesaj->update(['citit' => ! $mesaj->citit]);
        return back()->with('success', 'Statusul mesajului a fost actualizat.');
    }

    public function destroy(MesajContact $mesaj): RedirectResponse
    {
        $mesaj->delete();
        return redirect()->route('admin.mesaje.index')
            ->with('success', 'Mesajul a fost șters.');
    }
}
