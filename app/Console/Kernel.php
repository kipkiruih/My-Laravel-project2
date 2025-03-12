<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Notifications\RentPaymentReminder;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $tenants = User::where('role', 'tenant')->get();
        foreach ($tenants as $tenant) {
            $tenant->notify(new RentPaymentReminder());
        }
    })->monthlyOn(25, '09:00');
    $schedule->command('backup:run')->weekly();
}


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
}
