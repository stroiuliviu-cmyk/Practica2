<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Galerie;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalerieController extends Controller
{
    public function index(Request $request): View
    {
        $filterCategorie = $request->query('categorie');

        $query = Galerie::with('categorie')
            ->where('activ', true)
            ->orderBy('ordine_afisare');

        if ($filterCategorie) {
            $cat = Categorie::where('slug', $filterCategorie)->first();
            if ($cat) {
                $query->where('categorie_id', $cat->id);
            }
        }

        $itemuri = $query->get();
        $categorii = Categorie::where('activ', true)
            ->orderBy('ordine_afisare')
            ->get();

        return view('galerie', compact('itemuri', 'categorii', 'filterCategorie'));
    }
}
