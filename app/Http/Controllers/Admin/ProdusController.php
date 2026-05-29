<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Produs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdusController extends Controller
{
    public function index(Request $request): View
    {
        $filterCategorie = $request->query('categorie_id');

        $query = Produs::with('categorie');
        if ($filterCategorie) {
            $query->where('categorie_id', $filterCategorie);
        }

        $produse = $query->orderBy('categorie_id')->orderBy('id')->paginate(20)->withQueryString();
        $categorii = Categorie::orderBy('ordine_afisare')->get(['id', 'denumire']);

        return view('admin.produse.index', compact('produse', 'categorii', 'filterCategorie'));
    }

    public function create(): View
    {
        $categorii = Categorie::orderBy('ordine_afisare')->get(['id', 'denumire']);
        return view('admin.produse.form', [
            'produs' => new Produs(),
            'categorii' => $categorii,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['caracteristici'] = $this->parseCaracteristici($data['caracteristici_raw'] ?? '');
        unset($data['caracteristici_raw']);
        $data['activ'] = (bool) ($data['activ'] ?? false);

        Produs::create($data);

        return redirect()->route('admin.produse.index')
            ->with('success', 'Produsul a fost creat cu succes.');
    }

    public function edit(Produs $produse): View
    {
        $categorii = Categorie::orderBy('ordine_afisare')->get(['id', 'denumire']);
        return view('admin.produse.form', [
            'produs' => $produse,
            'categorii' => $categorii,
        ]);
    }

    public function update(Request $request, Produs $produse): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['caracteristici'] = $this->parseCaracteristici($data['caracteristici_raw'] ?? '');
        unset($data['caracteristici_raw']);
        $data['activ'] = (bool) ($data['activ'] ?? false);

        $produse->update($data);

        return redirect()->route('admin.produse.index')
            ->with('success', 'Produsul „' . $produse->denumire . '" a fost actualizat.');
    }

    public function destroy(Produs $produse): RedirectResponse
    {
        $nume = $produse->denumire;
        $produse->delete();

        return redirect()->route('admin.produse.index')
            ->with('success', 'Produsul „' . $nume . '" a fost șters.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'categorie_id' => ['required', 'exists:categorii,id'],
            'denumire' => ['required', 'string', 'min:2', 'max:200'],
            'descriere' => ['nullable', 'string'],
            'imagine' => ['nullable', 'string', 'max:255'],
            'pret_de_la' => ['nullable', 'numeric', 'min:0', 'max:999999.99'],
            'caracteristici_raw' => ['nullable', 'string'],
            'activ' => ['nullable', 'boolean'],
        ], [
            'categorie_id.required' => 'Selectează o categorie.',
            'denumire.required' => 'Denumirea este obligatorie.',
            'pret_de_la.numeric' => 'Prețul trebuie să fie un număr.',
        ]);
    }

    /**
     * Parse format "cheie: valoare\ncheie: valoare" în array asociativ pentru JSON.
     */
    private function parseCaracteristici(string $raw): array
    {
        $rezultat = [];
        foreach (preg_split('/\r?\n/', trim($raw)) as $linie) {
            $linie = trim($linie);
            if ($linie === '' || ! str_contains($linie, ':')) {
                continue;
            }
            [$cheie, $valoare] = explode(':', $linie, 2);
            $cheie = trim($cheie);
            $valoare = trim($valoare);
            if ($cheie !== '' && $valoare !== '') {
                $rezultat[$cheie] = $valoare;
            }
        }
        return $rezultat;
    }
}
