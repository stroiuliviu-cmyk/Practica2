<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategoriiSeeder::class,
            ProduseSeeder::class,
            GalerieSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
