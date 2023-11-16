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
            'email' => 'patrickaguilar2403@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        User::create([
            'name' => 'Angel Espinoza',
            'email' => 'angel_nayib.07@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
