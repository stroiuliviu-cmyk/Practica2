<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Produs;
use Illuminate\Database\Seeder;

class ProduseSeeder extends Seeder
{
    public function run(): void
    {
        $produse = [
            // ===== Căni (6) =====
            'cani' => [
                [
                    'denumire' => 'Cană albă clasică 330ml',
                    'descriere' => 'Cană ceramică albă, capacitate standard 330ml. Suprafață mată exterioară, lucioasă interior. Ideală pentru cadouri de zi cu zi sau evenimente corporate.',
                    'pret_de_la' => 120.00,
                    'caracteristici' => ['material' => 'ceramică premium', 'dimensiune' => '330 ml', 'culoare' => 'alb mat'],
                    'imagine' => 'img/cani/cana-alba-330ml.jpg',
                ],
                [
                    'denumire' => 'Cană magică termoactivă',
                    'descriere' => 'Surpriza preferată! La temperatura camerei este neagră, iar la contactul cu băutura caldă (peste 50°C) imaginea apare progresiv.',
                    'pret_de_la' => 180.00,
                    'caracteristici' => ['material' => 'ceramică termoactivă', 'dimensiune' => '330 ml', 'efect' => 'culoare la cald'],
                    'imagine' => 'img/cani/cana-magic-termo.jpg',
                ],
                [
                    'denumire' => 'Cană cu inimă',
                    'descriere' => 'Cană ceramică albă cu mâner în formă de inimă. Cadou romantic clasic pentru Ziua Îndrăgostiților sau aniversări de cuplu.',
                    'pret_de_la' => 150.00,
                    'caracteristici' => ['material' => 'ceramică', 'dimensiune' => '330 ml', 'mâner' => 'formă inimă'],
                    'imagine' => 'img/cani/cana-inima.jpg',
                ],
                [
                    'denumire' => 'Cană bicoloră (interior colorat)',
                    'descriere' => 'Cană albă exterior, cu interior și mâner colorat în roșu, albastru, verde sau roz, la alegere. Combinație elegantă cu fotografia ta personalizată.',
                    'pret_de_la' => 160.00,
                    'caracteristici' => ['material' => 'ceramică', 'dimensiune' => '330 ml', 'culori interior' => 'roșu/albastru/verde/roz'],
                    'imagine' => 'img/cani/cana-bicolor.jpg',
                ],
                [
                    'denumire' => 'Cană termică din inox',
                    'descriere' => 'Cană termoizolantă din inox de înaltă calitate, păstrează temperatura băuturii ore în șir. Perfectă pentru cadouri funcționale și călătorii.',
                    'pret_de_la' => 250.00,
                    'caracteristici' => ['material' => 'inox 304', 'dimensiune' => '450 ml', 'izolație' => 'pereți dubli vacuum'],
                    'imagine' => 'img/cani/cana-termica-inox.jpg',
                ],
                [
                    'denumire' => 'Cană pentru copii cu desene animate',
                    'descriere' => 'Cană mică din ceramică nontoxică, cu mâner ergonomic pentru mâini mici. Imprimăm personajul preferat al copilului împreună cu numele lui.',
                    'pret_de_la' => 140.00,
                    'caracteristici' => ['material' => 'ceramică nontoxică', 'dimensiune' => '240 ml', 'siguranță' => 'fără BPA'],
                    'imagine' => 'img/cani/cana-copii.jpg',
                ],
            ],

            // ===== Tricouri și maiouri (6) =====
            'tricouri-maiouri' => [
                [
                    'denumire' => 'Tricou alb bumbac 100%',
                    'descriere' => 'Tricou clasic alb, bumbac 100% organic, gramaj 180 g/m². Imprimare durabilă prin DTG. Disponibil în mărimile S–XXL.',
                    'pret_de_la' => 220.00,
                    'caracteristici' => ['material' => 'bumbac 100%', 'gramaj' => '180 g/m²', 'mărimi' => 'S–XXL'],
                    'imagine' => 'img/tricouri/tricou-alb.jpg',
                ],
                [
                    'denumire' => 'Tricou polo personalizat',
                    'descriere' => 'Tricou polo cu guler și nasturi, ideal pentru cadouri corporate sau uniforme. Disponibil în alb, negru, navy, gri și verde.',
                    'pret_de_la' => 320.00,
                    'caracteristici' => ['material' => 'bumbac/poliester', 'gramaj' => '210 g/m²', 'tip' => 'polo'],
                    'imagine' => 'img/tricouri/tricou-polo.jpg',
                ],
                [
                    'denumire' => 'Tricou pentru copii',
                    'descriere' => 'Tricou din bumbac moale pentru copii cu vârste între 3–12 ani. Materialul nu irită pielea sensibilă și rezistă la spălări repetate.',
                    'pret_de_la' => 180.00,
                    'caracteristici' => ['material' => 'bumbac 100%', 'mărimi' => '3–12 ani', 'culoare' => 'alb/roz/albastru'],
                    'imagine' => 'img/tricouri/tricou-copii.jpg',
                ],
                [
                    'denumire' => 'Tricou damă fit',
                    'descriere' => 'Tricou damă cu croială fit, mai îngust pe corp. Material elastic, confortabil. Ideal pentru cadou personalizat pentru ea.',
                    'pret_de_la' => 250.00,
                    'caracteristici' => ['material' => 'bumbac/elastan', 'croială' => 'fit damă', 'mărimi' => 'XS–XL'],
                    'imagine' => 'img/tricouri/tricou-dama-fit.jpg',
                ],
                [
                    'denumire' => 'Maiou damă',
                    'descriere' => 'Maiou damă fără mâneci, ideal pentru sezonul cald sau sport. Material subțire și răcoros. Imprimare durabilă pe față și/sau spate.',
                    'pret_de_la' => 200.00,
                    'caracteristici' => ['material' => 'bumbac', 'tip' => 'fără mâneci', 'mărimi' => 'XS–XL'],
                    'imagine' => 'img/tricouri/maiou-dama.jpg',
                ],
                [
                    'denumire' => 'Tricou cu mâneci raglan',
                    'descriere' => 'Tricou sport cu mâneci raglan colorate, croială lejeră. Perfect pentru echipe sportive sau evenimente tematice.',
                    'pret_de_la' => 240.00,
                    'caracteristici' => ['material' => 'bumbac/poliester', 'tip' => 'raglan', 'mărimi' => 'S–XXL'],
                    'imagine' => 'img/tricouri/tricou-raglan.jpg',
                ],
            ],

            // ===== Brelocuri (6) =====
            'brelocuri' => [
                [
                    'denumire' => 'Breloc metalic dreptunghi',
                    'descriere' => 'Breloc din inox lucios cu imprimare prin sublimare pe ambele fețe. Format dreptunghi 35×50 mm, lanț robust.',
                    'pret_de_la' => 80.00,
                    'caracteristici' => ['material' => 'inox', 'dimensiune' => '35×50 mm', 'fețe' => '2 (față-verso)'],
                    'imagine' => 'img/brelocuri/breloc-metalic-dreptunghi.jpg',
                ],
                [
                    'denumire' => 'Breloc inimă',
                    'descriere' => 'Breloc metalic în formă de inimă cu poză personalizată. Cadou romantic clasic pentru aniversări de cuplu.',
                    'pret_de_la' => 90.00,
                    'caracteristici' => ['material' => 'metal lăcuit', 'formă' => 'inimă', 'fețe' => '1'],
                    'imagine' => 'img/brelocuri/breloc-inima.jpg',
                ],
                [
                    'denumire' => 'Breloc din lemn',
                    'descriere' => 'Breloc din lemn natural lustruit (paltin sau nuc), cu poza gravată prin laser. Cadou cu un farmec rustic deosebit.',
                    'pret_de_la' => 100.00,
                    'caracteristici' => ['material' => 'lemn natural', 'tehnică' => 'gravare laser', 'dimensiune' => '40×50 mm'],
                    'imagine' => 'img/brelocuri/breloc-din-lemn.jpg',
                ],
                [
                    'denumire' => 'Breloc din plexiglas',
                    'descriere' => 'Breloc transparent din plexiglas de 3 mm, cu poză imprimată pe spate. Efect modern și ușor.',
                    'pret_de_la' => 70.00,
                    'caracteristici' => ['material' => 'plexiglas', 'grosime' => '3 mm', 'efect' => 'transparent'],
                    'imagine' => 'img/brelocuri/breloc-plexiglas.jpg',
                ],
                [
                    'denumire' => 'Breloc dublu (foto față-verso)',
                    'descriere' => 'Breloc cu două fețe imprimate independent — o poză pe față, alta pe verso. Ideal pentru a păstra două persoane dragi împreună.',
                    'pret_de_la' => 110.00,
                    'caracteristici' => ['material' => 'metal', 'fețe' => '2 independente', 'dimensiune' => '40×60 mm'],
                    'imagine' => 'img/brelocuri/breloc-dublu.jpg',
                ],
                [
                    'denumire' => 'Breloc rotund',
                    'descriere' => 'Breloc metalic în formă de cerc, diametru 45 mm. Spațiu generos pentru o poză cu impact vizual.',
                    'pret_de_la' => 85.00,
                    'caracteristici' => ['material' => 'inox lăcuit', 'diametru' => '45 mm', 'fețe' => '1'],
                    'imagine' => 'img/brelocuri/breloc-rotund.jpg',
                ],
            ],

            // ===== Perne (6) =====
            'perne' => [
                [
                    'denumire' => 'Pernă decorativă 40×40',
                    'descriere' => 'Pernă pătrată cu față imprimată full-color, spate alb sau colorat la alegere. Fermoar invizibil. Umplutură fibră siliconică.',
                    'pret_de_la' => 220.00,
                    'caracteristici' => ['dimensiune' => '40×40 cm', 'material' => 'satin poliester', 'umplutură' => 'fibră siliconică'],
                    'imagine' => 'img/perne/perna-decorativa-40x40.jpg',
                ],
                [
                    'denumire' => 'Pernă călătorie tip C',
                    'descriere' => 'Pernă pentru gât în formă de C, ideală pentru călătorii lungi cu avionul, mașina sau trenul. Imprimare pe partea superioară.',
                    'pret_de_la' => 280.00,
                    'caracteristici' => ['dimensiune' => '30 cm', 'formă' => 'C (gât)', 'utilizare' => 'călătorie'],
                    'imagine' => 'img/perne/perna-calatorie-C.jpg',
                ],
                [
                    'denumire' => 'Pernă copii cu desene',
                    'descriere' => 'Pernă moale și sigură pentru copii, cu desene animate sau poze de familie. Material hipoalergenic, pretabil pentru spălare la 30°C.',
                    'pret_de_la' => 200.00,
                    'caracteristici' => ['dimensiune' => '35×35 cm', 'material' => 'hipoalergenic', 'siguranță' => 'fără substanțe toxice'],
                    'imagine' => 'img/perne/perna-copii.jpg',
                ],
                [
                    'denumire' => 'Pernă mare 50×70',
                    'descriere' => 'Pernă rectangulară mare, perfectă pentru pat sau canapea. Imprimare full-color pe toată suprafața.',
                    'pret_de_la' => 320.00,
                    'caracteristici' => ['dimensiune' => '50×70 cm', 'material' => 'satin/bumbac', 'umplutură' => 'fibră siliconică'],
                    'imagine' => 'img/perne/perna-mare-50x70.jpg',
                ],
                [
                    'denumire' => 'Pernă cu față foto + spate text',
                    'descriere' => 'Pernă duală: pe față fotografia, pe spate un mesaj sau o dedicație personalizată. Cadou emoționant pentru evenimente speciale.',
                    'pret_de_la' => 260.00,
                    'caracteristici' => ['dimensiune' => '40×40 cm', 'fețe' => '2 imprimate', 'tip' => 'foto + text'],
                    'imagine' => 'img/perne/perna-foto-spate-text.jpg',
                ],
                [
                    'denumire' => 'Pernă rotundă',
                    'descriere' => 'Pernă în formă de disc, diametru 40 cm. Look modern și elegant pentru decor interior.',
                    'pret_de_la' => 240.00,
                    'caracteristici' => ['diametru' => '40 cm', 'formă' => 'rotundă', 'material' => 'satin'],
                    'imagine' => 'img/perne/perna-rotunda.jpg',
                ],
            ],

            // ===== Puzzle (6) =====
            'puzzle' => [
                [
                    'denumire' => 'Puzzle 60 piese A5',
                    'descriere' => 'Puzzle din carton premium, ideal pentru începători sau copii. Dimensiune finală A5 (148×210 mm). Ambalat cadou.',
                    'pret_de_la' => 130.00,
                    'caracteristici' => ['piese' => 60, 'dimensiune' => 'A5', 'material' => 'carton dur'],
                    'imagine' => 'img/puzzle/puzzle-60-a5.jpg',
                ],
                [
                    'denumire' => 'Puzzle 120 piese A4',
                    'descriere' => 'Puzzle de dimensiune medie, format A4 (210×297 mm). Echilibru perfect între dificultate și plăcere.',
                    'pret_de_la' => 170.00,
                    'caracteristici' => ['piese' => 120, 'dimensiune' => 'A4', 'material' => 'carton dur'],
                    'imagine' => 'img/puzzle/puzzle-120-a4.jpg',
                ],
                [
                    'denumire' => 'Puzzle 240 piese A4',
                    'descriere' => 'Puzzle pentru pasionați, 240 de piese pe format A4. Provocare ideală pentru o seară în familie.',
                    'pret_de_la' => 210.00,
                    'caracteristici' => ['piese' => 240, 'dimensiune' => 'A4', 'material' => 'carton dur'],
                    'imagine' => 'img/puzzle/puzzle-240-a4.jpg',
                ],
                [
                    'denumire' => 'Puzzle 500 piese A3',
                    'descriere' => 'Puzzle XL — 500 piese pe format A3 (297×420 mm). Pentru experți care iubesc provocările vizuale ample.',
                    'pret_de_la' => 320.00,
                    'caracteristici' => ['piese' => 500, 'dimensiune' => 'A3', 'material' => 'carton premium'],
                    'imagine' => 'img/puzzle/puzzle-500-a3.jpg',
                ],
                [
                    'denumire' => 'Puzzle din lemn',
                    'descriere' => 'Puzzle eco-friendly din lemn natural lustruit. Piese groase, durabile, cu imaginea gravată prin sublimare. Cadou premium.',
                    'pret_de_la' => 380.00,
                    'caracteristici' => ['piese' => 80, 'material' => 'lemn natural', 'dimensiune' => '20×30 cm'],
                    'imagine' => 'img/puzzle/puzzle-din-lemn.jpg',
                ],
                [
                    'denumire' => 'Puzzle pentru copii formă inimă',
                    'descriere' => 'Puzzle cu piese mari în formă de inimă, perfecte pentru copii mici (3–6 ani). Margini rotunjite, fără pericol de tăiere.',
                    'pret_de_la' => 150.00,
                    'caracteristici' => ['piese' => 30, 'formă' => 'inimă', 'vârstă' => '3+ ani'],
                    'imagine' => 'img/puzzle/puzzle-copii-inima.jpg',
                ],
            ],

            // ===== Ceasuri (6) =====
            'ceasuri' => [
                [
                    'denumire' => 'Ceas de perete rotund 30cm',
                    'descriere' => 'Ceas clasic de perete, diametru 30 cm. Cadran personalizat cu poza ta. Mecanism quartz silențios.',
                    'pret_de_la' => 320.00,
                    'caracteristici' => ['diametru' => '30 cm', 'mecanism' => 'quartz', 'baterie' => 'AA (inclusă)'],
                    'imagine' => 'img/ceasuri/ceas-de-perete-rotund-30-cm.jpg',
                ],
                [
                    'denumire' => 'Ceas de perete pătrat 30×30',
                    'descriere' => 'Ceas modern de perete, format pătrat 30×30 cm. Design contemporan, cifrele de pe fundalul foto personalizat.',
                    'pret_de_la' => 340.00,
                    'caracteristici' => ['dimensiune' => '30×30 cm', 'formă' => 'pătrat', 'mecanism' => 'quartz'],
                    'imagine' => 'img/ceasuri/ceas-de-perete-patrat-30-30.jpg',
                ],
                [
                    'denumire' => 'Ceas mare 40cm',
                    'descriere' => 'Ceas XL de perete, diametru 40 cm. Impact vizual mare, ideal pentru hol sau living spațios.',
                    'pret_de_la' => 420.00,
                    'caracteristici' => ['diametru' => '40 cm', 'mecanism' => 'quartz silențios', 'material' => 'MDF + sticlă'],
                    'imagine' => 'img/ceasuri/ceas-mare-40-cm.jpg',
                ],
                [
                    'denumire' => 'Ceas de masă cu poză',
                    'descriere' => 'Ceas de birou compact (15×20 cm), perfect cadou personalizat pentru colegi sau cadou de pensionare.',
                    'pret_de_la' => 280.00,
                    'caracteristici' => ['dimensiune' => '15×20 cm', 'tip' => 'birou', 'suport' => 'metalic'],
                    'imagine' => 'img/ceasuri/ceas-de-masa-cu-poza.jpg',
                ],
                [
                    'denumire' => 'Ceas digital cu cadran personalizat',
                    'descriere' => 'Ceas digital cu LED-uri și ramă personalizată. Afișaj alb sau roșu, multiple funcții (alarmă, calendar).',
                    'pret_de_la' => 380.00,
                    'caracteristici' => ['tip' => 'digital', 'afișaj' => 'LED', 'funcții' => 'oră/dată/alarmă'],
                    'imagine' => 'img/ceasuri/ceas-digital-cu-cadran-personalizat.jpg',
                ],
                [
                    'denumire' => 'Ceas pentru copii',
                    'descriere' => 'Ceas de perete cu desene animate pentru camera copilului. Forme amuzante (stea, nor, urs). Mecanism silențios.',
                    'pret_de_la' => 260.00,
                    'caracteristici' => ['diametru' => '25 cm', 'tematică' => 'copii', 'mecanism' => 'silențios'],
                    'imagine' => 'img/ceasuri/ceas-pentru-copii.jpg',
                ],
            ],

            // ===== Farfurii (6) =====
            'farfurii' => [
                [
                    'denumire' => 'Farfurie ceramică 20cm',
                    'descriere' => 'Farfurie ceramică decorativă cu fotografia ta personalizată. Diametru 20 cm. Suprafață lucioasă, rezistentă la spălare.',
                    'pret_de_la' => 180.00,
                    'caracteristici' => ['diametru' => '20 cm', 'material' => 'ceramică', 'suprafață' => 'lucioasă'],
                    'imagine' => 'img/farfurii/farfurie-ceramica-20cm.jpg',
                ],
                [
                    'denumire' => 'Farfurie 25cm decorativă',
                    'descriere' => 'Farfurie ceramică 25 cm. Versiune mai mare, potrivită pentru afișare pe perete sau ca decor de masă.',
                    'pret_de_la' => 230.00,
                    'caracteristici' => ['diametru' => '25 cm', 'material' => 'ceramică', 'utilizare' => 'decorativă'],
                    'imagine' => 'img/farfurii/farfurie-25cm-decorativa.jpg',
                ],
                [
                    'denumire' => 'Farfurie rectangulară 20×25',
                    'descriere' => 'Farfurie cu formă rectangulară modernă (20×25 cm). Design contemporan, perfect pentru bucătărie elegantă.',
                    'pret_de_la' => 240.00,
                    'caracteristici' => ['dimensiune' => '20×25 cm', 'formă' => 'rectangulară', 'material' => 'ceramică'],
                    'imagine' => 'img/farfurii/farfurie-rectangulara-20x25.jpg',
                ],
                [
                    'denumire' => 'Farfurie cu suport',
                    'descriere' => 'Farfurie decorativă 22 cm livrată cu suport metalic pentru expunere. Cadou aniversar elegant.',
                    'pret_de_la' => 280.00,
                    'caracteristici' => ['diametru' => '22 cm', 'accesoriu' => 'suport metalic', 'utilizare' => 'decor'],
                    'imagine' => 'img/farfurii/farfurie-cu-suport.jpg',
                ],
                [
                    'denumire' => 'Set 2 farfurii',
                    'descriere' => 'Set cadou cu 2 farfurii personalizate (20 cm fiecare). Ambalat în cutie cadou. Reducere față de prețul individual.',
                    'pret_de_la' => 320.00,
                    'caracteristici' => ['cantitate' => 2, 'diametru' => '20 cm', 'ambalaj' => 'cutie cadou'],
                    'imagine' => 'img/farfurii/set-2-farfurii.jpg',
                ],
                [
                    'denumire' => 'Farfurie pentru copii',
                    'descriere' => 'Farfurie ceramică mai mică (18 cm) cu desene animate sau poză personalizată. Sigură pentru cuptor cu microunde.',
                    'pret_de_la' => 160.00,
                    'caracteristici' => ['diametru' => '18 cm', 'siguranță' => 'food safe', 'tematică' => 'copii'],
                    'imagine' => 'img/farfurii/farfurie-pentru-copii.jpg',
                ],
            ],

            // ===== Tipar fotografii (6) =====
            'tipar-fotografii' => [
                [
                    'denumire' => 'Format 10×15 cm',
                    'descriere' => 'Fotografii imprimate pe hârtie foto premium 10×15 cm. Hârtie lucioasă sau mată la alegere. Reproducere fidelă a culorilor.',
                    'pret_de_la' => 6.00,
                    'caracteristici' => ['dimensiune' => '10×15 cm', 'hârtie' => 'lucioasă/mată', 'unitate' => 'per bucată'],
                    'imagine' => 'img/tipar/format-10x15-cm.png',
                ],
                [
                    'denumire' => 'Format 13×18 cm',
                    'descriere' => 'Fotografii imprimate format mediu 13×18 cm. Ideale pentru rame standard sau albume foto clasice.',
                    'pret_de_la' => 10.00,
                    'caracteristici' => ['dimensiune' => '13×18 cm', 'hârtie' => 'foto Fuji/Kodak', 'unitate' => 'per bucată'],
                    'imagine' => 'img/tipar/format-13x18-cm.webp',
                ],
                [
                    'denumire' => 'Format 15×20 cm',
                    'descriere' => 'Fotografii imprimate format 15×20 cm. Detalii fine vizibile, potrivite pentru cadre mari sau cadou personalizat.',
                    'pret_de_la' => 15.00,
                    'caracteristici' => ['dimensiune' => '15×20 cm', 'hârtie' => 'foto premium', 'unitate' => 'per bucată'],
                    'imagine' => 'img/tipar/format-15x20-cm.jpg',
                ],
                [
                    'denumire' => 'Format A4 (21×29.7)',
                    'descriere' => 'Fotografii imprimate la format A4 — perfecte pentru postere mici, cadouri pentru perete sau prezentări.',
                    'pret_de_la' => 35.00,
                    'caracteristici' => ['dimensiune' => 'A4 (21×29.7 cm)', 'hârtie' => 'foto sau dublă față', 'unitate' => 'per bucată'],
                    'imagine' => 'img/tipar/format-a4.jpg',
                ],
                [
                    'denumire' => 'Format A3 (29.7×42)',
                    'descriere' => 'Fotografii imprimate format A3 — pentru postere mari, decoruri sau cadouri impresionante.',
                    'pret_de_la' => 60.00,
                    'caracteristici' => ['dimensiune' => 'A3 (29.7×42 cm)', 'hârtie' => 'foto premium', 'unitate' => 'per bucată'],
                    'imagine' => 'img/tipar/format-a3.jpg',
                ],
                [
                    'denumire' => 'Pachet 50 poze 10×15',
                    'descriere' => 'Pachet economic — 50 de fotografii 10×15 cm imprimate la preț redus. Ideal pentru evenimente sau albume mari.',
                    'pret_de_la' => 250.00,
                    'caracteristici' => ['cantitate' => 50, 'dimensiune' => '10×15 cm', 'reducere' => '15%'],
                    'imagine' => 'img/tipar/pachet-50-poze-10x15.jpg',
                ],
            ],
        ];

        foreach ($produse as $slug => $listaProduse) {
            $categorie = Categorie::where('slug', $slug)->first();
            if (! $categorie) {
                continue;
            }

            foreach ($listaProduse as $produs) {
                Produs::updateOrCreate(
                    [
                        'categorie_id' => $categorie->id,
                        'denumire' => $produs['denumire'],
                    ],
                    array_merge($produs, [
                        'categorie_id' => $categorie->id,
                        'activ' => true,
                    ])
                );
            }
        }
    }
}
