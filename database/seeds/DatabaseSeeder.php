<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        $this->call(UsersTableSeeder::class);
=======
        // $this->call(UsersTableSeeder::class);
        $this->call(KendaraansTableSeeder::class); // tambahkan line ini
>>>>>>> e3c53ca94bddd941fd9034dc0e929c1f7dcaca29
    }
}
