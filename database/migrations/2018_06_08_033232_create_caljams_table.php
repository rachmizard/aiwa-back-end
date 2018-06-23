<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaljamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caljams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anggota_id');
            $table->integer('jadwal_id');
            $table->string('pic');
            $table->bigInteger('no_telp');
            $table->integer('jml_caljam');
            $table->integer('jml_infant');
            $table->integer('jml_balita');
            $table->string('kamar');
            $table->string('passport');
            $table->string('meningitis');
            $table->string('foto');
            $table->string('buku_nikah');
            $table->string('fc_akta');
            $table->string('visa');
            $table->string('diskon');
            $table->string('tanggal_followup');
            $table->string('keterangan');
            $table->string('pembayaran');
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
        Schema::dropIfExists('caljams');
    }
}
