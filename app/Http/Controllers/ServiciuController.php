<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiciuController extends Controller
{
    public function index(): View
    {
        $categorii = Categorie::where('activ', true)
            ->orderBy('ordine_afisare')
            ->get();

        return view('servicii.index', compact('categorii'));
    }

    public function show(string $slug, Request $request): View
    {
        $categorie = Categorie::where('slug', $slug)
            ->where('activ', true)
            ->firstOrFail();

        $sortBy = $request->query('sort', 'default');
        $query = $categorie->produse()->where('activ', true);

        $query = match ($sortBy) {
            'pret_asc'  => $query->orderBy('pret_de_la', 'asc'),
            'pret_desc' => $query->orderBy('pret_de_la', 'desc'),
            'nume_asc'  => $query->orderBy('denumire', 'asc'),
            default     => $query->orderBy('id'),
        };

        $produse = $query->get();

        return view('servicii.show', compact('categorie', 'produse', 'sortBy'));
    }

    public function search(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $rezultate = collect();
        if (mb_strlen($q) >= 2) {
            $rezultate = Produs::with('categorie')
                ->where('activ', true)
                ->where(function ($query) use ($q) {
                    $query->where('denumire', 'like', "%{$q}%")
                          ->orWhere('descriere', 'like', "%{$q}%");
                })
                ->limit(50)
                ->get();
        }

        return view('servicii.search', [
            'q' => $q,
            'rezultate' => $rezultate,
        ]);
    }
}
