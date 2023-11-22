<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Patrick Aguilar',
            'apellidos' => 'Aguilar Nuñez',
            'departamento_id' => 1,
            'fecha_nacimiento' => '1999-01-01',
            'ci' => '123456',
            'email' => 'patrickaguilar2403@gmail.com',
            'fotografia' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
            'password' => bcrypt('123456'),
        ])->assignRole('Administrador');
        User::create([
            'name' => 'Angel Espinoza',
            'apellidos' => 'Ibañez',
            'departamento_id' => 1,
            'fecha_nacimiento' => '1999-01-01',
            'ci' => '123456',
            'email' => 'angel_nayib.07@gmail.com',
            'fotografia' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
            'password' => Hash::make('123456'),
        ])->assignRole('Administrador');
    }
}
