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
        Role::create([
            'name' => 'Administrador',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Gerencia',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Jefe Sucursal',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Cajero',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Contabilidad',
            'guard_name' => 'web',
        ]);
    }
}
