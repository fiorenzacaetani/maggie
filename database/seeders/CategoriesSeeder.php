<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        // Svuota la tabella rispettando le FK self-referenziali
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Categorie padre (parent_id = null)
        $parents = [
            'Pasta e Riso',
            'Pane e Prodotti da Forno',
            'Latticini e Uova',
            'Carne',
            'Pesce e Frutti di Mare',
            'Salumi e Affettati',
            'Verdura',
            'Frutta',
            'Legumi',
            'Conserve e Sughi',
            'Condimenti',
            'Spezie ed Erbe Aromatiche',
            'Olio, Aceto e Salse',
            'Dolci e Snack',
            'Bevande',
            'Surgelati',
            'Pulizia Casa',
            'Igiene Personale',
        ];

        foreach ($parents as $name) {
            DB::table('categories')->insert(['parent_id' => null, 'name' => $name]);
        }

        // Helper per recuperare l'id di una categoria padre per nome
        $id = fn(string $name) => DB::table('categories')->where('name', $name)->value('id');

        // Sottocategorie
        $children = [
            // Pasta e Riso
            ['parent' => 'Pasta e Riso',            'name' => 'Pasta Secca'],
            ['parent' => 'Pasta e Riso',            'name' => 'Pasta Fresca'],
            ['parent' => 'Pasta e Riso',            'name' => 'Riso'],
            ['parent' => 'Pasta e Riso',            'name' => 'Cereali e Farro'],

            // Pane e Prodotti da Forno
            ['parent' => 'Pane e Prodotti da Forno', 'name' => 'Pane'],
            ['parent' => 'Pane e Prodotti da Forno', 'name' => 'Grissini'],
            ['parent' => 'Pane e Prodotti da Forno', 'name' => 'Crackers'],
            ['parent' => 'Pane e Prodotti da Forno', 'name' => 'Farine'],
            ['parent' => 'Pane e Prodotti da Forno', 'name' => 'Lievito'],

            // Latticini e Uova
            ['parent' => 'Latticini e Uova',        'name' => 'Latte'],
            ['parent' => 'Latticini e Uova',        'name' => 'Formaggi Freschi'],
            ['parent' => 'Latticini e Uova',        'name' => 'Formaggi Stagionati'],
            ['parent' => 'Latticini e Uova',        'name' => 'Yogurt'],
            ['parent' => 'Latticini e Uova',        'name' => 'Burro'],
            ['parent' => 'Latticini e Uova',        'name' => 'Panna'],
            ['parent' => 'Latticini e Uova',        'name' => 'Uova'],

            // Carne
            ['parent' => 'Carne',                   'name' => 'Carne Bovina'],
            ['parent' => 'Carne',                   'name' => 'Carne Suina'],
            ['parent' => 'Carne',                   'name' => 'Pollame'],
            ['parent' => 'Carne',                   'name' => 'Carne Macinata'],

            // Pesce
            ['parent' => 'Pesce e Frutti di Mare',  'name' => 'Pesce Fresco'],
            ['parent' => 'Pesce e Frutti di Mare',  'name' => 'Pesce in Scatola'],
            ['parent' => 'Pesce e Frutti di Mare',  'name' => 'Frutti di Mare'],

            // Salumi
            ['parent' => 'Salumi e Affettati',      'name' => 'Prosciutto'],
            ['parent' => 'Salumi e Affettati',      'name' => 'Salame'],
            ['parent' => 'Salumi e Affettati',      'name' => 'Insaccati'],
            ['parent' => 'Salumi e Affettati',      'name' => 'Wurstel'],

            // Verdura
            ['parent' => 'Verdura',                   'name' => 'Verdura a Foglia'],
            ['parent' => 'Verdura',                   'name' => 'Pomodori'],
            ['parent' => 'Verdura',                   'name' => 'Cipolle'],
            ['parent' => 'Verdura',                   'name' => 'Aglio'],
            ['parent' => 'Verdura',                   'name' => 'Patate'],
            ['parent' => 'Verdura',                   'name' => 'Tuberi'],
            ['parent' => 'Verdura',                   'name' => 'Zucchine'],
            ['parent' => 'Verdura',                   'name' => 'Melanzane'],
            ['parent' => 'Verdura',                   'name' => 'Carote'],
            ['parent' => 'Verdura',                   'name' => 'Radici'],

            // Frutta
            ['parent' => 'Frutta',                  'name' => 'Frutta Fresca'],
            ['parent' => 'Frutta',                  'name' => 'Frutta Secca'],

            // Legumi
            ['parent' => 'Legumi',                  'name' => 'Legumi Secchi'],
            ['parent' => 'Legumi',                  'name' => 'Legumi in Scatola'],

            // Conserve
            ['parent' => 'Conserve e Sughi',        'name' => 'Pomodoro in Scatola'],
            ['parent' => 'Conserve e Sughi',        'name' => 'Sughi Pronti'],
            ['parent' => 'Conserve e Sughi',        'name' => 'Verdure Sott\'olio'],
            ['parent' => 'Conserve e Sughi',        'name' => 'Marmellate'],

            // Condimenti
            ['parent' => 'Condimenti',              'name' => 'Sale'],
            ['parent' => 'Condimenti',              'name' => 'Pepe'],

            // Spezie ed Erbe Aromatiche
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Salvia'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Rosmarino'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Prezzemolo'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Alloro'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Basilico'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Origano'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Timo'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Menta'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Curcuma'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Paprika'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Cannella'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Cumino'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Noce Moscata'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Zafferano'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Peperoncino'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Coriandolo'],
            ['parent' => 'Spezie ed Erbe Aromatiche', 'name' => 'Cardamomo'],

            // Olio e Salse
            ['parent' => 'Olio, Aceto e Salse',     'name' => 'Olio d\'Oliva'],
            ['parent' => 'Olio, Aceto e Salse',     'name' => 'Altri Oli'],
            ['parent' => 'Olio, Aceto e Salse',     'name' => 'Aceto'],
            ['parent' => 'Olio, Aceto e Salse',     'name' => 'Salse e Ketchup'],

            // Dolci e Snack
            ['parent' => 'Dolci e Snack',           'name' => 'Biscotti'],
            ['parent' => 'Dolci e Snack',           'name' => 'Cioccolato'],
            ['parent' => 'Dolci e Snack',           'name' => 'Merendine'],
            ['parent' => 'Dolci e Snack',           'name' => 'Zucchero e Dolcificanti'],

            // Bevande
            ['parent' => 'Bevande',                 'name' => 'Acqua'],
            ['parent' => 'Bevande',                 'name' => 'Succhi'],
            ['parent' => 'Bevande',                 'name' => 'Nettari'],
            ['parent' => 'Bevande',                 'name' => 'Bibite'],
            ['parent' => 'Bevande',                 'name' => 'Caffè'],
            ['parent' => 'Bevande',                 'name' => 'Tè'],
            ['parent' => 'Bevande',                 'name' => 'Vino'],
            ['parent' => 'Bevande',                 'name' => 'Birra'],

            // Surgelati
            ['parent' => 'Surgelati',               'name' => 'Verdure Surgelate'],
            ['parent' => 'Surgelati',               'name' => 'Pesce Surgelato'],
            ['parent' => 'Surgelati',               'name' => 'Piatti Pronti Surgelati'],

            // Pulizia Casa
            ['parent' => 'Pulizia Casa',            'name' => 'Detersivi Piatti'],
            ['parent' => 'Pulizia Casa',            'name' => 'Detersivi Lavatrice'],
            ['parent' => 'Pulizia Casa',            'name' => 'Detergenti Superfici'],
            ['parent' => 'Pulizia Casa',            'name' => 'Carta e Sacchetti'],

            // Igiene Personale
            ['parent' => 'Igiene Personale',        'name' => 'Shampoo'],
            ['parent' => 'Igiene Personale',        'name' => 'Balsamo'],
            ['parent' => 'Igiene Personale',        'name' => 'Sapone e Doccia'],
            ['parent' => 'Igiene Personale',        'name' => 'Dentifricio e Spazzolino'],
            ['parent' => 'Igiene Personale',        'name' => 'Carta Igienica'],
        ];

        foreach ($children as $child) {
            DB::table('categories')->insert([
                'parent_id' => $id($child['parent']),
                'name'      => $child['name'],
            ]);
        }
    }
}
