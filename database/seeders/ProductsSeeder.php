<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Helper per recuperare id categoria per nome
        $cat = fn (string $name) => DB::table('categories')->where('name', $name)->value('id');

        // Helper per recuperare id unità per simbolo
        $unit = fn (string $symbol) => DB::table('units')->where('symbol', $symbol)->value('id');

        $products = [
            // --- Pasta e Riso ---
            ['category' => 'Pasta Secca',       'name' => 'Spaghetti',          'unit' => 'g',      'content' => 500],
            ['category' => 'Pasta Secca',       'name' => 'Penne',              'unit' => 'g',      'content' => 500],
            ['category' => 'Pasta Secca',       'name' => 'Pasta lunga',        'unit' => 'g',      'content' => 500],
            ['category' => 'Pasta Secca',       'name' => 'Pasta corte',        'unit' => 'g',      'content' => 500],
            ['category' => 'Pasta Fresca',      'name' => 'Pasta Fresca',       'unit' => 'g',      'content' => 250],
            ['category' => 'Riso',              'name' => 'Riso',               'unit' => 'g',      'content' => 1000],
            ['category' => 'Cereali e Farro',   'name' => 'Farro',              'unit' => 'g',      'content' => 500],
            ['category' => 'Cereali e Farro',   'name' => 'Orzo',               'unit' => 'g',      'content' => 500],

            // --- Pane e Prodotti da Forno ---
            ['category' => 'Pane',              'name' => 'Pane',               'unit' => 'g',      'content' => 500],
            ['category' => 'Grissini',          'name' => 'Grissini',           'unit' => 'g',      'content' => 125],
            ['category' => 'Crackers',          'name' => 'Crackers',           'unit' => 'g',      'content' => 200],
            ['category' => 'Farine',            'name' => 'Farina',             'unit' => 'g',      'content' => 1000],
            ['category' => 'Lievito',           'name' => 'Lievito',            'unit' => 'g',      'content' => 25],

            // --- Latticini e Uova ---
            ['category' => 'Latte',             'name' => 'Latte',              'unit' => 'l',      'content' => 1],
            ['category' => 'Formaggi Freschi',  'name' => 'Mozzarella',         'unit' => 'g',      'content' => 125],
            ['category' => 'Formaggi Stagionati','name' => 'Parmigiano',        'unit' => 'g',      'content' => 200],
            ['category' => 'Formaggi Stagionati','name' => 'Pecorino',          'unit' => 'g',      'content' => 200],
            ['category' => 'Yogurt',            'name' => 'Yogurt',             'unit' => 'g',      'content' => 125],
            ['category' => 'Burro',             'name' => 'Burro',              'unit' => 'g',      'content' => 250],
            ['category' => 'Panna',             'name' => 'Panna',              'unit' => 'ml',     'content' => 200],
            ['category' => 'Uova',              'name' => 'Uova',               'unit' => 'pz',     'content' => 6],

            // --- Carne ---
            ['category' => 'Carne Bovina',      'name' => 'Manzo',              'unit' => 'g',      'content' => 500],
            ['category' => 'Carne Suina',       'name' => 'Maiale',             'unit' => 'g',      'content' => 500],
            ['category' => 'Pollame',           'name' => 'Pollo',              'unit' => 'g',      'content' => 1000],
            ['category' => 'Carne Macinata',    'name' => 'Carne Macinata',     'unit' => 'g',      'content' => 500],

            // --- Pesce e Frutti di Mare ---
            ['category' => 'Pesce Fresco',      'name' => 'Pesce Fresco',       'unit' => 'g',      'content' => 500],
            ['category' => 'Pesce in Scatola',  'name' => 'Tonno in Scatola',   'unit' => 'g',      'content' => 80],
            ['category' => 'Frutti di Mare',    'name' => 'Vongole',            'unit' => 'g',      'content' => 500],
            ['category' => 'Frutti di Mare',    'name' => 'Cozze',              'unit' => 'g',      'content' => 500],

            // --- Salumi e Affettati ---
            ['category' => 'Prosciutto',        'name' => 'Prosciutto Cotto',   'unit' => 'g',      'content' => 250],
            ['category' => 'Prosciutto',        'name' => 'Prosciutto Crudo',   'unit' => 'g',      'content' => 200],
            ['category' => 'Salame',            'name' => 'Salame',             'unit' => 'g',      'content' => 200],
            ['category' => 'Insaccati',         'name' => 'Mortadella',         'unit' => 'g',      'content' => 250],
            ['category' => 'Insaccati',         'name' => 'Pancetta',           'unit' => 'g',      'content' => 250],
            ['category' => 'Wurstel',           'name' => 'Wurstel',            'unit' => 'pz',     'content' => 4],

            // --- Verdura ---
            ['category' => 'Verdura a Foglia',  'name' => 'Insalata',           'unit' => 'g',      'content' => 300],
            ['category' => 'Pomodori',          'name' => 'Pomodori',           'unit' => 'g',      'content' => 500],
            ['category' => 'Cipolle',           'name' => 'Cipolle',            'unit' => 'g',      'content' => 500],
            ['category' => 'Aglio',             'name' => 'Aglio',              'unit' => 'pz',     'content' => 1],
            ['category' => 'Patate',            'name' => 'Patate',             'unit' => 'kg',     'content' => 1],
            ['category' => 'Tuberi',            'name' => 'Rape',               'unit' => 'g',      'content' => 500],
            ['category' => 'Zucchine',          'name' => 'Zucchine',           'unit' => 'g',      'content' => 500],
            ['category' => 'Melanzane',         'name' => 'Melanzane',          'unit' => 'g',      'content' => 500],
            ['category' => 'Carote',            'name' => 'Carote',             'unit' => 'g',      'content' => 500],
            ['category' => 'Radici',            'name' => 'Sedano Rapa',        'unit' => 'g',      'content' => 500],

            // --- Frutta ---
            ['category' => 'Frutta Fresca',     'name' => 'Mele',               'unit' => 'kg',     'content' => 1],
            ['category' => 'Frutta Fresca',     'name' => 'Arance',             'unit' => 'kg',     'content' => 1],
            ['category' => 'Frutta Fresca',     'name' => 'Banane',             'unit' => 'kg',     'content' => 1],
            ['category' => 'Frutta Fresca',     'name' => 'Mandarini',          'unit' => 'kg',     'content' => 1],
            ['category' => 'Frutta Fresca',     'name' => 'Albicocche',         'unit' => 'kg',     'content' => 1],
            ['category' => 'Frutta Fresca',     'name' => 'Pesche',             'unit' => 'kg',     'content' => 1],
            ['category' => 'Frutta Secca',      'name' => 'Noci',               'unit' => 'g',      'content' => 200],

            // --- Legumi ---
            ['category' => 'Legumi Secchi',     'name' => 'Lenticchie Secche',  'unit' => 'g',      'content' => 500],
            ['category' => 'Legumi Secchi',     'name' => 'Fagioli borlotti',   'unit' => 'g',      'content' => 500],
            ['category' => 'Legumi Secchi',     'name' => 'Fagioli cannellini', 'unit' => 'g',      'content' => 500],
            ['category' => 'Legumi Secchi',     'name' => 'Ceci',               'unit' => 'g',      'content' => 500],
            ['category' => 'Legumi Secchi',     'name' => 'Piselli spezzati',   'unit' => 'g',      'content' => 500],
            ['category' => 'Legumi in Scatola', 'name' => 'Ceci in Scatola',    'unit' => 'g',      'content' => 400],

            // --- Conserve e Sughi ---
            ['category' => 'Pomodoro in Scatola','name' => 'Pomodori Pelati',   'unit' => 'g',      'content' => 400],
            ['category' => 'Sughi Pronti',      'name' => 'Sugo Pronto',        'unit' => 'g',      'content' => 350],
            ['category' => 'Verdure Sott\'olio','name' => 'Peperoni Sott\'olio','unit' => 'g',      'content' => 280],
            ['category' => 'Marmellate',        'name' => 'Marmellata',         'unit' => 'g',      'content' => 350],

            // --- Condimenti ---
            ['category' => 'Sale',              'name' => 'Sale',               'unit' => 'g',      'content' => 1000],
            ['category' => 'Pepe',              'name' => 'Pepe',               'unit' => 'g',      'content' => 50],

            // --- Spezie ed Erbe Aromatiche ---
            ['category' => 'Salvia',            'name' => 'Salvia',             'unit' => 'g',      'content' => 10],
            ['category' => 'Rosmarino',         'name' => 'Rosmarino',          'unit' => 'g',      'content' => 10],
            ['category' => 'Prezzemolo',        'name' => 'Prezzemolo',         'unit' => 'g',      'content' => 20],
            ['category' => 'Alloro',            'name' => 'Alloro',             'unit' => 'g',      'content' => 5],
            ['category' => 'Basilico',          'name' => 'Basilico',           'unit' => 'g',      'content' => 20],
            ['category' => 'Origano',           'name' => 'Origano',            'unit' => 'g',      'content' => 25],
            ['category' => 'Timo',              'name' => 'Timo',               'unit' => 'g',      'content' => 10],
            ['category' => 'Menta',             'name' => 'Menta',              'unit' => 'g',      'content' => 10],
            ['category' => 'Curcuma',           'name' => 'Curcuma',            'unit' => 'g',      'content' => 30],
            ['category' => 'Paprika',           'name' => 'Paprika',            'unit' => 'g',      'content' => 30],
            ['category' => 'Cannella',          'name' => 'Cannella',           'unit' => 'g',      'content' => 25],
            ['category' => 'Cumino',            'name' => 'Cumino',             'unit' => 'g',      'content' => 25],
            ['category' => 'Noce Moscata',      'name' => 'Noce Moscata',       'unit' => 'g',      'content' => 25],
            ['category' => 'Zafferano',         'name' => 'Zafferano',          'unit' => 'g',      'content' => 1],
            ['category' => 'Peperoncino',       'name' => 'Peperoncino',        'unit' => 'g',      'content' => 20],
            ['category' => 'Coriandolo',        'name' => 'Coriandolo',         'unit' => 'g',      'content' => 15],
            ['category' => 'Cardamomo',         'name' => 'Cardamomo',          'unit' => 'g',      'content' => 15],

            // --- Olio, Aceto e Salse ---
            ['category' => 'Olio d\'Oliva',     'name' => 'Olio d\'Oliva',      'unit' => 'ml',     'content' => 750],
            ['category' => 'Altri Oli',         'name' => 'Olio di Semi',       'unit' => 'ml',     'content' => 750],
            ['category' => 'Aceto',             'name' => 'Aceto',              'unit' => 'ml',     'content' => 500],
            ['category' => 'Salse e Ketchup',   'name' => 'Ketchup',            'unit' => 'g',      'content' => 300],

            // --- Dolci e Snack ---
            ['category' => 'Biscotti',          'name' => 'Biscotti',           'unit' => 'g',      'content' => 300],
            ['category' => 'Cioccolato',        'name' => 'Cioccolato',         'unit' => 'g',      'content' => 100],
            ['category' => 'Merendine',         'name' => 'Merendine',          'unit' => 'pz',     'content' => 6],
            ['category' => 'Zucchero e Dolcificanti', 'name' => 'Zucchero',     'unit' => 'g',      'content' => 1000],

            // --- Bevande ---
            ['category' => 'Acqua',             'name' => 'Acqua',              'unit' => 'l',      'content' => 1.5],
            ['category' => 'Succhi',            'name' => 'Succo di Frutta',    'unit' => 'ml',     'content' => 200],
            ['category' => 'Nettari',           'name' => 'Nettare di Pesca',   'unit' => 'ml',     'content' => 200],
            ['category' => 'Bibite',            'name' => 'Bibita',             'unit' => 'ml',     'content' => 330],
            ['category' => 'Caffè',             'name' => 'Caffè',              'unit' => 'g',      'content' => 250],
            ['category' => 'Tè',                'name' => 'Tè',                 'unit' => 'g',      'content' => 50],
            ['category' => 'Vino',              'name' => 'Vino',               'unit' => 'l',      'content' => 0.75],
            ['category' => 'Birra',             'name' => 'Birra',              'unit' => 'ml',     'content' => 330],

            // --- Surgelati ---
            ['category' => 'Verdure Surgelate', 'name' => 'Spinaci Surgelati',  'unit' => 'g',      'content' => 600],
            ['category' => 'Verdure Surgelate', 'name' => 'Contorni Surgelati', 'unit' => 'g',      'content' => 600],
            ['category' => 'Pesce Surgelato',   'name' => 'Bastoncini di Pesce','unit' => 'g',      'content' => 400],
            ['category' => 'Piatti Pronti Surgelati', 'name' => 'Pizza Surgelata', 'unit' => 'pz',  'content' => 1],

            // --- Pulizia Casa ---
            ['category' => 'Detersivi Piatti',      'name' => 'Detersivo Piatti',   'unit' => 'ml', 'content' => 500],
            ['category' => 'Detersivi Lavatrice',   'name' => 'Detersivo Lavatrice','unit' => 'ml', 'content' => 1000],
            ['category' => 'Detergenti Superfici',   'name' => 'Spray Multiuso',     'unit' => 'ml', 'content' => 500],

            // --- Igiene Personale ---
            ['category' => 'Shampoo',               'name' => 'Shampoo',            'unit' => 'ml', 'content' => 250],
            ['category' => 'Balsamo',               'name' => 'Balsamo',            'unit' => 'ml', 'content' => 250],
            ['category' => 'Sapone e Doccia',       'name' => 'Bagnoschiuma',       'unit' => 'ml', 'content' => 250],
            ['category' => 'Dentifricio e Spazzolino', 'name' => 'Dentifricio',     'unit' => 'g',  'content' => 75],
            ['category' => 'Carta Igienica',        'name' => 'Carta Igienica',     'unit' => 'pz', 'content' => 8],
        ];

        foreach ($products as $p) {
            DB::table('products')->insert([
                'category_id'    => $cat($p['category']),
                'name'           => $p['name'],
                'base_unit_id'   => $unit($p['unit']),
                'content_value'  => $p['content'],
                'brand'          => null,
                'ean'            => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
