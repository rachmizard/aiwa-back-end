<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanJamaahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_jamaah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_umrah');
            $table->string('id_jamaah');
            $table->date('tgl_daftar');
            $table->date('tgl_berangkat');
            $table->date('tgl_pulang');
            $table->string('maskapai');
            $table->string('marketing');
            $table->string('staff');
            $table->string('no_telp');
            $table->string('fee');
            $table->enum('jumlah_bayar_fee', ['Ya', 'Tidak']);
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
        Schema::dropIfExists('laporan_jamaah');
    }
}

