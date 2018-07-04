<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Admin::insert(
          [
            'username'  => 'admin',
            'email' => 'admin@gmail.com',
            'password'          => bcrypt('admin123'),
            'login_at'          => \Carbon\Carbon::now('Asia/Jakarta'),
            'created_at'      => \Carbon\Carbon::now('Asia/Jakarta'),
            'updated_at'      => \Carbon\Carbon::now('Asia/Jakarta')
          ]);
    }
}
