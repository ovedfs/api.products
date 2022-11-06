<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $user = Role::create(['name' => 'user']);
        $admin = Role::create(['name' => 'admin']);
        $superadmin = Role::create(['name' => 'superadmin']);

        Permission::create(['name' => 'products.index'])->syncRoles([$user, $admin, $superadmin]);
        Permission::create(['name' => 'products.store'])->syncRoles([$admin, $superadmin]);
        Permission::create(['name' => 'products.show'])->syncRoles([$user, $admin, $superadmin]);
        Permission::create(['name' => 'products.update'])->syncRoles([$admin, $superadmin]);
        Permission::create(['name' => 'products.destroy'])->syncRoles([$superadmin]);
    }
}
