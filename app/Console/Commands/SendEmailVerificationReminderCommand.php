<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;

class SendEmailVerificationReminderCommand extends Command
{

    protected $signature = 'send:reminder';

    protected $description = 'Send an email to all the users with no Verificated Email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        User::query()
        ->whereDate('created_at','=',Carbon::now()->subDays(7)->format('Y-m-d'))
        ->whereNull('email_verificated_at')
        ->each(function(User $user){
            $user->sendEmailVerificationNotification();
        });
    }
}
