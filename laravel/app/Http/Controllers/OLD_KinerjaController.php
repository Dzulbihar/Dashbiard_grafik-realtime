<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vessel_details;
use App\Models\Vessel_performance;
use DB;
use App\Models\DataModel;

class OLD_KinerjaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vessel_detail ()
    {
        $title = "vessel_detail";
        $pilih_tahun =  DB::select("SELECT distinct to_char(ACT_START_WORK_TS,'yyyy') AS ACT_START_WORK_TS FROM DASHBOARDGRAFIK.VESSEL_DETAILS");
        $vessel_detail = \App\Models\Vessel_details::all();

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.vessel_detail',$leftmenu)->with(compact('title','pilih_tahun','vessel_detail'));
    } 

    public function cari_vessel_detail (Request $request)
    {
        $title = "vessel_detail";
        $pilih_tahun =  DB::select("SELECT distinct to_char(ACT_START_WORK_TS,'yyyy') AS ACT_START_WORK_TS FROM DASHBOARDGRAFIK.VESSEL_DETAILS");

        // menangkap data pencarian
        $bulan = $request->pilih_bulan;
        $tahun = $request->pilih_tahun;

        $vessel_detail =  DB::select("SELECT * FROM DASHBOARDGRAFIK.VESSEL_DETAILS WHERE to_char(ACT_START_WORK_TS,'mm/yyyy')='$bulan/$tahun'");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.vessel_detail',$leftmenu)->with(compact('title','pilih_tahun','vessel_detail'));
    } 

    public function vessel_performance ()
    {
        $title = "vessel_performance";
        $pilih_tahun =  DB::select("SELECT distinct to_char(FROM_TS,'yyyy') AS FROM_TS FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE");
        $vessel_performance = \App\Models\Vessel_performance::all();

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.vessel_performance',$leftmenu)->with(compact('title','pilih_tahun','vessel_performance'));
    } 

    public function cari_vessel_performance (Request $request)
    {
        $title = "vessel_performance";
        $pilih_tahun =  DB::select("SELECT distinct to_char(FROM_TS,'yyyy') AS FROM_TS FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE");

        // menangkap data pencarian
        $bulan = $request->pilih_bulan;
        $tahun = $request->pilih_tahun;

        $vessel_performance =  DB::select("SELECT * FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE WHERE to_char(FROM_TS,'mm/yyyy')='$bulan/$tahun'");


        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.vessel_performance',$leftmenu)->with(compact('title','pilih_tahun','vessel_performance'));
    } 

    public function grafik_vessel_performance ()
    {
        $title = "grafik_vessel_performance";
        $vessel_detail = Vessel_details::select('ves_id','ves_name')->distinct()->get();

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.grafik_vessel_performance',$leftmenu)->with(compact('title','vessel_detail'));
    } 

    public function cari_grafik_vessel_performance ()
    {
        $title = "grafik_vessel_performance";
        $vessel_detail = Vessel_details::select('ves_id','ves_name')->distinct()->get();

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.grafik_vessel_performance',$leftmenu)->with(compact('title','vessel_detail'));
    } 

    public function tanggal_vessel_performance ()
    {
        $title = "tanggal_vessel_performance";

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.tanggal_vessel_performance',$leftmenu)->with(compact('title'));
    } 

    public function cari_tanggal_vessel_performance (Request $request)
    {
        $title = "tanggal_vessel_performance";

        // menangkap data pencarian
        $tanggal = $request->tanggal;

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.tanggal_vessel_performance',$leftmenu)->with(compact('title'));
    } 

    public function bulan_vessel_performance ()
    {
        $title = "bulan_vessel_performance";
        $pilih_tahun =  DB::select("SELECT distinct TAHUN FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE");
        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun = $max->tahun;
        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.bulan_vessel_performance',$leftmenu)->with(compact('title','pilih_tahun','tahun','bulan'));
    } 

    public function cari_bulan_vessel_performance (Request $request)
    {
        $title = "bulan_vessel_performance";
        $pilih_tahun =  DB::select("SELECT distinct TAHUN FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE");

        // menangkap data pencarian
        $bulan = $request->pilih_bulan;
        $tahun = $request->pilih_tahun;

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kinerja.bulan_vessel_performance',$leftmenu)->with(compact('title','pilih_tahun','tahun','bulan'));
    } 
          
        
}
