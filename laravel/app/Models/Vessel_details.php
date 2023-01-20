<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel_details extends Model
{
    use HasFactory;

    protected $table = 'v_vessel_details';
    protected $fillable = [
        'id', 'ves_id', 'agent', 'shipper', 'ocean_interisland', 'ves_name', 'in_voyage', 'out_voyage', 'ves_service', 'berth_fr_metre', 'berth_to_metre', 'discharge', 'load', 'est_berth_ts','act_berth_ts','est_start_work_ts','act_start_work_ts','est_end_work_ts','act_end_work_ts','est_dep_ts','act_dep_ts'
    ];     
}
