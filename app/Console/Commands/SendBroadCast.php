<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Notifications\Notification;
use App\User;
// use App\Prospek;
use Faker\Factory;
use Carbon\Carbon;
use App\MasterNotifikasi;

class SendBroadCast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendnotify:broadcast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Broadcast successfully sent to all agents!';

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
         
    }
}
