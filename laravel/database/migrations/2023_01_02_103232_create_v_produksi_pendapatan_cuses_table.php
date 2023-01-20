<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVProduksiPendapatanCusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_produksi_pendapatan_cuses', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi')->nullable();
            $table->string('nama_agent')->nullable();
            $table->string('agent')->nullable();
            $table->string('tahun')->nullable();
            $table->string('bulan')->nullable();
            $table->string('shipcall')->nullable();
            $table->string('gt')->nullable();
            $table->string('jml_box_import_20')->nullable();
            $table->string('jml_box_import_40')->nullable();
            $table->string('jml_box_import_45')->nullable();
            $table->string('jml_box_import')->nullable();
            $table->string('jml_box_export_20')->nullable();
            $table->string('jml_box_export_40')->nullable();
            $table->string('jml_box_export_45')->nullable();
            $table->string('jml_box_export')->nullable();
            $table->string('jml_teus_import')->nullable();
            $table->string('jml_teus_export')->nullable();
            $table->string('total_pendapatan')->nullable();
            $table->string('tahul_departure')->nullable();
            $table->string('bulan_departure')->nullable();
            $table->date('tanggal')->nullable();
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
        Schema::dropIfExists('v_produksi_pendapatan_cuses');
    }
}
