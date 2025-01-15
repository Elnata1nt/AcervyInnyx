<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategoriaSeeder;
use Database\Seeders\ProdutoSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategoriaSeeder::class,
            ProdutoSeeder::class,
        ]);
    }
}
