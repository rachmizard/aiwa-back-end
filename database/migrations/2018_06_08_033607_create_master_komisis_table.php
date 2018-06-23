<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterKomisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_komisis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('total_komisi_reguler');
            $table->string('komisi_reguler_1');
            $table->string('komisi_reguler_2');
            $table->string('komisi_reguler_3');
            $table->string('total_komisi_promo');
            $table->string('komisi_promo_1');
            $table->string('komisi_promo_2');
            $table->string('komisi_promo_3');
            $table->string('total_komisi_haji');
            $table->string('komisi_haji_1');
            $table->string('komisi_haji_2');
            $table->string('komisi_haji_3');
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
        Schema::dropIfExists('master_komisis');
    }
}
