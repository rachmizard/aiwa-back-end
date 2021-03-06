<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJamaahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jamaah', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_umrah');
            $table->string('id_jamaah');
            $table->date('tgl_daftar');
            $table->string('nama');
            $table->date('tgl_berangkat');
            $table->date('tgl_pulang');
            $table->string('maskapai');
            $table->string('marketing');
            $table->string('staff');
            $table->bigInteger('no_telp');
            $table->string('fee');
            $table->enum('jumlah_fee', ['Ya', 'Tidak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jamaah');
    }
}
