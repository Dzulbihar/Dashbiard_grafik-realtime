<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel_performance extends Model
{
    use HasFactory;

    protected $table = 'v_vessel_performance';
    protected $fillable = [
        'id', 'ves_id', 'che_id', 'et', 'et_net', 'bshgross', 'bshnet', 'bsh', 'bsh_gross', 'bsh_net', 'bch', 'bch_gross', 'bch_net', 'box','teus','ovd','shift','work_ts','from_ts','to_ts','bulan','tahun'
    ];   
}
