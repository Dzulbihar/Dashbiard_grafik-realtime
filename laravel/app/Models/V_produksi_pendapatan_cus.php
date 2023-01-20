<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_produksi_pendapatan_cus extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'lokasi', 'nama_agent', 'agent', 'tahun', 'bulan', 'shipcall', 'gt', 'jml_box_import_20', 'jml_box_import_40','jml_box_import_45','jml_box_import','jml_box_export_20','jml_box_export_40','jml_box_export_45','jml_box_export', 'jml_teus_import', 'jml_teus_export', 'total_pendapatan','tahun_departure', 'bulan_departure','tanggal',
    ];

    const STATUS_COLOR = [
        '0'  => '#50B432',
        '1'  => '#ED561B',
        '2'   => '#DDDF00',
        '3' => '#24CBE5',
        '4'  => '#64E572',
        '5'   => '#FF9655',
        '6' => '#FFF263',
        '7'  => '#6AF9C4',
        '8'   => '#5e6063',
        '9' => '#112c80',
    ];

}