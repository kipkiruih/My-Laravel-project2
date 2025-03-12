<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    public function run()
    {
        $tenants = User::where('role', 'tenant')->get();

        foreach ($tenants as $user) {
            Tenant::firstOrCreate(['user_id' => $user->id], [
                'national_id' => '12345678',
                'address' => 'Nairobi, Kenya',
            ]);
        }
    }
}

