<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVTargetRkapPerbulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_target_rkap_perbulan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_data')->nullable();
            $table->string('tahun')->nullable();
            $table->string('bulan')->nullable();
            $table->string('target_rkap')->nullable();
            $table->string('satuan')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('v_target_rkap_perbulan');
    }
}
