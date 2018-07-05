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
            $table->integer('anggota_id');
            $table->string('nama');
            $table->string('alamat');
            $table->bigInteger('no_telp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('jml_dewasa');
            $table->integer('jml_balita');
            $table->integer('jml_infant');
            $table->bigInteger('pembayaran');
            $table->string('keterangan');
            $table->enum('status', ['DP', 'Lunas']);
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
