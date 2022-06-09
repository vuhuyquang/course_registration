<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\SWCommand'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('minute:study_warning')->everyMinute();
        $schedule->command('minute:study_warning')->yearlyOn(1, 1, '7:00');
        $schedule->command('minute:study_warning')->yearlyOn(8, 1, '7:00');


        // hourly();
        // daily();
        // weekly();
        // monthly();
        // quarterly();
        // yearly();
        // yearlyOn(6, 1, '17:00');
        // dailyAt('07:00');
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
