<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_target_rkap_perbulan extends Model
{
    use HasFactory;

    protected $table = 'v_target_rkap_perbulan';
    protected $fillable = [
        'tahun', 'bulan', 'target_rkap', 'satuan', 'type',
    ];    
}
