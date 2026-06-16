<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Galerie;
use Illuminate\Database\Seeder;

class GalerieSeeder extends Seeder
{
    public function run(): void
    {
        $categorii = Categorie::pluck('id', 'slug');

        $itemuri = [
            ['titlu' => 'Set căni de nuntă',       'descriere' => 'Comandă executată pentru un eveniment de nuntă din Chișinău — 80 căni personalizate cu numele invitaților.', 'categorie' => 'cani',             'imagine' => 'img/galerie/set-cani-de-nunta.jpg'],
            ['titlu' => 'Tricouri echipa corporate','descriere' => 'Set 120 tricouri cu logo pentru o companie IT din Chișinău.',                                                  'categorie' => 'tricouri-maiouri', 'imagine' => 'img/tricouri/tricou-polo.jpg'],
            ['titlu' => 'Brelocuri aniversare',     'descriere' => 'Brelocuri personalizate cadou pentru participanții la o conferință.',                                          'categorie' => 'brelocuri',        'imagine' => 'img/galerie/brelocuri-aniversare.jpg'],
            ['titlu' => 'Perne de Crăciun',         'descriere' => 'Colecție specială de perne decorative tematice de sărbători.',                                                'categorie' => 'perne',            'imagine' => 'img/galerie/perne-de-craciun.jpg'],
            ['titlu' => 'Puzzle de familie',         'descriere' => 'Puzzle 500 piese cu fotografie de familie — cadou pentru ziua bunicilor.',                                    'categorie' => 'puzzle',           'imagine' => 'img/galerie/puzzle-de-familie.jpg'],
            ['titlu' => 'Ceas restaurant',           'descriere' => 'Ceas mare de perete (40 cm) cu logo, comandat de un restaurant din centru.',                                  'categorie' => 'ceasuri',          'imagine' => 'img/galerie/ceas-restaurant.jpg'],
            ['titlu' => 'Farfurii pentru aniversare','descriere' => 'Set 4 farfurii ceramice cu fotografii de familie, ambalate cadou.',                                           'categorie' => 'farfurii',         'imagine' => 'img/galerie/farfurii-aniversare.webp'],
            ['titlu' => 'Album foto nuntă',          'descriere' => 'Imprimare profesională a 200 fotografii format 13×18 pentru un album de nuntă.',                              'categorie' => 'tipar-fotografii', 'imagine' => 'img/galerie/album-foto-nunta.webp'],
            ['titlu' => 'Căni romantice',            'descriere' => 'Pereche căni magice cu fotografii pentru cuplu — comandă recurentă pentru Ziua Îndrăgostiților.',            'categorie' => 'cani',             'imagine' => 'img/galerie/cani-romantice.jpg'],
            ['titlu' => 'Tricouri eveniment sport',  'descriere' => 'Tricouri raglan personalizate pentru o cursă caritabilă din Chișinău.',                                       'categorie' => 'tricouri-maiouri', 'imagine' => 'img/galerie/tricouri-eveniment-sport.jpg'],
            ['titlu' => 'Brelocuri din lemn',        'descriere' => 'Brelocuri gravate cu laser pentru participanții la un atelier de creație.',                                   'categorie' => 'brelocuri',        'imagine' => 'img/galerie/brelocuri-din-lemn.jpg'],
            ['titlu' => 'Perne pentru copii',        'descriere' => 'Perne cu desene animate pentru camera unui copil — cadou personalizat.',                                      'categorie' => 'perne',            'imagine' => 'img/galerie/perne-pentru-copii.jpg'],
        ];

        foreach ($itemuri as $i => $item) {
            Galerie::updateOrCreate(
                ['titlu' => $item['titlu']],
                [
                    'titlu'          => $item['titlu'],
                    'descriere'      => $item['descriere'],
                    'imagine'        => $item['imagine'],
                    'categorie_id'   => $categorii[$item['categorie']] ?? null,
                    'ordine_afisare' => $i + 1,
                    'activ'          => true,
                ]
            );
        }
    }
}
