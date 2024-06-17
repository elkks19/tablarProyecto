<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'superAdmin']);

        $userRole = Role::create(['name' => 'usuario']);
        $personalRole = Role::create(['name' => 'personal']);

        Permission::create(['name' => 'productos.*']);
        Permission::create(['name' => 'categorias.create']);

        Permission::create(['name' => 'envios.*']);
        Permission::create(['name' => 'envios.create']);
        Permission::create(['name' => 'envios.show']);

        Permission::create(['name' => 'reviews.*']);
        Permission::create(['name' => 'ordenes.*']);

        Permission::create(['name' => 'pagos.*']);
        Permission::create(['name' => 'pagos.create']);
        Permission::create(['name' => 'pagos.show']);

        $userPermission = [];
        $personalPermission = [];

        $userPermission[] = [
            'productos.*',
            'ordenes.*',
            'reviews.*',
            'categorias.create',
            'pagos.create',
            'envios.create',
            'pagos.show',
            'envios.show',

        ];

        $personalPermission[] = [
            'categorias.create',
            'productos.*',
            'envios.*',
            'ordenes.*',
            'reviews.*',
            'pagos.*',
        ];

        $userRole->syncPermissions($userPermission);
        $personalRole->syncPermissions($personalPermission);
    }
}
