<?php

namespace Database\Seeders;

use App\Models\SubFamilia;
use Illuminate\Database\Seeder;

class SubFamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubFamilia::create([
            'nombre_sub_familia' => 'Yogurt Griego',
            'familia_id' => 1,
            'estado' => 1,
        ]);

        SubFamilia::create([
            'nombre_sub_familia' => 'Yogurt Italiano',
            'familia_id' => 1,
            'estado' => 1,
        ]);

        SubFamilia::create([
            'nombre_sub_familia' => 'Leche Deslactosada',
            'familia_id' => 2,
            'estado' => 1,
        ]);

    }
}
