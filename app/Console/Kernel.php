<?php

// FORMAT FOR CRON JOBS
// /usr/local/bin/php -q /home/u2853205/public_html/aiwaapps/artisan schedule:run 1>> /dev/null 2>&1


namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Reminder;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        \App\Console\Commands\SendNotification::class,
        \App\Console\Commands\SendBerangkat::class,
        \App\Console\Commands\SendPulang::class,
        \App\Console\Commands\SyncData::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('sendnotify:followup')
        //          ->everyMinute();
        $reminders = \App\Reminder::find(1);

        $schedule->command('sendnotify:followup')
                 ->cron($reminders->cron_followup);
        $schedule->command('sendnotify:berangkat')
                 ->cron($reminders->cron_jamaah_berangkat);
        $schedule->command('sendnotify:pulang')
                 ->cron($reminders->cron_jamaah_pulang);
        $schedule->command('sync:pendaftaran')
                 ->cron($reminders->cron_sinkronisasi);
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
