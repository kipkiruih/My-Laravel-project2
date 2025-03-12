<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $notifications = [
            [
                'id' => Str::uuid(),
                'type' => 'App\Notifications\RentalApplicationUpdate',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => 1, // Replace with an actual tenant ID
                'data' => json_encode([
                    'message' => 'Your rental application for <b>2-Bedroom Apartment</b> was approved',
                    'icon' => 'fas fa-check text-success'
                ]),
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'type' => 'App\Notifications\RentPaymentReminder',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => 1,
                'data' => json_encode([
                    'message' => 'Payment of <b>KES 15,000</b> received for <b>Luxury Apartment</b>',
                    'icon' => 'fas fa-wallet text-warning'
                ]),
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'type' => 'App\Notifications\RentPaymentReminder',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => 1,
                'data' => json_encode([
                    'message' => 'Rent due for <b>Studio Apartment</b> in 5 days',
                    'icon' => 'fas fa-exclamation-triangle text-danger'
                ]),
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'type' => 'App\Notifications\TenantReviewNotification',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => 1,
                'data' => json_encode([
                    'message' => 'Your review was posted for <b>Urban Suites</b>',
                    'icon' => 'fas fa-star text-primary'
                ]),
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table('notifications')->insert($notifications);
    }
}

