<?php

namespace Database\Seeders;

use App\Models\SupermarketLayout;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupermarketLayoutsSeeder extends Seeder
{
    /**
     * Popola il layout di default (__default__) con l'ordine tipico
     * di un supermercato italiano, usando solo le categorie padre.
     *
     * Gli ordini sono multipli di 10 per lasciare spazio a inserimenti futuri.
     * L'utente dovrà spostare al massimo 3-4 categorie per adattarlo al suo negozio.
     */
    public function run(): void
    {
        // Helper per recuperare l'id di una categoria per nome
        $id = fn(string $name) => DB::table('categories')->where('name', $name)->value('id');

        $layout = [
            ['category' => 'Verdura',               'aisle_order' => 10],
            ['category' => 'Frutta',                'aisle_order' => 20],
            ['category' => 'Latticini e Uova',      'aisle_order' => 30],
            ['category' => 'Carne',                 'aisle_order' => 40],
            ['category' => 'Pesce e Frutti di Mare','aisle_order' => 50],
            ['category' => 'Salumi e Affettati',    'aisle_order' => 60],
            ['category' => 'Pasta e Riso',          'aisle_order' => 70],
            ['category' => 'Legumi',                'aisle_order' => 80],
            ['category' => 'Conserve e Sughi',      'aisle_order' => 90],
            ['category' => 'Condimenti',            'aisle_order' => 100],
            ['category' => 'Spezie ed Erbe Aromatiche', 'aisle_order' => 110],
            ['category' => 'Olio, Aceto e Salse',   'aisle_order' => 120],
            ['category' => 'Pane e Prodotti da Forno', 'aisle_order' => 130],
            ['category' => 'Dolci e Snack',         'aisle_order' => 140],
            ['category' => 'Bevande',               'aisle_order' => 150],
            ['category' => 'Surgelati',             'aisle_order' => 160],
            ['category' => 'Pulizia Casa',          'aisle_order' => 170],
            ['category' => 'Igiene Personale',      'aisle_order' => 180],
        ];

        foreach ($layout as $row) {
            SupermarketLayout::updateOrCreate(
                [
                    'retailer_name' => SupermarketLayout::DEFAULT_RETAILER,
                    'category_id'   => $id($row['category']),
                ],
                [
                    'aisle_order' => $row['aisle_order'],
                ]
            );
        }
    }
}
