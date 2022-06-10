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
        'App\Console\Commands\SWCommand',
        'App\Console\Commands\OpenTerm',
        'App\Console\Commands\CloseTerm',
        'App\Console\Commands\OpenTerm2',
        'App\Console\Commands\CloseTerm2',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('minute:study_warning')->dailyAt('7:00');
        // $schedule->command('year:open_term')->yearlyOn(8, 1, '0:00');
        // $schedule->command('year:close_term')->yearlyOn(8, 10, '0:00');
        $schedule->command('year:open_term2')->yearlyOn(2, 1, '0:00');
        $schedule->command('year:close_term2')->yearlyOn(2, 10, '0:00');


        // everyMinute()
        // everyFiveMinutes()
        // everyTenMinutes()
        // everyFifteenMinutes()
        // everyThirtyMinutes()
        // hourly()
        // hourlyAt(17)
        // daily()
        // dailyAt('13:00')
        // twiceDaily(1, 13)
        // weekly()
        // weeklyOn(1, '8:00')   Monday at 8:00
        // monthly()
        // monthlyOn(4, '15:00')    4th at 15:00
        // quarterly()
        // yearly()
        // yearlyOn(6, 1, '17:00')
        // dailyAt('07:00')
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
