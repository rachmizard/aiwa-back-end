<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_jadwals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jadwal_id');
            $table->string('jenis');
            $table->string('harga_double');
            $table->string('harga_triple');
            $table->string('harga_quard');
            $table->string('hotel_madinah');
            $table->string('hotel_mekah');
            $table->string('manasik_tanggal');
            $table->string('waktu');
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
        Schema::dropIfExists('detail__jadwals');
    }
}
