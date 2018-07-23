<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospeks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anggota_id');
            $table->string('pic');
            $table->bigInteger('no_telp');
            $table->integer('jml_dewasa');
            $table->integer('jml_infant');
            $table->integer('jml_balita');
            $table->string('tgl_keberangkatan');
            $table->string('jenis');
            $table->string('double');
            $table->string('triple');
            $table->string('quard');
            $table->boolean('passport');
            $table->boolean('meningitis');
            $table->boolean('pas_foto');
            $table->boolean('buku_nikah');
            $table->boolean('fc_akta');
            $table->boolean('visa_progresif');
            $table->string('diskon');
            $table->string('keterangan');
            $table->string('tanggal_followup');
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
        Schema::dropIfExists('prospeks');
    }
}
