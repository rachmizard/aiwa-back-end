<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_jadwals', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_keberangkatan');
            $table->dateTime('waktu_keberangkatan');
            $table->string('pesawat_keberangkatan');
            $table->string('bandara_keberangkatan');
            $table->date('tanggal_kepulangan');
            $table->dateTime('waktu_kepulangan');
            $table->string('pesawat_kepulangan');
            $table->string('bandara_kepulangan');
            $table->string('maskapai');
            $table->string('paket');
            $table->integer('seat_total');
            $table->integer('seat_terpakai');
            $table->string('ready_mofa');
            $table->string('ready_visa');
            $table->string('status_promo');
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
        Schema::dropIfExists('master__jadwals');
    }
}
