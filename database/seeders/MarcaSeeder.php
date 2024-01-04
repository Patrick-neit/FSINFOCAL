<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marca::create([
            'nombre_marca' => 'ACME',
            'estado' => 1
        ]);

        Marca::create([
            'nombre_marca' => 'DIGICORP',
            'estado' => 1
        ]);
    }
}
