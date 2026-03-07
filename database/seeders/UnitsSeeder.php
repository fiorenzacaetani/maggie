<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('units')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $units = [
            // Peso
            ['name' => 'Grammi',     'symbol' => 'g'],
            ['name' => 'Etti',       'symbol' => 'hg'],
            ['name' => 'Chili',      'symbol' => 'kg'],

            // Volume
            ['name' => 'Millilitri', 'symbol' => 'ml'],
            ['name' => 'Centilitri', 'symbol' => 'cl'],
            ['name' => 'Litri',      'symbol' => 'l'],

            // Conteggio
            ['name' => 'Pezzi',      'symbol' => 'pz'],
            ['name' => 'Confezione', 'symbol' => 'conf'],
            ['name' => 'Fette',      'symbol' => 'fette'],
            ['name' => 'Mazzo',      'symbol' => 'mazzo'],

            // Misure cucina
            ['name' => 'Cucchiai',   'symbol' => 'cucch'],
            ['name' => 'Cucchiaini', 'symbol' => 'cucch.ni'],
            ['name' => 'Tazze',      'symbol' => 'tazze'],
            ['name' => 'Pizzico',    'symbol' => 'pizzico'],
            ['name' => 'Spicchi',    'symbol' => 'spicchi'],
            ['name' => 'Foglie',     'symbol' => 'foglie'],
        ];

        DB::table('units')->insertOrIgnore($units);
    }
}
