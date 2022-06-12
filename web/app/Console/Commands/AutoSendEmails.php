<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Admin\Entities\AdminAutoEmail;
use Modules\Admin\Entities\AdminLogger;

class AutoSendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:sendemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $email = AdminAutoEmail::where ('time_sent', '<=', date('Y-m-d H:i:s'))
                              ->where ('status', '=', 1)
                              ->take(50)
                              -> get();
       foreach ($email as $email)
       {
            AdminAutoEmail::sendAndUpdateEmail($email->id, $email->subject, $email->content, $email->sent_to);
       }
       
    }
}
