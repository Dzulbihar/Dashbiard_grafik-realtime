<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_menu extends Model
{
    use HasFactory;

    protected $table = 'v_menu';
    protected $fillable = [
        'id',
        'menu_label',
        'menu_url',
        'menu_parent',
        'menu_seq',
        'menu_icon',
        'alt_url',
        'sub_menu',
        'role_id'
    ];    
}
