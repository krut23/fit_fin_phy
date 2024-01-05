<?php

namespace App\Console;

use App\Console\Commands\InActive;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\ExpirePhoneBookUsers;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [

        ExpirePhoneBookUsers::class,    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('UserController@expiredDate')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
