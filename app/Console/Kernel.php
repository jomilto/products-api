<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\{SendEmailVerificationReminderCommand,SendNewsletterCommand};

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendEmailVerificationReminderCommand::class,
        SendNewsletterCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
        ->evenInMaintenanceMode()
        ->sendOutputTo(storage_path('logs\inspire.log'))
        ->everyMinute();

        $schedule->call(function(){
            echo 'Hola';
        })->everyFiveMinutes();

        // evita superposicion de tareas, solo una a la vez
        // ->withoutOverlapping()
        $schedule->command(SendNewsletterCommand::class)
        ->withoutOverlapping()
        ->onOneServer()
        ->mondays();

        $schedule->command(SendEmailVerificationReminderCommand::class)
        ->withoutOverlapping()
        ->onOneServer()
        ->daily();
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
