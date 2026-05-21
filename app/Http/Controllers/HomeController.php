<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categorii = Categorie::where('activ', true)
            ->orderBy('ordine_afisare')
            ->get();

        return view('home', compact('categorii'));
    }
}
