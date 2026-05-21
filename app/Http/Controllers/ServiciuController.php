<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
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

    public function show(string $slug): View
    {
        $categorie = Categorie::where('slug', $slug)
            ->where('activ', true)
            ->firstOrFail();

        $produse = $categorie->produse()
            ->where('activ', true)
            ->orderBy('id')
            ->get();

        return view('servicii.show', compact('categorie', 'produse'));
    }
}
