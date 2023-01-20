<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Route;

class DataModel extends Model
{
    use HasFactory;

    

    public function getmenu(){
        $role = Auth::user()->id;
        //dd($role);
        //and role_id='."$role".'
        $Routname=Route::currentRouteName();

        //dd($Routname);

        $menu=DB::select("select * from DASHBOARDGRAFIK.v_menu where sub_menu=0 and role_id=".$role." order by id");
        $submenu=DB::select("select * from DASHBOARDGRAFIK.v_menu where sub_menu=1 and role_id=".$role." order by id");
        $sub2menu=DB::select("select * from DASHBOARDGRAFIK.v_menu where sub_menu=2 and role_id=".$role." order by id");

        $menuid=DB::select("select * from DASHBOARDGRAFIK.v_menu where sub_menu=0 and menu_url = ?", [$Routname]);
        $subid=DB::select("select * from DASHBOARDGRAFIK.v_menu where sub_menu=1 and menu_url = ?", [$Routname]);
        

        return ['menu'=>$menu,'submenu'=>$submenu,'sub2menu'=>$sub2menu,'menuid'=>$menuid,'subid'=>$subid];
    }

}
