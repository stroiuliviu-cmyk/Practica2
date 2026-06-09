<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generează sitemap.xml dinamic — include rutele publice + toate categoriile.
     */
    public function index(): Response
    {
        $urls = collect();

        // Pagini statice
        $statice = [
            ['loc' => route('home'),            'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => route('despre'),          'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => route('servicii.index'),  'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => route('galerie.index'),   'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('contacte.index'),  'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        foreach ($statice as $s) {
            $urls->push([
                'loc' => $s['loc'],
                'lastmod' => now()->toIso8601String(),
                'priority' => $s['priority'],
                'changefreq' => $s['changefreq'],
            ]);
        }

        // Categorii (dinamic)
        Categorie::where('activ', true)->each(function ($cat) use ($urls) {
            $urls->push([
                'loc' => route('servicii.show', $cat->slug),
                'lastmod' => $cat->updated_at?->toIso8601String() ?? now()->toIso8601String(),
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ]);
        });

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    /**
     * Generează robots.txt — politică index pentru motoarele de căutare.
     */
    public function robots(): Response
    {
        $content = "User-agent: *\n"
            . "Allow: /\n"
            . "Disallow: /admin\n"
            . "Disallow: /admin/*\n"
            . "Disallow: /login\n"
            . "Disallow: /logout\n"
            . "\n"
            . "Sitemap: " . route('sitemap') . "\n";

        return response($content, 200, ['Content-Type' => 'text/plain']);
    }
}
