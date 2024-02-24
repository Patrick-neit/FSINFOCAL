<?php

namespace Database\Seeders;

use App\Models\Familia;
use Illuminate\Database\Seeder;

class FamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Familia::create([
            'nombre_familia' => 'Yogurt',
            'estado' => 1,
        ]);

        Familia::create([
            'nombre_familia' => 'Leches',
            'estado' => 1,
        ]);
    }
}
