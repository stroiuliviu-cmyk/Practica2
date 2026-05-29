<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Galerie;
use App\Models\MesajContact;
use App\Models\NewsletterSubscriber;
use App\Models\Produs;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'categorii' => Categorie::count(),
            'categorii_active' => Categorie::where('activ', true)->count(),
            'produse' => Produs::count(),
            'produse_active' => Produs::where('activ', true)->count(),
            'galerie' => Galerie::count(),
            'mesaje' => MesajContact::count(),
            'mesaje_necitite' => MesajContact::where('citit', false)->count(),
            'newsletter' => NewsletterSubscriber::where('activ', true)->count(),
        ];

        $ultimeleMesaje = MesajContact::orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'ultimeleMesaje'));
    }
}
