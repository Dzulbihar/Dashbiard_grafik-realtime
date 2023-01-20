<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V_produksi_pendapatan;
use DB;
use App\Models\DataModel;

class OLD_Arus_petikemas_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function data_arus_petikemas ()
    {
        $title = "data_arus_petikemas";
        $data_arus_petikemas = \App\Models\V_produksi_pendapatan::orderBy('tahun', 'ASC')
        ->get();
        $lokasi_data_arus_petikemas =  DB::select('SELECT distinct Lokasi From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN');
        $tahun_data_arus_petikemas =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by tahun DESC');

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.arus_petikemas.data',$leftmenu)->with(compact('title','data_arus_petikemas','lokasi_data_arus_petikemas','tahun_data_arus_petikemas'));
    }

    public function cari_data_arus_petikemas(Request $request)
    {
        $title = "data_arus_petikemas";
        $lokasi_data_arus_petikemas =  DB::select('SELECT distinct Lokasi From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN');
        $tahun_data_arus_petikemas =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by tahun DESC');

        // menangkap data pencarian
        $cari_lokasi = $request->cari_lokasi;
        $cari_tahun = $request->cari_tahun;
        $data_arus_petikemas =  DB::select("SELECT * FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE LOKASI LIKE'%$cari_lokasi%' AND TAHUN LIKE'%$cari_tahun%'");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.arus_petikemas.data',$leftmenu)->with(compact('title','data_arus_petikemas','lokasi_data_arus_petikemas','tahun_data_arus_petikemas'));
    }

    public function grafik_arus_petikemas ()
    {
        $title = "grafik_arus_petikemas";
        $tahun_grafik_arus_petikemas =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $data_arus_petikemas_box_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_box_import)  jml_box_import, sum(jml_box_export) jml_box_export, sum(jml_box_import+jml_box_export) jml_box
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='BOX' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");
        $data_arus_petikemas_box_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_box_import)  jml_box_import, sum(jml_box_export) jml_box_export, sum(jml_box_import+jml_box_export) jml_box
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='BOX' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_teus_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_teus_import)  jml_teus_import, sum(jml_teus_export) jml_teus_export, sum(jml_teus_import+jml_teus_export) jml_teus
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='TEUS' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");
        $data_arus_petikemas_teus_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_teus_import)  jml_teus_import, sum(jml_teus_export) jml_teus_export, sum(jml_teus_import+jml_teus_export) jml_teus
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='TEUS' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_pendapatan_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(total_pendapatan) total_pendapatan
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='PENDAPATAN' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");
        $data_arus_petikemas_pendapatan_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(total_pendapatan) total_pendapatan
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='PENDAPATAN' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.arus_petikemas.grafik',$leftmenu)->with(compact('title','tahun_grafik_arus_petikemas','tahun_ini','tahun_lalu','bulan','data_arus_petikemas_box_domestik','data_arus_petikemas_box_international','data_arus_petikemas_teus_domestik','data_arus_petikemas_teus_international','data_arus_petikemas_pendapatan_domestik','data_arus_petikemas_pendapatan_international'));
    }

    public function cari_grafik_arus_petikemas(Request $request)
    {
        $title = "grafik_arus_petikemas";
        $tahun_grafik_arus_petikemas =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

        // menangkap data pencarian
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;
        $bulan = $request->cari_bulan;

        $data_arus_petikemas_box_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_box_import)  jml_box_import, sum(jml_box_export) jml_box_export, sum(jml_box_import+jml_box_export) jml_box
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='BOX' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");
        $data_arus_petikemas_box_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_box_import)  jml_box_import, sum(jml_box_export) jml_box_export, sum(jml_box_import+jml_box_export) jml_box
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='BOX' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_teus_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_teus_import)  jml_teus_import, sum(jml_teus_export) jml_teus_export, sum(jml_teus_import+jml_teus_export) jml_teus
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='TEUS' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");
        $data_arus_petikemas_teus_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_teus_import)  jml_teus_import, sum(jml_teus_export) jml_teus_export, sum(jml_teus_import+jml_teus_export) jml_teus
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='TEUS' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_pendapatan_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(total_pendapatan) total_pendapatan
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='PENDAPATAN' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");
        $data_arus_petikemas_pendapatan_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(total_pendapatan) total_pendapatan
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='PENDAPATAN' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.arus_petikemas.grafik',$leftmenu)->with(compact('title','tahun_grafik_arus_petikemas','tahun_ini','tahun_lalu','bulan','data_arus_petikemas_box_domestik','data_arus_petikemas_box_international','data_arus_petikemas_teus_domestik','data_arus_petikemas_teus_international','data_arus_petikemas_pendapatan_domestik','data_arus_petikemas_pendapatan_international'));
    }

}
