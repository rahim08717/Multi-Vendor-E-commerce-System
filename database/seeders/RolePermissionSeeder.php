<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $sellerRole = Role::firstOrCreate(['name' => 'seller']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'create product']);
        Permission::firstOrCreate(['name' => 'place order']);
        Permission::firstOrCreate(['name' => 'edit product']);
        Permission::firstOrCreate(['name' => 'delete product']);


        $adminRole->givePermissionTo(Permission::all());

        $sellerRole->givePermissionTo('create product');

        $users = User::all();

        foreach ($users as $user) {
            if ($user->role == 'admin') {
                $user->assignRole($adminRole);
            } elseif ($user->role == 'seller') {
                $user->assignRole($sellerRole);
            } elseif ($user->role == 'customer') {
                $user->assignRole($customerRole);
            }
        }
    }
}
