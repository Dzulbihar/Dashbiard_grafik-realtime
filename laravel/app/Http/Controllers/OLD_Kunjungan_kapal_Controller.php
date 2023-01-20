<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V_produksi_pendapatan;
use DB;
use App\Models\DataModel;

class OLD_Kunjungan_kapal_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function data_kunjungan_kapal ()
    {
        $title = "data_kunjungan_kapal";
        $data_kunjungan_kapal = \App\Models\V_produksi_pendapatan::orderBy('tahun', 'ASC')
        ->get();
        $lokasi_data_kunjungan_kapal =  DB::select('SELECT distinct Lokasi From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN');
        $tahun_data_kunjungan_kapal =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by tahun DESC');

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kunjungan_kapal.data',$leftmenu)->with(compact('title','data_kunjungan_kapal','lokasi_data_kunjungan_kapal','tahun_data_kunjungan_kapal'));
    }

    public function cari_data_kunjungan_kapal(Request $request)
    {
        $title = "data_kunjungan_kapal";
        $lokasi_data_kunjungan_kapal =  DB::select('SELECT distinct Lokasi From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN');
        $tahun_data_kunjungan_kapal =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by tahun DESC');

        // menangkap data pencarian
        $cari_lokasi = $request->cari_lokasi;
        $cari_tahun = $request->cari_tahun;
        $data_kunjungan_kapal =  DB::select("SELECT * FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE LOKASI LIKE'%$cari_lokasi%' AND TAHUN LIKE'%$cari_tahun%'");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kunjungan_kapal.data',$leftmenu)->with(compact('title','data_kunjungan_kapal','lokasi_data_kunjungan_kapal','tahun_data_kunjungan_kapal'));
    }

    public function grafik_kunjungan_kapal ()
    {
        $title = "grafik_kunjungan_kapal";

        $tahun_grafik_kunjungan_kapal =  DB::select('SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');

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

        $data_kunjungan_kapal_domestik =  DB::select("SELECT (SELECT (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN A WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' AND A.BULAN=B.BULAN group by BULAN ) SHIPCALL, TARGET_RKAP, BULAN, TAHUN, SATUAN, TYPE FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN B WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='SHIPCALL' AND TYPE='DOM'");
        $data_kunjungan_kapal_international =  DB::select("SELECT (SELECT (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN A WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' AND A.BULAN=B.BULAN group by BULAN ) SHIPCALL, TARGET_RKAP, BULAN, TAHUN, SATUAN, TYPE FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN B WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='SHIPCALL' AND TYPE='INT'");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kunjungan_kapal.grafik',$leftmenu)->with(compact('title','tahun_grafik_kunjungan_kapal','tahun_ini','tahun_lalu','bulan','data_kunjungan_kapal_domestik','data_kunjungan_kapal_international'));
    }

    public function cari_grafik_kunjungan_kapal(Request $request)
    {
        $title = "grafik_kunjungan_kapal";
        $tahun_grafik_kunjungan_kapal =  DB::select('SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');

            // menangkap data pencarian
        $bulan = $request->cari_bulan;
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;

        $data_kunjungan_kapal_domestik =  DB::select("SELECT (SELECT (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN A WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' AND A.BULAN=B.BULAN group by BULAN ) SHIPCALL, TARGET_RKAP, BULAN, TAHUN, SATUAN, TYPE FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN B WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='SHIPCALL' AND TYPE='DOM'");
        $data_kunjungan_kapal_international =  DB::select("SELECT (SELECT (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN A WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' AND A.BULAN=B.BULAN group by BULAN ) SHIPCALL, TARGET_RKAP, BULAN, TAHUN, SATUAN, TYPE FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN B WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='SHIPCALL' AND TYPE='INT'");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.kunjungan_kapal.grafik',$leftmenu)->with(compact('title','tahun_grafik_kunjungan_kapal','tahun_ini','tahun_lalu','bulan','data_kunjungan_kapal_domestik','data_kunjungan_kapal_international'));
    }

}
