<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V_produksi_pendapatan;
use App\Models\V_produksi_pendapatan_customer;
use DB;

class Slide_grafikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function shipcall_gt ()
    {
        $title = "shipcall_gt";
        $tahun_shipcall_gt =  DB::select('SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');

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

        $tahun_ini_shipcall =  DB::select("SELECT (NVL(SUM(SHIPCALL),0)) AS shipcall FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN='$tahun_ini' AND BULAN<=$bulan");
        $tahun_ini_shipcall_persen =  DB::select("SELECT (NVL(SUM(SHIPCALL),0)/600*100) AS shipcall FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN='$tahun_ini' AND BULAN<=$bulan");
        $tahun_lalu_shipcall =  DB::select("SELECT (NVL(SUM(SHIPCALL),0)) AS shipcall FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN='$tahun_lalu' AND BULAN<=$bulan");
        $tahun_lalu_shipcall_persen =  DB::select("SELECT (NVL(SUM(SHIPCALL),0)/600*100) AS shipcall FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN='$tahun_lalu' AND BULAN<=$bulan");

        $tahun_ini_gt =  DB::select("SELECT (NVL(SUM(gt),0)) AS gt FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
        $tahun_ini_gt_persen =  DB::select("SELECT (NVL(SUM(gt),0)/600*100) AS gt FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
        $tahun_lalu_gt =  DB::select("SELECT (NVL(SUM(gt),0)) AS gt FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
        $tahun_lalu_gt_persen =  DB::select("SELECT (NVL(SUM(gt),0)/600*100) AS gt FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");

        $rkap =  DB::select("SELECT (NVL(SUM(target_rkap),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
        $rkap_persen =  DB::select("SELECT (NVL(SUM(target_rkap),0)/600*100) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");

        return view('slide_grafik.arus_kapal.shipcall_gt',
            [
            'title' => $title,
            'bulan' => $bulan,
            'tahun_ini' => $tahun_ini,
            'tahun_lalu' => $tahun_lalu,
            'tahun_shipcall_gt' => $tahun_shipcall_gt,
            'tahun_ini_shipcall' => $tahun_ini_shipcall,
            'tahun_ini_shipcall_persen' => $tahun_ini_shipcall_persen,
            'tahun_lalu_shipcall' => $tahun_lalu_shipcall,
            'tahun_lalu_shipcall_persen' => $tahun_lalu_shipcall_persen,
            'tahun_ini_gt' => $tahun_ini_gt,
            'tahun_ini_gt_persen' => $tahun_ini_gt_persen,
            'tahun_lalu_gt' => $tahun_lalu_gt,
            'tahun_lalu_gt_persen' => $tahun_lalu_gt_persen,
            'rkap' => $rkap,
            'rkap_persen' => $rkap_persen,
        ]);
    }

        public function cari_tahun_shipcall_gt(Request $request)
        {
            $title = "shipcall_gt";
            $tahun_shipcall_gt =  DB::select('SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');
            
            // menangkap data pencarian
            $bulan = $request->cari_bulan;
            $grafik = $request->pilih_grafik;
            $tahun_ini = $request->cari_tahun;
            $tahun_lalu = $request->cari_tahun-1;

            //$bulan_shipcall_gt =  DB::select("SELECT DISTINCT Bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN='$tahun_ini' order by Bulan ASC");

            $tahun_ini_shipcall =  DB::select("SELECT (NVL(SUM(SHIPCALL),0)) AS shipcall FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN='$tahun_ini' AND BULAN<=$bulan");
            $tahun_ini_shipcall_persen =  DB::select("SELECT (NVL(SUM(SHIPCALL),0)/600*100) AS shipcall FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN='$tahun_ini' AND BULAN<=$bulan");
            $tahun_lalu_shipcall =  DB::select("SELECT (NVL(SUM(SHIPCALL),0)) AS shipcall FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN='$tahun_lalu' AND BULAN<=$bulan");
            $tahun_lalu_shipcall_persen =  DB::select("SELECT (NVL(SUM(SHIPCALL),0)/600*100) AS shipcall FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN='$tahun_lalu' AND BULAN<=$bulan");

            $tahun_ini_gt =  DB::select("SELECT (NVL(SUM(gt),0)) AS gt FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_ini_gt_persen =  DB::select("SELECT (NVL(SUM(gt),0)/600*100) AS gt FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_gt =  DB::select("SELECT (NVL(SUM(gt),0)) AS gt FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $tahun_lalu_gt_persen =  DB::select("SELECT (NVL(SUM(gt),0)/600*100) AS gt FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");

            $rkap =  DB::select("SELECT (NVL(SUM(target_rkap),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $rkap_persen =  DB::select("SELECT (NVL(SUM(target_rkap),0)/600*100) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");

            return view('slide_grafik.arus_kapal.shipcall_gt',
                [
                'title' => $title,
                'grafik' => $grafik,
                'bulan' => $bulan,
                //'bulan_shipcall_gt' => $bulan_shipcall_gt,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_shipcall_gt' => $tahun_shipcall_gt,
                'tahun_ini_shipcall' => $tahun_ini_shipcall,
                'tahun_ini_shipcall_persen' => $tahun_ini_shipcall_persen,
                'tahun_lalu_shipcall' => $tahun_lalu_shipcall,
                'tahun_lalu_shipcall_persen' => $tahun_lalu_shipcall_persen,
                'tahun_ini_gt' => $tahun_ini_gt,
                'tahun_ini_gt_persen' => $tahun_ini_gt_persen,
                'tahun_lalu_gt' => $tahun_lalu_gt,
                'tahun_lalu_gt_persen' => $tahun_lalu_gt_persen,
                'rkap' => $rkap,
                'rkap_persen' => $rkap_persen,
            ]);
        }

    public function arus_grafik ()
    {
        $title = "arus_grafik";
        $tahun_arus_grafik =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

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

        $satuan = 'JML_BOX';
        $lokasi = 'DOM'; 
        $satuan_rkap = 'BOX';   //RKAP

        // data satuan full
            $tahun_ini_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='$lokasi'");
            $tahun_lalu_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='$lokasi'");
            $rkap_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='$lokasi' AND SATUAN='$satuan_rkap'");
            $tahun_ini_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='$lokasi'");
            $tahun_lalu_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='$lokasi'");
            $rkap_nilai_full =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='$lokasi' AND SATUAN='$satuan_rkap'");

        return view('slide_grafik.arus_grafik.arus_grafik_full.arus_grafik_full',
            [
                'title' => $title,
                
                'tahun_arus_grafik' => $tahun_arus_grafik,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'satuan' => $satuan,
                'lokasi' => $lokasi,
                'satuan_rkap' => $satuan_rkap,
                
                'tahun_ini_tampil_full' => $tahun_ini_tampil_full,
                'tahun_lalu_tampil_full' => $tahun_lalu_tampil_full,
                'rkap_tampil_full' => $rkap_tampil_full,
                'tahun_ini_nilai_full' => $tahun_ini_nilai_full,
                'tahun_lalu_nilai_full' => $tahun_lalu_nilai_full,
                'rkap_nilai_full' => $rkap_nilai_full,
            ]);
    }

        public function cari_arus_grafik(Request $request)
        {
            $title = "arus_grafik";
            $tahun_arus_grafik =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

            // menangkap data pencarian
                $satuan = $request->pilih_satuan;

                if ($satuan=='JML_BOX') {
                    $satuan_rkap = 'BOX';
                }elseif ($satuan=='JML_TEUS') {
                      $satuan_rkap = 'TEUS';
                }else{
                    $satuan_rkap = 'TOT_PEND';
                } 

                $lokasi = $request->pilih_lokasi;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
                $bulan = $request->cari_bulan;
                $grafik = $request->pilih_grafik;
            //

            if ($lokasi == "DOM" || $lokasi == "INT") {
            
            // data satuan full
                $tahun_ini_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='$lokasi'");
                $tahun_lalu_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='$lokasi'");
                $rkap_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='$lokasi' AND SATUAN='$satuan_rkap'");
                $tahun_ini_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='$lokasi'");
                $tahun_lalu_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='$lokasi'");
                $rkap_nilai_full =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='$lokasi' AND SATUAN='$satuan_rkap'");
            //

            }else{ 
            
            // data satuan full
                $tahun_ini_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='$satuan_rkap'");
                $tahun_ini_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_nilai_full =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='$satuan_rkap'");
            //

            } 


        
            return view('slide_grafik.arus_grafik.arus_grafik_full.arus_grafik_full',
                [
                'title' => $title,
                'tahun_arus_grafik' => $tahun_arus_grafik,
                
                'satuan' => $satuan,
                'satuan_rkap' => $satuan_rkap,
                'lokasi' => $lokasi,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'grafik' => $grafik,

                'tahun_ini_tampil_full' => $tahun_ini_tampil_full,
                'tahun_lalu_tampil_full' => $tahun_lalu_tampil_full,
                'rkap_tampil_full' => $rkap_tampil_full,
                'tahun_ini_nilai_full' => $tahun_ini_nilai_full,
                'tahun_lalu_nilai_full' => $tahun_lalu_nilai_full,
                'rkap_nilai_full' => $rkap_nilai_full,
            ]);
        }

    public function arus_domestik ()
    {
        $title = "arus_domestik";
        $tahun_arus_domestik =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

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

        // data box
            $tahun_ini_tampil_box_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_tampil_box_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_tampil_box_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='BOX'");
            $tahun_ini_nilai_box_dom =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_nilai_box_dom =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_nilai_box_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='BOX'");
        // data teus
            $tahun_ini_tampil_teus_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_tampil_teus_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_tampil_teus_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TEUS'");
            $tahun_ini_nilai_teus_dom =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_nilai_teus_dom =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_nilai_teus_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TEUS'");
        // data pendapatan
            $tahun_ini_tampil_pendapatan_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_tampil_pendapatan_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_tampil_pendapatan_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TOT_PEND'");
            $tahun_ini_nilai_pendapatan_dom =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_nilai_pendapatan_dom =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_nilai_pendapatan_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TOT_PEND'");

        return view('slide_grafik.arus_grafik.arus_domestik',
            [
                'title' => $title,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_domestik' => $tahun_arus_domestik,
                'tahun_ini_tampil_box_dom' => $tahun_ini_tampil_box_dom,
                'tahun_lalu_tampil_box_dom' => $tahun_lalu_tampil_box_dom,
                'rkap_tampil_box_dom' => $rkap_tampil_box_dom,
                'tahun_ini_nilai_box_dom' => $tahun_ini_nilai_box_dom,
                'tahun_lalu_nilai_box_dom' => $tahun_lalu_nilai_box_dom,
                'rkap_nilai_box_dom' => $rkap_nilai_box_dom,
                'tahun_ini_tampil_teus_dom' => $tahun_ini_tampil_teus_dom,
                'tahun_lalu_tampil_teus_dom' => $tahun_lalu_tampil_teus_dom,
                'rkap_tampil_teus_dom' => $rkap_tampil_teus_dom,
                'tahun_ini_nilai_teus_dom' => $tahun_ini_nilai_teus_dom,
                'tahun_lalu_nilai_teus_dom' => $tahun_lalu_nilai_teus_dom,
                'rkap_nilai_teus_dom' => $rkap_nilai_teus_dom,
                'tahun_ini_tampil_pendapatan_dom' => $tahun_ini_tampil_pendapatan_dom,
                'tahun_lalu_tampil_pendapatan_dom' => $tahun_lalu_tampil_pendapatan_dom,
                'rkap_tampil_pendapatan_dom' => $rkap_tampil_pendapatan_dom,
                'tahun_ini_nilai_pendapatan_dom' => $tahun_ini_nilai_pendapatan_dom,
                'tahun_lalu_nilai_pendapatan_dom' => $tahun_lalu_nilai_pendapatan_dom,
                'rkap_nilai_pendapatan_dom' => $rkap_nilai_pendapatan_dom,
            ]);
    }

        public function cari_tahun_arus_domestik(Request $request)
        {
            $title = "arus_domestik";
            $tahun_arus_domestik =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

            // menangkap data pencarian
                $grafik = $request->pilih_grafik;
                $bulan = $request->cari_bulan;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
            // data box
                $tahun_ini_tampil_box_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_tampil_box_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_tampil_box_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='BOX'");
                $tahun_ini_nilai_box_dom =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_nilai_box_dom =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_nilai_box_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='BOX'");
            // data teus
                $tahun_ini_tampil_teus_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_tampil_teus_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_tampil_teus_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TEUS'");
                $tahun_ini_nilai_teus_dom =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_nilai_teus_dom =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_nilai_teus_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TEUS'");
            // data pendapatan
                $tahun_ini_tampil_pendapatan_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_tampil_pendapatan_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_tampil_pendapatan_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TOT_PEND'");
                $tahun_ini_nilai_pendapatan_dom =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_nilai_pendapatan_dom =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_nilai_pendapatan_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TOT_PEND'");
            //
        
            return view('slide_grafik.arus_grafik.arus_domestik',
                [
                'title' => $title,
                'bulan' => $bulan,
                'grafik' => $grafik,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_domestik' => $tahun_arus_domestik,
                'tahun_ini_tampil_box_dom' => $tahun_ini_tampil_box_dom,
                'tahun_lalu_tampil_box_dom' => $tahun_lalu_tampil_box_dom,
                'rkap_tampil_box_dom' => $rkap_tampil_box_dom,
                'tahun_ini_nilai_box_dom' => $tahun_ini_nilai_box_dom,
                'tahun_lalu_nilai_box_dom' => $tahun_lalu_nilai_box_dom,
                'rkap_nilai_box_dom' => $rkap_nilai_box_dom,
                'tahun_ini_tampil_teus_dom' => $tahun_ini_tampil_teus_dom,
                'tahun_lalu_tampil_teus_dom' => $tahun_lalu_tampil_teus_dom,
                'rkap_tampil_teus_dom' => $rkap_tampil_teus_dom,
                'tahun_ini_nilai_teus_dom' => $tahun_ini_nilai_teus_dom,
                'tahun_lalu_nilai_teus_dom' => $tahun_lalu_nilai_teus_dom,
                'rkap_nilai_teus_dom' => $rkap_nilai_teus_dom,
                'tahun_ini_tampil_pendapatan_dom' => $tahun_ini_tampil_pendapatan_dom,
                'tahun_lalu_tampil_pendapatan_dom' => $tahun_lalu_tampil_pendapatan_dom,
                'rkap_tampil_pendapatan_dom' => $rkap_tampil_pendapatan_dom,
                'tahun_ini_nilai_pendapatan_dom' => $tahun_ini_nilai_pendapatan_dom,
                'tahun_lalu_nilai_pendapatan_dom' => $tahun_lalu_nilai_pendapatan_dom,
                'rkap_nilai_pendapatan_dom' => $rkap_nilai_pendapatan_dom,
            ]);
        }

    public function arus_international ()
    {
        $title = "arus_international";
        $tahun_arus_international =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

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

        // data box
            $tahun_ini_tampil_box_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_tampil_box_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_tampil_box_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='BOX'");
            $tahun_ini_nilai_box_int =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_nilai_box_int =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_nilai_box_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='BOX'");
        // data teus
            $tahun_ini_tampil_teus_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_tampil_teus_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_tampil_teus_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TEUS'");
            $tahun_ini_nilai_teus_int =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_nilai_teus_int =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_nilai_teus_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TEUS'");
        // data pendapatan
            $tahun_ini_tampil_pendapatan_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_tampil_pendapatan_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_tampil_pendapatan_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TOT_PEND'");
            $tahun_ini_nilai_pendapatan_int =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_nilai_pendapatan_int =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_nilai_pendapatan_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN    WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TOT_PEND'");

        return view('slide_grafik.arus_grafik.arus_international',
            [
                'title' => $title,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_international' => $tahun_arus_international,
                'tahun_ini_tampil_box_int' => $tahun_ini_tampil_box_int,
                'tahun_lalu_tampil_box_int' => $tahun_lalu_tampil_box_int,
                'rkap_tampil_box_int' => $rkap_tampil_box_int,
                'tahun_ini_nilai_box_int' => $tahun_ini_nilai_box_int,
                'tahun_lalu_nilai_box_int' => $tahun_lalu_nilai_box_int,
                'rkap_nilai_box_int' => $rkap_nilai_box_int,
                'tahun_ini_tampil_teus_int' => $tahun_ini_tampil_teus_int,
                'tahun_lalu_tampil_teus_int' => $tahun_lalu_tampil_teus_int,
                'rkap_tampil_teus_int' => $rkap_tampil_teus_int,
                'tahun_ini_nilai_teus_int' => $tahun_ini_nilai_teus_int,
                'tahun_lalu_nilai_teus_int' => $tahun_lalu_nilai_teus_int,
                'rkap_nilai_teus_int' => $rkap_nilai_teus_int,
                'tahun_ini_tampil_pendapatan_int' => $tahun_ini_tampil_pendapatan_int,
                'tahun_lalu_tampil_pendapatan_int' => $tahun_lalu_tampil_pendapatan_int,
                'rkap_tampil_pendapatan_int' => $rkap_tampil_pendapatan_int,
                'tahun_ini_nilai_pendapatan_int' => $tahun_ini_nilai_pendapatan_int,
                'tahun_lalu_nilai_pendapatan_int' => $tahun_lalu_nilai_pendapatan_int,
                'rkap_nilai_pendapatan_int' => $rkap_nilai_pendapatan_int,
            ]);
    }

        public function cari_tahun_arus_international(Request $request)
        {
            $title = "arus_international";
            $tahun_arus_international =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

            // menangkap data pencarian
                $grafik = $request->pilih_grafik;
                $bulan = $request->cari_bulan;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
            // data box
                $tahun_ini_tampil_box_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_tampil_box_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_tampil_box_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='BOX'");
                $tahun_ini_nilai_box_int =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_nilai_box_int =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_nilai_box_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='BOX'");
            // data teus
                $tahun_ini_tampil_teus_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_tampil_teus_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_tampil_teus_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TEUS'");
                $tahun_ini_nilai_teus_int =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_nilai_teus_int =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_nilai_teus_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TEUS'");
            // data pendapatan
                $tahun_ini_tampil_pendapatan_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_tampil_pendapatan_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_tampil_pendapatan_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TOT_PEND'");
                $tahun_ini_nilai_pendapatan_int =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_nilai_pendapatan_int =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_nilai_pendapatan_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN    WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TOT_PEND'");
            //
        
            return view('slide_grafik.arus_grafik.arus_international',
                [
                'title' => $title,
                'grafik' => $grafik,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_international' => $tahun_arus_international,
                'tahun_ini_tampil_box_int' => $tahun_ini_tampil_box_int,
                'tahun_lalu_tampil_box_int' => $tahun_lalu_tampil_box_int,
                'rkap_tampil_box_int' => $rkap_tampil_box_int,
                'tahun_ini_nilai_box_int' => $tahun_ini_nilai_box_int,
                'tahun_lalu_nilai_box_int' => $tahun_lalu_nilai_box_int,
                'rkap_nilai_box_int' => $rkap_nilai_box_int,
                'tahun_ini_tampil_teus_int' => $tahun_ini_tampil_teus_int,
                'tahun_lalu_tampil_teus_int' => $tahun_lalu_tampil_teus_int,
                'rkap_tampil_teus_int' => $rkap_tampil_teus_int,
                'tahun_ini_nilai_teus_int' => $tahun_ini_nilai_teus_int,
                'tahun_lalu_nilai_teus_int' => $tahun_lalu_nilai_teus_int,
                'rkap_nilai_teus_int' => $rkap_nilai_teus_int,
                'tahun_ini_tampil_pendapatan_int' => $tahun_ini_tampil_pendapatan_int,
                'tahun_lalu_tampil_pendapatan_int' => $tahun_lalu_tampil_pendapatan_int,
                'rkap_tampil_pendapatan_int' => $rkap_tampil_pendapatan_int,
                'tahun_ini_nilai_pendapatan_int' => $tahun_ini_nilai_pendapatan_int,
                'tahun_lalu_nilai_pendapatan_int' => $tahun_lalu_nilai_pendapatan_int,
                'rkap_nilai_pendapatan_int' => $rkap_nilai_pendapatan_int,
            ]);
        }

    public function arus_total ()
    {
        $title = "arus_total";
        $tahun_arus_total =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

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

        // data box
            $tahun_ini_tampil_box =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_tampil_box =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_tampil_box =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='BOX'");
            $tahun_ini_nilai_box =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_nilai_box =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_nilai_box =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='BOX'");
        // data teus
            $tahun_ini_tampil_teus =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_tampil_teus =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_tampil_teus =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TEUS'");
            $tahun_ini_nilai_teus =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_nilai_teus =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_nilai_teus =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TEUS'");
        // data pendapatan
            $tahun_ini_tampil_pendapatan =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_tampil_pendapatan =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_tampil_pendapatan =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TOT_PEND'");
            $tahun_ini_nilai_pendapatan =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_nilai_pendapatan =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_nilai_pendapatan =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TOT_PEND'");

        return view('slide_grafik.arus_grafik.arus_total',
            [
            'title' => $title,
            'bulan' => $bulan,
            'tahun_ini' => $tahun_ini,
            'tahun_lalu' => $tahun_lalu,
            'tahun_arus_total' => $tahun_arus_total,
            'tahun_ini_tampil_box' => $tahun_ini_tampil_box,
            'tahun_lalu_tampil_box' => $tahun_lalu_tampil_box,
            'rkap_tampil_box' => $rkap_tampil_box,
            'tahun_ini_nilai_box' => $tahun_ini_nilai_box,
            'tahun_lalu_nilai_box' => $tahun_lalu_nilai_box,
            'rkap_nilai_box' => $rkap_nilai_box,
            'tahun_ini_tampil_teus' => $tahun_ini_tampil_teus,
            'tahun_lalu_tampil_teus' => $tahun_lalu_tampil_teus,
            'rkap_tampil_teus' => $rkap_tampil_teus,
            'tahun_ini_nilai_teus' => $tahun_ini_nilai_teus,
            'tahun_lalu_nilai_teus' => $tahun_lalu_nilai_teus,
            'rkap_nilai_teus' => $rkap_nilai_teus,
            'tahun_ini_tampil_pendapatan' => $tahun_ini_tampil_pendapatan,
            'tahun_lalu_tampil_pendapatan' => $tahun_lalu_tampil_pendapatan,
            'rkap_tampil_pendapatan' => $rkap_tampil_pendapatan,
            'tahun_ini_nilai_pendapatan' => $tahun_ini_nilai_pendapatan,
            'tahun_lalu_nilai_pendapatan' => $tahun_lalu_nilai_pendapatan,
            'rkap_nilai_pendapatan' => $rkap_nilai_pendapatan,
        ]);
    }

        public function cari_tahun_arus_total(Request $request)
        {
            $title = "arus_total";
            $tahun_arus_total =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

            // menangkap data pencarian
                $grafik = $request->pilih_grafik;
                $bulan = $request->cari_bulan;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
            // data box
                $tahun_ini_tampil_box =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_tampil_box =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_tampil_box =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='BOX'");
                $tahun_ini_nilai_box =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_nilai_box =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_nilai_box =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='BOX'");
            // data teus
                $tahun_ini_tampil_teus =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_tampil_teus =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN   WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_tampil_teus =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TEUS'");
                $tahun_ini_nilai_teus =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_nilai_teus =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_nilai_teus =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TEUS'");
            // data pendapatan
                $tahun_ini_tampil_pendapatan =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_tampil_pendapatan =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_tampil_pendapatan =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TOT_PEND'");
                $tahun_ini_nilai_pendapatan =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_nilai_pendapatan =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_nilai_pendapatan =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TOT_PEND'");
            //
            
            return view('slide_grafik.arus_grafik.arus_total',
                [
                'title' => $title,
                'grafik' => $grafik,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_total' => $tahun_arus_total,
                'tahun_ini_tampil_box' => $tahun_ini_tampil_box,
                'tahun_lalu_tampil_box' => $tahun_lalu_tampil_box,
                'rkap_tampil_box' => $rkap_tampil_box,
                'tahun_ini_nilai_box' => $tahun_ini_nilai_box,
                'tahun_lalu_nilai_box' => $tahun_lalu_nilai_box,
                'rkap_nilai_box' => $rkap_nilai_box,
                'tahun_ini_tampil_teus' => $tahun_ini_tampil_teus,
                'tahun_lalu_tampil_teus' => $tahun_lalu_tampil_teus,
                'rkap_tampil_teus' => $rkap_tampil_teus,
                'tahun_ini_nilai_teus' => $tahun_ini_nilai_teus,
                'tahun_lalu_nilai_teus' => $tahun_lalu_nilai_teus,
                'rkap_nilai_teus' => $rkap_nilai_teus,
                'tahun_ini_tampil_pendapatan' => $tahun_ini_tampil_pendapatan,
                'tahun_lalu_tampil_pendapatan' => $tahun_lalu_tampil_pendapatan,
                'rkap_tampil_pendapatan' => $rkap_tampil_pendapatan,
                'tahun_ini_nilai_pendapatan' => $tahun_ini_nilai_pendapatan,
                'tahun_lalu_nilai_pendapatan' => $tahun_lalu_nilai_pendapatan,
                'rkap_nilai_pendapatan' => $rkap_nilai_pendapatan,
            ]);
        }

    public function produksi_pendapatan ()
    {
        $title = "produksi_pendapatan";
        return view('slide_grafik.produksi_pendapatan',
            [
            'title' => $title,
        ]);
    }
 
    public function kinerja_kapal ()
    {
        $title = "kinerja_kapal";
        return view('slide_grafik.kinerja_kapal',
            [
            'title' => $title,
        ]);
    }

    public function market_share ()
    {
        $title = "market_share";
        $tahun_market_share =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER order by Tahun DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $satuan = 'JML_BOX';
        $lokasi = 'DOM'; 
        $satuan_rkap = 'BOX';   //RKAP

        // data box market
            $tahun_ini_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='$lokasi'");
            $tahun_lalu_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='$lokasi'");
            $rkap_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='$lokasi' AND SATUAN='$satuan_rkap'");
            $tahun_ini_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='$lokasi'");
            $tahun_lalu_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='$lokasi'");
            $rkap_nilai_full =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='$lokasi' AND SATUAN='$satuan_rkap'");

        return view('slide_grafik.market_share.market_share_full.market_share_full',
            [
                'title' => $title,
                'tahun_market_share' => $tahun_market_share,
                
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'satuan' => $satuan,
                'satuan_rkap' => $satuan_rkap,
                'lokasi' => $lokasi,
                
                'tahun_ini_tampil_full' => $tahun_ini_tampil_full,
                'tahun_lalu_tampil_full' => $tahun_lalu_tampil_full,
                'rkap_tampil_full' => $rkap_tampil_full,
                'tahun_ini_nilai_full' => $tahun_ini_nilai_full,
                'tahun_lalu_nilai_full' => $tahun_lalu_nilai_full,
                'rkap_nilai_full' => $rkap_nilai_full,
            ]);
    }

        public function cari_market_share(Request $request)
        {
            $title = "market_share";
            $tahun_market_share =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

            // menangkap data pencarian
                $satuan = $request->pilih_satuan;

                if ($satuan=='JML_BOX') {
                    $satuan_rkap = 'BOX';
                }elseif ($satuan=='JML_TEUS') {
                      $satuan_rkap = 'TEUS';
                }else{
                    $satuan_rkap = 'TOT_PEND';
                } 

                $lokasi = $request->pilih_lokasi;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
                $bulan = $request->cari_bulan;
                $grafik = $request->pilih_grafik;
            //

            if ($lokasi == "DOM" || $lokasi == "INT") {

            // data box market
                $tahun_ini_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='$lokasi'");
                $tahun_lalu_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='$lokasi'");
                $rkap_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='$lokasi' AND SATUAN='$satuan_rkap'");
                $tahun_ini_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='$lokasi'");
                $tahun_lalu_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='$lokasi'");
                $rkap_nilai_full =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='$lokasi' AND SATUAN='$satuan_rkap'");

            }else{ 

            // data box market
                $tahun_ini_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM($satuan),0), '999G999G999G999') AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_tampil_full =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='$satuan_rkap'");
                $tahun_ini_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_nilai_full =  DB::select("SELECT (NVL(SUM($satuan),0)) AS satuan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_nilai_full =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='$satuan_rkap'");

            } 

            return view('slide_grafik.market_share.market_share_full.market_share_full',
                [
                'title' => $title,
                'tahun_market_share' => $tahun_market_share,
                
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'satuan' => $satuan,
                'satuan_rkap' => $satuan_rkap,
                'lokasi' => $lokasi,
                
                'tahun_ini_tampil_full' => $tahun_ini_tampil_full,
                'tahun_lalu_tampil_full' => $tahun_lalu_tampil_full,
                'rkap_tampil_full' => $rkap_tampil_full,
                'tahun_ini_nilai_full' => $tahun_ini_nilai_full,
                'tahun_lalu_nilai_full' => $tahun_lalu_nilai_full,
                'rkap_nilai_full' => $rkap_nilai_full,
            ]);
        }

    public function market_domestik ()
    {
        $title = "market_domestik";
        $tahun_arus_domestik =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER order by Tahun DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        // data box market
            $tahun_ini_tampil_box_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_tampil_box_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_tampil_box_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='BOX'");
            $tahun_ini_nilai_box_market_dom =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_nilai_box_market_dom =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_nilai_box_market_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='BOX'");
        // data teus market
            $tahun_ini_tampil_teus_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_tampil_teus_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_tampil_teus_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TEUS'");
            $tahun_ini_nilai_teus_market_dom =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_nilai_teus_market_dom =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_nilai_teus_market_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TEUS'");
        // data pendapatan market
            $tahun_ini_tampil_pendapatan_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_tampil_pendapatan_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_tampil_pendapatan_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TOT_PEND'");
            $tahun_ini_nilai_pendapatan_market_dom =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
            $tahun_lalu_nilai_pendapatan_market_dom =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
            $rkap_nilai_pendapatan_market_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TOT_PEND'");
        //

        return view('slide_grafik.market_share.market_domestik',
            [
                'title' => $title,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_domestik' => $tahun_arus_domestik,
                'tahun_ini_tampil_box_market_dom' => $tahun_ini_tampil_box_market_dom,
                'tahun_lalu_tampil_box_market_dom' => $tahun_lalu_tampil_box_market_dom,
                'rkap_tampil_box_market_dom' => $rkap_tampil_box_market_dom,
                'tahun_ini_nilai_box_market_dom' => $tahun_ini_nilai_box_market_dom,
                'tahun_lalu_nilai_box_market_dom' => $tahun_lalu_nilai_box_market_dom,
                'rkap_nilai_box_market_dom' => $rkap_nilai_box_market_dom,
                'tahun_ini_tampil_teus_market_dom' => $tahun_ini_tampil_teus_market_dom,
                'tahun_lalu_tampil_teus_market_dom' => $tahun_lalu_tampil_teus_market_dom,
                'rkap_tampil_teus_market_dom' => $rkap_tampil_teus_market_dom,
                'tahun_ini_nilai_teus_market_dom' => $tahun_ini_nilai_teus_market_dom,
                'tahun_lalu_nilai_teus_market_dom' => $tahun_lalu_nilai_teus_market_dom,
                'rkap_nilai_teus_market_dom' => $rkap_nilai_teus_market_dom,
                'tahun_ini_tampil_pendapatan_market_dom' => $tahun_ini_tampil_pendapatan_market_dom,
                'tahun_lalu_tampil_pendapatan_market_dom' => $tahun_lalu_tampil_pendapatan_market_dom,
                'rkap_tampil_pendapatan_market_dom' => $rkap_tampil_pendapatan_market_dom,
                'tahun_ini_nilai_pendapatan_market_dom' => $tahun_ini_nilai_pendapatan_market_dom,
                'tahun_lalu_nilai_pendapatan_market_dom' => $tahun_lalu_nilai_pendapatan_market_dom,
                'rkap_nilai_pendapatan_market_dom' => $rkap_nilai_pendapatan_market_dom,
            ]);
    }

        public function cari_tahun_market_domestik(Request $request)
        {
            $title = "market_domestik";
            $tahun_arus_domestik =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

            // menangkap data pencarian
                $bulan = $request->cari_bulan;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
            // data box market
                $tahun_ini_tampil_box_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_tampil_box_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_tampil_box_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='BOX'");
                $tahun_ini_nilai_box_market_dom =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_nilai_box_market_dom =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_nilai_box_market_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='BOX'");
            // data teus market
                $tahun_ini_tampil_teus_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_tampil_teus_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_tampil_teus_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TEUS'");
                $tahun_ini_nilai_teus_market_dom =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_nilai_teus_market_dom =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_nilai_teus_market_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TEUS'");
            // data pendapatan market
                $tahun_ini_tampil_pendapatan_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_tampil_pendapatan_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_tampil_pendapatan_market_dom =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TOT_PEND'");
                $tahun_ini_nilai_pendapatan_market_dom =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM'");
                $tahun_lalu_nilai_pendapatan_market_dom =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM'");
                $rkap_nilai_pendapatan_market_dom =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TOT_PEND'");
            //

            return view('slide_grafik.market_share.market_domestik',
                [
                'title' => $title,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_domestik' => $tahun_arus_domestik,
                'tahun_ini_tampil_box_market_dom' => $tahun_ini_tampil_box_market_dom,
                'tahun_lalu_tampil_box_market_dom' => $tahun_lalu_tampil_box_market_dom,
                'rkap_tampil_box_market_dom' => $rkap_tampil_box_market_dom,
                'tahun_ini_nilai_box_market_dom' => $tahun_ini_nilai_box_market_dom,
                'tahun_lalu_nilai_box_market_dom' => $tahun_lalu_nilai_box_market_dom,
                'rkap_nilai_box_market_dom' => $rkap_nilai_box_market_dom,
                'tahun_ini_tampil_teus_market_dom' => $tahun_ini_tampil_teus_market_dom,
                'tahun_lalu_tampil_teus_market_dom' => $tahun_lalu_tampil_teus_market_dom,
                'rkap_tampil_teus_market_dom' => $rkap_tampil_teus_market_dom,
                'tahun_ini_nilai_teus_market_dom' => $tahun_ini_nilai_teus_market_dom,
                'tahun_lalu_nilai_teus_market_dom' => $tahun_lalu_nilai_teus_market_dom,
                'rkap_nilai_teus_market_dom' => $rkap_nilai_teus_market_dom,
                'tahun_ini_tampil_pendapatan_market_dom' => $tahun_ini_tampil_pendapatan_market_dom,
                'tahun_lalu_tampil_pendapatan_market_dom' => $tahun_lalu_tampil_pendapatan_market_dom,
                'rkap_tampil_pendapatan_market_dom' => $rkap_tampil_pendapatan_market_dom,
                'tahun_ini_nilai_pendapatan_market_dom' => $tahun_ini_nilai_pendapatan_market_dom,
                'tahun_lalu_nilai_pendapatan_market_dom' => $tahun_lalu_nilai_pendapatan_market_dom,
                'rkap_nilai_pendapatan_market_dom' => $rkap_nilai_pendapatan_market_dom,
            ]);
        }

    public function market_international ()
    {
        $title = "market_international";
        $tahun_arus_international =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER order by Tahun DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        // data box market
            $tahun_ini_tampil_box_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_tampil_box_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_tampil_box_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='BOX'");
            $tahun_ini_nilai_box_market_int =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_nilai_box_market_int =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_nilai_box_market_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='BOX'");
        // data teus market
            $tahun_ini_tampil_teus_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_tampil_teus_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_tampil_teus_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TEUS'");
            $tahun_ini_nilai_teus_market_int =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_nilai_teus_market_int =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_nilai_teus_market_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TEUS'");
        // data pendapatan market
            $tahun_ini_tampil_pendapatan_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_tampil_pendapatan_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_tampil_pendapatan_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TOT_PEND'");
            $tahun_ini_nilai_pendapatan_market_int =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
            $tahun_lalu_nilai_pendapatan_market_int =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
            $rkap_nilai_pendapatan_market_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TOT_PEND'");
        //

        return view('slide_grafik.market_share.market_international',
            [
                'title' => $title,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_international' => $tahun_arus_international,
                'tahun_ini_tampil_box_market_int' => $tahun_ini_tampil_box_market_int,
                'tahun_lalu_tampil_box_market_int' => $tahun_lalu_tampil_box_market_int,
                'rkap_tampil_box_market_int' => $rkap_tampil_box_market_int,
                'tahun_ini_nilai_box_market_int' => $tahun_ini_nilai_box_market_int,
                'tahun_lalu_nilai_box_market_int' => $tahun_lalu_nilai_box_market_int,
                'rkap_nilai_box_market_int' => $rkap_nilai_box_market_int,
                'tahun_ini_tampil_teus_market_int' => $tahun_ini_tampil_teus_market_int,
                'tahun_lalu_tampil_teus_market_int' => $tahun_lalu_tampil_teus_market_int,
                'rkap_tampil_teus_market_int' => $rkap_tampil_teus_market_int,
                'tahun_ini_nilai_teus_market_int' => $tahun_ini_nilai_teus_market_int,
                'tahun_lalu_nilai_teus_market_int' => $tahun_lalu_nilai_teus_market_int,
                'rkap_nilai_teus_market_int' => $rkap_nilai_teus_market_int,
                'tahun_ini_tampil_pendapatan_market_int' => $tahun_ini_tampil_pendapatan_market_int,
                'tahun_lalu_tampil_pendapatan_market_int' => $tahun_lalu_tampil_pendapatan_market_int,
                'rkap_tampil_pendapatan_market_int' => $rkap_tampil_pendapatan_market_int,
                'tahun_ini_nilai_pendapatan_market_int' => $tahun_ini_nilai_pendapatan_market_int,
                'tahun_lalu_nilai_pendapatan_market_int' => $tahun_lalu_nilai_pendapatan_market_int,
                'rkap_nilai_pendapatan_market_int' => $rkap_nilai_pendapatan_market_int,
            ]);
    }

        public function cari_tahun_market_international(Request $request)
        {
            $title = "market_international";
            $tahun_arus_international =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

            // menangkap data pencarian
                $bulan = $request->cari_bulan;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
            // data box market
                $tahun_ini_tampil_box_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_tampil_box_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_tampil_box_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='BOX'");
                $tahun_ini_nilai_box_market_int =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_nilai_box_market_int =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_nilai_box_market_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='BOX'");
            // data teus market
                $tahun_ini_tampil_teus_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_tampil_teus_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_tampil_teus_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TEUS'");
                $tahun_ini_nilai_teus_market_int =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_nilai_teus_market_int =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_nilai_teus_market_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TEUS'");
            // data pendapatan market
                $tahun_ini_tampil_pendapatan_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_tampil_pendapatan_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_tampil_pendapatan_market_int =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TOT_PEND'");
                $tahun_ini_nilai_pendapatan_market_int =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT'");
                $tahun_lalu_nilai_pendapatan_market_int =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT'");
                $rkap_nilai_pendapatan_market_int =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TOT_PEND'");
            //

            return view('slide_grafik.market_share.market_international',
                [
                'title' => $title,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_international' => $tahun_arus_international,
                'tahun_ini_tampil_box_market_int' => $tahun_ini_tampil_box_market_int,
                'tahun_lalu_tampil_box_market_int' => $tahun_lalu_tampil_box_market_int,
                'rkap_tampil_box_market_int' => $rkap_tampil_box_market_int,
                'tahun_ini_nilai_box_market_int' => $tahun_ini_nilai_box_market_int,
                'tahun_lalu_nilai_box_market_int' => $tahun_lalu_nilai_box_market_int,
                'rkap_nilai_box_market_int' => $rkap_nilai_box_market_int,
                'tahun_ini_tampil_teus_market_int' => $tahun_ini_tampil_teus_market_int,
                'tahun_lalu_tampil_teus_market_int' => $tahun_lalu_tampil_teus_market_int,
                'rkap_tampil_teus_market_int' => $rkap_tampil_teus_market_int,
                'tahun_ini_nilai_teus_market_int' => $tahun_ini_nilai_teus_market_int,
                'tahun_lalu_nilai_teus_market_int' => $tahun_lalu_nilai_teus_market_int,
                'rkap_nilai_teus_market_int' => $rkap_nilai_teus_market_int,
                'tahun_ini_tampil_pendapatan_market_int' => $tahun_ini_tampil_pendapatan_market_int,
                'tahun_lalu_tampil_pendapatan_market_int' => $tahun_lalu_tampil_pendapatan_market_int,
                'rkap_tampil_pendapatan_market_int' => $rkap_tampil_pendapatan_market_int,
                'tahun_ini_nilai_pendapatan_market_int' => $tahun_ini_nilai_pendapatan_market_int,
                'tahun_lalu_nilai_pendapatan_market_int' => $tahun_lalu_nilai_pendapatan_market_int,
                'rkap_nilai_pendapatan_market_int' => $rkap_nilai_pendapatan_market_int,
            ]);
        }

    public function market_total ()
    {
        $title = "market_total";
        $tahun_arus_total =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER order by Tahun DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        // data box market
            $tahun_ini_tampil_box_market =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_tampil_box_market =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_tampil_box_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='BOX'");
            $tahun_ini_nilai_box_market =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_nilai_box_market =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_nilai_box_market =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN    WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='BOX'");
        // data teus market
            $tahun_ini_tampil_teus_market =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_tampil_teus_market =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_tampil_teus_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TEUS'");
            $tahun_ini_nilai_teus_market =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_nilai_teus_market =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_nilai_teus_market =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN    WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TEUS'");
        // data pendapatan market
            $tahun_ini_tampil_pendapatan_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_tampil_pendapatan_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_tampil_pendapatan_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TOT_PEND'");
            $tahun_ini_nilai_pendapatan_market =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
            $tahun_lalu_nilai_pendapatan_market =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
            $rkap_nilai_pendapatan_market =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TOT_PEND'");
        //

        return view('slide_grafik.market_share.market_total',
            [
                'title' => $title,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_total' => $tahun_arus_total,
                'tahun_ini_tampil_box_market' => $tahun_ini_tampil_box_market,
                'tahun_lalu_tampil_box_market' => $tahun_lalu_tampil_box_market,
                'rkap_tampil_box_market' => $rkap_tampil_box_market,
                'tahun_ini_nilai_box_market' => $tahun_ini_nilai_box_market,
                'tahun_lalu_nilai_box_market' => $tahun_lalu_nilai_box_market,
                'rkap_nilai_box_market' => $rkap_nilai_box_market,
                'tahun_ini_tampil_teus_market' => $tahun_ini_tampil_teus_market,
                'tahun_lalu_tampil_teus_market' => $tahun_lalu_tampil_teus_market,
                'rkap_tampil_teus_market' => $rkap_tampil_teus_market,
                'tahun_ini_nilai_teus_market' => $tahun_ini_nilai_teus_market,
                'tahun_lalu_nilai_teus_market' => $tahun_lalu_nilai_teus_market,
                'rkap_nilai_teus_market' => $rkap_nilai_teus_market,
                'tahun_ini_tampil_pendapatan_market' => $tahun_ini_tampil_pendapatan_market,
                'tahun_lalu_tampil_pendapatan_market' => $tahun_lalu_tampil_pendapatan_market,
                'rkap_tampil_pendapatan_market' => $rkap_tampil_pendapatan_market,
                'tahun_ini_nilai_pendapatan_market' => $tahun_ini_nilai_pendapatan_market,
                'tahun_lalu_nilai_pendapatan_market' => $tahun_lalu_nilai_pendapatan_market,
                'rkap_nilai_pendapatan_market' => $rkap_nilai_pendapatan_market,
            ]);
    }

        public function cari_tahun_market_total(Request $request)
        {
            $title = "market_total";
            $tahun_arus_total =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

            // menangkap data pencarian
                $bulan = $request->cari_bulan;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
            // data box market
                $tahun_ini_tampil_box_market =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_tampil_box_market =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_BOX),0), '999G999G999G999') AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_tampil_box_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='BOX'");
                $tahun_ini_nilai_box_market =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_nilai_box_market =  DB::select("SELECT (NVL(SUM(JML_BOX),0)) AS box FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_nilai_box_market =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN    WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='BOX'");
            // data teus market
                $tahun_ini_tampil_teus_market =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_tampil_teus_market =  DB::select("SELECT TO_CHAR(NVL(SUM(JML_TEUS),0), '999G999G999G999') AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_tampil_teus_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TEUS'");
                $tahun_ini_nilai_teus_market =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_nilai_teus_market =  DB::select("SELECT (NVL(SUM(JML_TEUS),0)) AS teus FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_nilai_teus_market =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN    WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TEUS'");
            // data pendapatan market
                $tahun_ini_tampil_pendapatan_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_tampil_pendapatan_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TOTAL_PENDAPATAN),0), '999G999G999G999') AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_tampil_pendapatan_market =  DB::select("SELECT TO_CHAR(NVL(SUM(TARGET_RKAP),0), '999G999G999G999') AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TOT_PEND'");
                $tahun_ini_nilai_pendapatan_market =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan");
                $tahun_lalu_nilai_pendapatan_market =  DB::select("SELECT (NVL(SUM(TOTAL_PENDAPATAN),0)) AS pendapatan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan");
                $rkap_nilai_pendapatan_market =  DB::select("SELECT (NVL(SUM(TARGET_RKAP),0)) AS target_rkap FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TOT_PEND'");
            //
            
            return view('slide_grafik.market_share.market_total',
                [
                'title' => $title,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_total' => $tahun_arus_total,
                'tahun_ini_tampil_box_market' => $tahun_ini_tampil_box_market,
                'tahun_lalu_tampil_box_market' => $tahun_lalu_tampil_box_market,
                'rkap_tampil_box_market' => $rkap_tampil_box_market,
                'tahun_ini_nilai_box_market' => $tahun_ini_nilai_box_market,
                'tahun_lalu_nilai_box_market' => $tahun_lalu_nilai_box_market,
                'rkap_nilai_box_market' => $rkap_nilai_box_market,
                'tahun_ini_tampil_teus_market' => $tahun_ini_tampil_teus_market,
                'tahun_lalu_tampil_teus_market' => $tahun_lalu_tampil_teus_market,
                'rkap_tampil_teus_market' => $rkap_tampil_teus_market,
                'tahun_ini_nilai_teus_market' => $tahun_ini_nilai_teus_market,
                'tahun_lalu_nilai_teus_market' => $tahun_lalu_nilai_teus_market,
                'rkap_nilai_teus_market' => $rkap_nilai_teus_market,
                'tahun_ini_tampil_pendapatan_market' => $tahun_ini_tampil_pendapatan_market,
                'tahun_lalu_tampil_pendapatan_market' => $tahun_lalu_tampil_pendapatan_market,
                'rkap_tampil_pendapatan_market' => $rkap_tampil_pendapatan_market,
                'tahun_ini_nilai_pendapatan_market' => $tahun_ini_nilai_pendapatan_market,
                'tahun_lalu_nilai_pendapatan_market' => $tahun_lalu_nilai_pendapatan_market,
                'rkap_nilai_pendapatan_market' => $rkap_nilai_pendapatan_market,
            ]);
        }

    public function nota ()
    {
        $title = "nota";
        $tahun_nota =  DB::select("SELECT DISTINCT TAHUN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER ORDER BY TAHUN DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $satuan = 'JML_BOX';

        return view('slide_grafik.nota.nota',
            [
                'title' => $title,
                'tahun_nota' => $tahun_nota,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'satuan' => $satuan,
            ]);
    }

        public function cari_nota(Request $request)
        {
            $title = "nota";
            $tahun_nota =  DB::select("SELECT DISTINCT TAHUN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN ORDER BY TAHUN DESC");

            // menangkap data pencarian
                $satuan = $request->pilih_satuan;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
                $bulan = $request->cari_bulan;
                $grafik = $request->pilih_grafik;
            //

            return view('slide_grafik.nota.nota',
                [
                'title' => $title,
                'tahun_nota' => $tahun_nota,
                'satuan' => $satuan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'grafik' => $grafik,
            ]);
        }

    public function nota_satuan ()
    {
        $title = "nota_satuan";
        $tahun_nota =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER order by Tahun DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        return view('slide_grafik.nota.slide_grafik.nota_satuan',
            [
                'title' => $title,
                'tahun_nota' => $tahun_nota,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
            ]);
    }

        public function cari_nota_satuan(Request $request)
        {
            $title = "arus_domestik";
            $tahun_arus_domestik =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER order by Tahun DESC");

            // menangkap data pencarian
                $grafik = $request->pilih_grafik;
                $bulan = $request->cari_bulan;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
            //
        
            return view('slide_grafik.arus_grafik.arus_domestik',
                [
                'title' => $title,
                'bulan' => $bulan,
                'grafik' => $grafik,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_arus_domestik' => $tahun_arus_domestik,
            ]);
        }

    public function departure ()
    {
        $title = "departure";
        $tahun_departure =  DB::select("SELECT DISTINCT TAHUN_DEPARTURE FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER ORDER BY TAHUN_DEPARTURE DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $satuan = 'JML_BOX';
        $lokasi = 'DOM'; 
        $satuan_rkap = 'BOX';   //RKAP

        return view('slide_grafik.departure.departure',
            [
                'title' => $title,
                'tahun_departure' => $tahun_departure,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'satuan' => $satuan,
                'lokasi' => $lokasi,
                'satuan_rkap' => $satuan_rkap,
            ]);
    }

        public function cari_departure(Request $request)
        {
            $title = "departure";
            $tahun_departure =  DB::select("SELECT DISTINCT TAHUN_DEPARTURE FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN ORDER BY TAHUN_DEPARTURE DESC");

            // menangkap data pencarian
                $satuan = $request->pilih_satuan;

                if ($satuan=='JML_BOX') {
                    $satuan_rkap = 'BOX';
                }elseif ($satuan=='JML_TEUS') {
                      $satuan_rkap = 'TEUS';
                }else{
                    $satuan_rkap = 'TOT_PEND';
                } 

                $lokasi = $request->pilih_lokasi;
                $grafik = $request->pilih_grafik;
                $bulan = $request->cari_bulan;
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
            //

            return view('slide_grafik.departure.departure',
                [
                'title' => $title,
                'satuan' => $satuan,
                'satuan_rkap' => $satuan_rkap,
                'lokasi' => $lokasi,
                'grafik' => $grafik,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'tahun_departure' => $tahun_departure,
            ]);
        }

    public function departure_domestik ()
    {
        $title = "departure_domestik";
        $tahun_departure =  DB::select("SELECT DISTINCT TAHUN_DEPARTURE FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER ORDER BY TAHUN_DEPARTURE DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        return view('slide_grafik.departure.slide_grafik.departure_domestik.departure_domestik',
            [
                'title' => $title,
                'tahun_departure' => $tahun_departure,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
            ]);
    }

        public function cari_departure_domestik(Request $request)
        {
            $title = "departure_domestik";
            $tahun_departure =  DB::select("SELECT DISTINCT TAHUN_DEPARTURE FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER ORDER BY TAHUN_DEPARTURE DESC");

            // menangkap data pencarian
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
                $bulan = $request->cari_bulan;
                $grafik = $request->pilih_grafik;
            //
        
            return view('slide_grafik.departure.slide_grafik.departure_domestik.departure_domestik',
                [
                'title' => $title,
                'tahun_departure' => $tahun_departure,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'grafik' => $grafik,
            ]);
        }

    public function departure_international ()
    {
        $title = "departure_international";
        $tahun_departure =  DB::select("SELECT DISTINCT TAHUN_DEPARTURE FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER ORDER BY TAHUN_DEPARTURE DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        return view('slide_grafik.departure.slide_grafik.departure_international.departure_international',
            [
                'title' => $title,
                'tahun_departure' => $tahun_departure,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
            ]);
    }

        public function cari_departure_international(Request $request)
        {
            $title = "departure_international";
            $tahun_departure =  DB::select("SELECT DISTINCT TAHUN_DEPARTURE FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER ORDER BY TAHUN_DEPARTURE DESC");

            // menangkap data pencarian
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
                $bulan = $request->cari_bulan;
                $grafik = $request->pilih_grafik;
            //
        
            return view('slide_grafik.departure.slide_grafik.departure_international.departure_international',
                [
                'title' => $title,
                'tahun_departure' => $tahun_departure,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'grafik' => $grafik,
            ]);
        }

    public function departure_total ()
    {
        $title = "departure_total";
        $tahun_departure =  DB::select("SELECT DISTINCT TAHUN_DEPARTURE FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER ORDER BY TAHUN_DEPARTURE DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        return view('slide_grafik.departure.slide_grafik.departure_total.departure_total',
            [
                'title' => $title,
                'tahun_departure' => $tahun_departure,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
            ]);
    }

        public function cari_departure_total(Request $request)
        {
            $title = "departure_total";
            $tahun_departure =  DB::select("SELECT DISTINCT TAHUN_DEPARTURE FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER ORDER BY TAHUN_DEPARTURE DESC");

            // menangkap data pencarian
                $tahun_ini = $request->cari_tahun;
                $tahun_lalu = $request->cari_tahun-1;
                $bulan = $request->cari_bulan;
                $grafik = $request->pilih_grafik;
            //
        
            return view('slide_grafik.departure.slide_grafik.departure_total.departure_total',
                [
                'title' => $title,
                'tahun_departure' => $tahun_departure,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'grafik' => $grafik,
            ]);
        }

}
