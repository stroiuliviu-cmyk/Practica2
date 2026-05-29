<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategorieController extends Controller
{
    public function index(): View
    {
        $categorii = Categorie::withCount('produse')
            ->orderBy('ordine_afisare')
            ->get();

        return view('admin.categorii.index', compact('categorii'));
    }

    public function create(): View
    {
        return view('admin.categorii.form', ['categorie' => new Categorie()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['denumire']);
        $data['activ'] = (bool) ($data['activ'] ?? false);

        Categorie::create($data);

        return redirect()->route('admin.categorii.index')
            ->with('success', 'Categoria a fost creată cu succes.');
    }

    public function edit(Categorie $categorii): View
    {
        return view('admin.categorii.form', ['categorie' => $categorii]);
    }

    public function update(Request $request, Categorie $categorii): RedirectResponse
    {
        $data = $this->validateData($request, $categorii->id);
        $data['slug'] = $data['slug'] ?: Str::slug($data['denumire']);
        $data['activ'] = (bool) ($data['activ'] ?? false);

        $categorii->update($data);

        return redirect()->route('admin.categorii.index')
            ->with('success', 'Categoria „' . $categorii->denumire . '" a fost actualizată.');
    }

    public function destroy(Categorie $categorii): RedirectResponse
    {
        $nume = $categorii->denumire;
        $categorii->delete();

        return redirect()->route('admin.categorii.index')
            ->with('success', 'Categoria „' . $nume . '" a fost ștearsă (împreună cu produsele sale).');
    }

    private function validateData(Request $request, ?int $excludeId = null): array
    {
        $slugUnique = 'unique:categorii,slug';
        if ($excludeId) {
            $slugUnique .= ',' . $excludeId;
        }

        return $request->validate([
            'denumire' => ['required', 'string', 'min:2', 'max:150'],
            'slug' => ['nullable', 'string', 'max:100', $slugUnique],
            'descriere_scurta' => ['nullable', 'string', 'max:300'],
            'descriere_completa' => ['nullable', 'string'],
            'imagine' => ['nullable', 'string', 'max:255'],
            'ordine_afisare' => ['nullable', 'integer', 'min:0'],
            'activ' => ['nullable', 'boolean'],
        ], [
            'denumire.required' => 'Denumirea este obligatorie.',
            'denumire.min' => 'Denumirea trebuie să aibă cel puțin :min caractere.',
            'slug.unique' => 'Acest slug este deja folosit.',
        ]);
    }
}
