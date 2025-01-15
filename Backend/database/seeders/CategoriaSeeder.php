<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        Categoria::create(['nome' => 'Categoria 1']);
        Categoria::create(['nome' => 'Categoria 2']);
    }
}
