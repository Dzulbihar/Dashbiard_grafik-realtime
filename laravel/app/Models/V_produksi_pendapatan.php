<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_produksi_pendapatan extends Model
{
    use HasFactory;

    protected $table = 'v_produksi_pendapatan';
    protected $fillable = [
        'lokasi', 'tahun', 'bulan', 'shipcall', 'gt', 'jml_box_import', 'jml_box_export', 'jml_teus_import', 'jml_teus_export', 'total_pendapatan','tahun_departure', 'bulan_departure', 'jml_box_tahun_ini', 'jml_box_tahun_lalu'
    ];     
}
