<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $admin->assignRole('admin');


        $seller = User::create([
            'name' => 'Demo Seller',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'status' => 'active',
        ]);

        $seller->assignRole('seller');


        $customer = User::create([
            'name' => 'Test Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'status' => 'active',
        ]);

        $customer->assignRole('customer');
    }
}
