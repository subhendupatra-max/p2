<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
 use App\Console\Commands\NotificationClearCron;
  use App\Console\Commands\ArchivedCron;
  use DateTimeZone;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        NotificationClearCron::class,
        ArchivedCron::class,
    ];

    protected function scheduleTimezone(): DateTimeZone|string|null
    {
        return config('app.cron_timezone');
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notification-clear:cron')->dailyAt('01:00');
        $schedule->command('archived:cron')->dailyAt('01:00');
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }

}
