<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UnitsSeeder::class,
            CategoriesSeeder::class,
            SupermarketLayoutsSeeder::class, // dipende da CategoriesSeeder
            ProductsSeeder::class,           // dipende da CategoriesSeeder e UnitsSeeder
        ]);
    }
}
