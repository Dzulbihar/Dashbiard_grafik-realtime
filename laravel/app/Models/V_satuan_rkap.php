<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_satuan_rkap extends Model
{
    use HasFactory;

    protected $table = 'v_satuan_rkap';
    protected $fillable = [
        'satuan',
    ];    
}
