<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name' => 'Administrador',
            'guard_name' => 'web',
        ]);
        Role::firstOrCreate([
            'name' => 'Gerencia',
            'guard_name' => 'web',
        ]);
        Role::firstOrCreate([
            'name' => 'Jefe Sucursal',
            'guard_name' => 'web',
        ]);
        Role::firstOrCreate([
            'name' => 'Cajero',
            'guard_name' => 'web',
        ]);
        Role::firstOrCreate([
            'name' => 'Contabilidad',
            'guard_name' => 'web',
        ]);
    }
}
