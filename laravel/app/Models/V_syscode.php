<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_syscode extends Model
{
    use HasFactory;

    protected $table = 'v_syscode';
    protected $fillable = [
        'kode', 'value_char', 'value_number', 'ket_char', 'ket_number',
    ];    
}
