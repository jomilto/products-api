<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Notifications\NewsletterNotification;

class SendNewsletterCommand extends Command
{

    protected $signature = 'send:newsletter 
                            {emails?*} : Correos a los cuales se enviara notificación
                            {--s|schedule : Si debe ser ejecutado directamente o no}';

    protected $description = 'Command to send newsletter';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $emails = $this->argument('emails');

        $builder = User::query();

        if($emails){
            $builder->whereIn('email',$emails);
        }

        $count = $builder->count();

        if($count){

            $this->info("Se enviaran {$count} correos");

            if ($this->confirm('¿Estas de acuerdo?') || $schedule) {
                $this->output->progressStart($count);

                $builder
                ->whereNotNull('email_verifired_at')
                ->each(function(User $user){
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });
                $this->output->progressFinish();
                $this->info("Se enviaron {$count} correos");
                return;
            }
        } 
        $this->info('No se envío ningun correo');
    }
}
