<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Parser\Console\Parse;

class Kernel extends ConsoleKernel
{



    protected function scheduleTimezone()
    {
        return '2';
    }

    protected $commands =
        [
//            Testsss::class,
            Parse::class,
        ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
//         $schedule->command('file:write')->hourly();
//         $schedule->command('parse:site')->everyMinute();
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
