<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Notifications\Notification;
use App\User;
use Faker\Factory;
use Carbon\Carbon;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendnotify:followup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Follow up for each date';

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
        $faker = Factory::create();
        DB::table('users')->insert([ //,
                'nama' => $faker->name,
                'no_ktp' => rand(0,100),
                'jenis_kelamin' => 'L',
                'alamat' => $faker->address,
                'no_telp' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'username' => $faker->username,
                'password' => bcrypt('baguvix'),
                'status' => '0',
                'koordinator' => $faker->name,
                'bank' => $faker->name,
                'no_rekening' => $faker->phoneNumber,
                'fee_reguler' => $faker->phoneNumber,
                'fee_promo' => $faker->phoneNumber,
                'nama_rek_beda' => $faker->phoneNumber,
                'website' => $faker->name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }
}
