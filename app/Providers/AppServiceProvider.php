<?php

namespace App\Providers;

use App\Models\Categorie;
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
        View::composer(['partials.navbar', 'partials.footer'], function ($view) {
            $categoriiNavbar = Categorie::where('activ', true)
                ->orderBy('ordine_afisare')
                ->get(['id', 'slug', 'denumire']);

            $view->with('categoriiNavbar', $categoriiNavbar);
        });
    }
}
