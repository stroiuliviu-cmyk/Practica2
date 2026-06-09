<?php

namespace App\Providers;

use App\Models\Categorie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Injectează categoriile active în navbar (dropdown Servicii) și în footer.
        // Folosim cache pentru a evita query-ul repetat la fiecare pagină.
        // Cache expire: 1 oră (poate fi golit manual din panou admin la modificări).
        View::composer(['partials.navbar', 'partials.footer'], function ($view) {
            $categoriiNavbar = Cache::remember(
                'navbar.categorii',
                now()->addHour(),
                fn () => Categorie::where('activ', true)
                    ->orderBy('ordine_afisare')
                    ->get(['id', 'slug', 'denumire'])
            );

            $view->with('categoriiNavbar', $categoriiNavbar);
        });

        // Invalidează cache-ul când se modifică o categorie
        Categorie::saved(fn () => Cache::forget('navbar.categorii'));
        Categorie::deleted(fn () => Cache::forget('navbar.categorii'));
    }
}
