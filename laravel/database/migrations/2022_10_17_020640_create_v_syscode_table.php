<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVSyscodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_syscode', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('value_char')->nullable();
            $table->string('value_number')->nullable();
            $table->string('ket_char')->nullable();
            $table->string('ket_number')->nullable();
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
        Schema::dropIfExists('v_syscode');
    }
}
