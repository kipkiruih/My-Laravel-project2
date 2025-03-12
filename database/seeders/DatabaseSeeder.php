<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '0712345678',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
    
        User::create([
            'name' => 'Property Owner',
            'email' => 'owner@example.com',
            'phone' => '0798765432',
            'role' => 'owner',
            'password' => Hash::make('password'),
        ]);
    
        User::create([
            'name' => 'Tenant User',
            'email' => 'tenant@example.com',
            'phone' => '0787654321',
            'role' => 'tenant',
            'password' => Hash::make('password'),
        ]);
    }
}
