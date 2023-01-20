<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "home";
            $pilih_durasi =  DB::select("SELECT KODE,VALUE_NUMBER,KET_NUMBER From DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='WAKTU' order by ID");
            $pilih_tahun =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');

            $durasi_awal =  DB::select("SELECT value_number From DASHBOARDGRAFIK.V_SYSCODE WHERE KET_NUMBER='30 detik'");
            foreach ($durasi_awal as $hasil_durasi) {
                $hasil_durasi->value_number;
            }
            $durasi = $hasil_durasi->value_number;

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

        //shipcall_gt
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
        //

        //arus domestik
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

        //arus international
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

        //arus total
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

        //market share domestik
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

        //market share international
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

        //market share total
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

        return view('home',
            [
                'title' => $title,
                'pilih_durasi' => $pilih_durasi,
                'durasi' => $durasi,

                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'pilih_tahun' => $pilih_tahun,

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

    public function cari_home(Request $request)
    {
        $title = "home";
            $pilih_tahun =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');
            $pilih_durasi =  DB::select("SELECT KODE,VALUE_NUMBER,KET_NUMBER From DASHBOARDGRAFIK.V_SYSCODE WHERE KODE='WAKTU' order by ID");

            // menangkap data pencarian
            $durasi = $request->cari_durasi;
            $tahun_ini = $request->cari_tahun;
            $tahun_lalu = $request->cari_tahun-1;
            $bulan = $request->cari_bulan;

        //shipcall_gt
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
        //

        //arus domestik
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

        //arus international
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

        //arus total
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

        //market share domestik
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

        //market share international
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

        //market share total
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

        return view('home',
            [
                'title' => $title,
                'durasi' => $durasi,
                'pilih_durasi' => $pilih_durasi,

                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'pilih_tahun' => $pilih_tahun,
                
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

}
