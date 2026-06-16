<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategoriiSeeder extends Seeder
{
    public function run(): void
    {
        $categorii = [
            [
                'slug' => 'cani',
                'denumire' => 'Căni personalizate',
                'descriere_scurta' => 'Cadou clasic și emoțional, perfect pentru orice ocazie din viața celor dragi.',
                'descriere_completa' => 'Cănile personalizate sunt unul dintre cele mai populare cadouri oferite de FotoMoments. Imprimăm fotografii, mesaje și logo-uri pe căni ceramice, magice (termoactive), bicolore și termice din inox. Procesul de imprimare prin sublimare termică asigură rezistența culorilor la spălare și utilizare îndelungată. Comanda standard se execută pe loc în 15–20 de minute.',
                'imagine' => 'img/categorii/cat-cani.jpg',
                'ordine_afisare' => 1,
                'activ' => true,
            ],
            [
                'slug' => 'tricouri-maiouri',
                'denumire' => 'Tricouri și maiouri',
                'descriere_scurta' => 'Imprimare durabilă pe textile de calitate, pentru orice vârstă și gust.',
                'descriere_completa' => 'Personalizăm tricouri și maiouri folosind tehnologia DTG (Direct to Garment) și transferuri termice profesionale. Avem o gamă variată: tricouri din bumbac 100%, polo, raglan, maiouri damă, tricouri pentru copii. Designul este pregătit împreună cu clientul, iar fiecare produs trece printr-un control de calitate înainte de livrare.',
                'imagine' => 'img/categorii/cat-tricouri-maiouri.jpg',
                'ordine_afisare' => 2,
                'activ' => true,
            ],
            [
                'slug' => 'brelocuri',
                'denumire' => 'Brelocuri personalizate',
                'descriere_scurta' => 'Mici, practice și pline de sens — un cadou pe care îl porți cu tine zilnic.',
                'descriere_completa' => 'Brelocurile personalizate FotoMoments sunt cadouri elegante și utile. Lucrăm cu diverse materiale: metal (inox, aluminiu), lemn natural lustruit, plexiglas transparent sau colorat. Forme disponibile: dreptunghi, inimă, rotundă, ovală. Imprimarea se face prin sublimare sau gravare cu laser, în funcție de material.',
                'imagine' => 'img/categorii/cat-brelocuri.jpg',
                'ordine_afisare' => 3,
                'activ' => true,
            ],
            [
                'slug' => 'perne',
                'denumire' => 'Perne personalizate',
                'descriere_scurta' => 'Confort și amintiri reunite într-un singur cadou plin de afecțiune.',
                'descriere_completa' => 'Pernele personalizate sunt potrivite pentru cadouri romantice, aniversări sau pentru decorarea camerei copiilor. Materialul exterior este țesătură satinată, iar interiorul cu fibră siliconică hipoalergenică. Imprimăm fotografii pe față, text pe spate, sau combinații creative. Disponibile în dimensiuni: 40×40, 50×50, 50×70 cm și formă tip C pentru călătorie.',
                'imagine' => 'img/categorii/cat-perne.jpg',
                'ordine_afisare' => 4,
                'activ' => true,
            ],
            [
                'slug' => 'puzzle',
                'denumire' => 'Puzzle personalizate',
                'descriere_scurta' => 'Jocul de copilărie reinterpretat ca amintire interactivă și emoțională.',
                'descriere_completa' => 'Puzzle-urile personalizate transformă o fotografie dragă într-un joc captivant. Sunt potrivite atât pentru copii, cât și pentru adulți care doresc o amintire interactivă. Disponibile din carton dur sau lemn, în mai multe dimensiuni: 60 piese (A5), 120 piese (A4), 240 piese (A4), 500 piese (A3). Ambalate cadou în cutie cu imaginea finală pe capac.',
                'imagine' => 'img/categorii/cat-puzzle.jpg',
                'ordine_afisare' => 5,
                'activ' => true,
            ],
            [
                'slug' => 'ceasuri',
                'denumire' => 'Ceasuri personalizate',
                'descriere_scurta' => 'Timpul tău, decorat cu cele mai dragi imagini și momente.',
                'descriere_completa' => 'Ceasurile personalizate FotoMoments combină funcționalitatea cu emoția. Realizăm ceasuri de perete (rotunde sau pătrate) și ceasuri de masă, cu cadranul personalizat. Mecanismul este silențios (quartz), alimentat cu baterie AA. Sunt potrivite pentru cadouri de nuntă, aniversări, pensionări sau cadouri corporate.',
                'imagine' => 'img/categorii/cat-ceasuri.jpg',
                'ordine_afisare' => 6,
                'activ' => true,
            ],
            [
                'slug' => 'farfurii',
                'denumire' => 'Farfurii personalizate',
                'descriere_scurta' => 'Decorative sau funcționale — un cadou rafinat care impresionează.',
                'descriere_completa' => 'Farfuriile personalizate sunt potrivite pentru decor sau pentru cadouri elegante. Materialul ceramic premium, alb mat sau lucios, este compatibil cu mașina de spălat vase și cuptorul cu microunde. Imprimăm fotografii, mesaje sau logo-uri prin sublimare termică, cu o garanție de durabilitate a imaginii de 5+ ani.',
                'imagine' => 'img/categorii/cat-farfurii.jpg',
                'ordine_afisare' => 7,
                'activ' => true,
            ],
            [
                'slug' => 'tipar-fotografii',
                'denumire' => 'Tipar fotografii',
                'descriere_scurta' => 'Fotografii imprimate profesional, în orice format și pe hârtie de calitate.',
                'descriere_completa' => 'Pe lângă obiectele personalizate, oferim și servicii clasice de tipar fotografic. Folosim hârtie foto profesională Fujifilm sau Kodak (lucioasă sau mată), cu reproducere fidelă a culorilor. Format-uri disponibile: 10×15, 13×18, 15×20 cm, A4, A3. Pentru comenzi mari (peste 50 de poze), oferim discount semnificativ.',
                'imagine' => 'img/categorii/cat-tipar-fotografii.jpg',
                'ordine_afisare' => 8,
                'activ' => true,
            ],
        ];

        foreach ($categorii as $categorie) {
            Categorie::updateOrCreate(
                ['slug' => $categorie['slug']],
                $categorie
            );
        }
    }
}
