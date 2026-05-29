<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Galerie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalerieController extends Controller
{
    public function index(): View
    {
        $itemuri = Galerie::with('categorie')
            ->orderBy('ordine_afisare')
            ->paginate(20);

        return view('admin.galerie.index', compact('itemuri'));
    }

    public function create(): View
    {
        $categorii = Categorie::orderBy('ordine_afisare')->get(['id', 'denumire']);
        return view('admin.galerie.form', [
            'item' => new Galerie(),
            'categorii' => $categorii,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['activ'] = (bool) ($data['activ'] ?? false);

        Galerie::create($data);

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Lucrarea a fost adăugată în galerie.');
    }

    public function edit(Galerie $galerie): View
    {
        $categorii = Categorie::orderBy('ordine_afisare')->get(['id', 'denumire']);
        return view('admin.galerie.form', [
            'item' => $galerie,
            'categorii' => $categorii,
        ]);
    }

    public function update(Request $request, Galerie $galerie): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['activ'] = (bool) ($data['activ'] ?? false);

        $galerie->update($data);

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Lucrarea „' . $galerie->titlu . '" a fost actualizată.');
    }

    public function destroy(Galerie $galerie): RedirectResponse
    {
        $titlu = $galerie->titlu;
        $galerie->delete();

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Lucrarea „' . $titlu . '" a fost ștearsă.');
    }

    public function show(Galerie $galerie): RedirectResponse
    {
        return redirect()->route('admin.galerie.edit', $galerie);
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'titlu' => ['required', 'string', 'min:2', 'max:200'],
            'descriere' => ['nullable', 'string', 'max:500'],
            'imagine' => ['required', 'string', 'max:255'],
            'categorie_id' => ['nullable', 'exists:categorii,id'],
            'ordine_afisare' => ['nullable', 'integer', 'min:0'],
            'activ' => ['nullable', 'boolean'],
        ], [
            'titlu.required' => 'Titlul este obligatoriu.',
            'imagine.required' => 'Calea imaginii este obligatorie (ex: img/placeholders/cat-cani.svg).',
        ]);
    }
}
