<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre_categoria' => 'LATAS',
            'estado' => 1
        ]);

        Categoria::create([
            'nombre_categoria' => 'BOLSAS',
            'estado' => 1
        ]);
    }
}
