<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V_produksi_pendapatan;
use App\Models\V_target_rkap_perbulan;
use DB;
use App\Models\DataModel;

class Arus_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function arus_kunjungan_kapal_domestik ()
    {
        $title = "arus_kunjungan_kapal_domestik";

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

        $data_kunjungan_kapal_domestik =  DB::select("SELECT a.tahun, a.bulan, a.shipcall shipcall_tahun_ini, a.gt gt_tahun_ini, a.lokasi, b.tahun tahun_lalu, b.shipcall shipcall_tahun_lalu, a.gt gt_tahun_lalu, a.shipcall - b.shipcall yoy, ROUND ( ( ( (a.shipcall - b.shipcall) /  a.shipcall) * 100), 1) trend,
            (SELECT TARGET_RKAP from V_TARGET_RKAP_PERBULAN I  where I.tahun=A.tahun AND I.bulan   =A.BULAN AND type='DOM' AND satuan='BOX') RKAP
            FROM (SELECT a.tahun, a.bulan, SUM (a.shipcall) shipcall, SUM (a.gt) gt, a.lokasi FROM v_produksi_pendapatan a 
                WHERE a.tahun = $tahun_ini AND a.bulan <= $bulan 
                GROUP BY a.tahun, a.bulan, a.lokasi) a,
            (SELECT a.tahun, a.bulan, SUM (a.shipcall) shipcall, SUM (a.gt) gt, a.lokasi FROM v_produksi_pendapatan a 
                WHERE a.tahun = $tahun_lalu AND a.bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi ='DOM'
            ORDER BY TAHUN,BULAN");

        $grafik_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
        ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
        foreach($grafik_tahun_lalu_query as $key => $value){
        $grafik_arus_kunjungan_kapal_domestik_tahun_lalu[] = (int)$value;
        }

        $grafik_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
        foreach($grafik_tahun_ini_query as $key => $value){
        $grafik_arus_kunjungan_kapal_domestik_tahun_ini[] = (int)$value;
        }

        $grafik_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'SHIPCALL') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
        foreach($grafik_rkap_query as $key => $value){
        $grafik_arus_kunjungan_kapal_domestik_rkap[] = (int)$value;
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('arus.kunjungan_kapal.domestik',$leftmenu)->with(compact('title','tahun_ini','tahun_lalu','bulan','tahun_grafik_kunjungan_kapal','data_kunjungan_kapal_domestik','grafik_arus_kunjungan_kapal_domestik_tahun_lalu','grafik_arus_kunjungan_kapal_domestik_tahun_ini','grafik_arus_kunjungan_kapal_domestik_rkap'));
    }

    public function cari_arus_kunjungan_kapal_domestik(Request $request)
    {
        $title = "arus_kunjungan_kapal_domestik";
        $tahun_grafik_kunjungan_kapal =  DB::select('SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');

        // menangkap data pencarian
        $bulan = $request->cari_bulan;
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;

        $data_kunjungan_kapal_domestik =  DB::select("SELECT a.tahun, a.bulan, a.shipcall shipcall_tahun_ini, a.gt gt_tahun_ini, a.lokasi, b.tahun tahun_lalu, b.shipcall shipcall_tahun_lalu, a.gt gt_tahun_lalu, a.shipcall - b.shipcall yoy, ROUND ((((a.shipcall - b.shipcall) / a.shipcall) * 100), 1) trend,
            (SELECT TARGET_RKAP from V_TARGET_RKAP_PERBULAN I  where I.tahun=A.tahun AND I.bulan   =A.BULAN AND type='DOM' AND satuan='BOX') RKAP
            FROM (SELECT a.tahun, a.bulan, SUM (a.shipcall) shipcall, SUM (a.gt) gt, a.lokasi FROM v_produksi_pendapatan a 
                WHERE a.tahun = $tahun_ini AND a.bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) a,
            (SELECT a.tahun, a.bulan, SUM (a.shipcall) shipcall, SUM (a.gt) gt, a.lokasi FROM v_produksi_pendapatan a 
                WHERE a.tahun = $tahun_lalu AND a.bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi ='DOM'
            ORDER BY TAHUN,BULAN");

        $grafik_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
        ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
        foreach($grafik_tahun_lalu_query as $key => $value){
        $grafik_arus_kunjungan_kapal_domestik_tahun_lalu[] = (int)$value;
        }

        $grafik_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
        foreach($grafik_tahun_ini_query as $key => $value){
        $grafik_arus_kunjungan_kapal_domestik_tahun_ini[] = (int)$value;
        }

        $grafik_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'SHIPCALL') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
        foreach($grafik_rkap_query as $key => $value){
        $grafik_arus_kunjungan_kapal_domestik_rkap[] = (int)$value;
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('arus.kunjungan_kapal.domestik',$leftmenu)->with(compact('title','tahun_ini','tahun_lalu','bulan','tahun_grafik_kunjungan_kapal','data_kunjungan_kapal_domestik','grafik_arus_kunjungan_kapal_domestik_tahun_lalu','grafik_arus_kunjungan_kapal_domestik_tahun_ini','grafik_arus_kunjungan_kapal_domestik_rkap'));
    }

    public function arus_kunjungan_kapal_international ()
    {
        $title = "arus_kunjungan_kapal_international";

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

        $data_kunjungan_kapal_international =  DB::select("SELECT a.tahun, a.bulan, a.shipcall shipcall_tahun_ini, a.gt gt_tahun_ini, a.lokasi, b.tahun tahun_lalu, b.shipcall shipcall_tahun_lalu, a.gt gt_tahun_lalu, a.shipcall - b.shipcall yoy, ROUND ((((a.shipcall - b.shipcall) / a.shipcall) * 100), 1) trend,
            (SELECT TARGET_RKAP from V_TARGET_RKAP_PERBULAN I  where I.tahun=A.tahun and I.bulan   =A.BULAN and type='INT' AND satuan='BOX') RKAP
            FROM (SELECT a.tahun, a.bulan, SUM (a.shipcall) shipcall, SUM (a.gt) gt, a.lokasi FROM v_produksi_pendapatan a 
                WHERE a.tahun = $tahun_ini AND a.bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) a,
            (SELECT a.tahun, a.bulan, SUM (a.shipcall) shipcall, SUM (a.gt) gt, a.lokasi FROM v_produksi_pendapatan a 
                WHERE a.tahun = $tahun_lalu AND a.bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi and a.lokasi ='INT'
            ORDER BY TAHUN,BULAN");

        $grafik_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
        ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
        foreach($grafik_tahun_lalu_query as $key => $value){
        $grafik_arus_kunjungan_kapal_international_tahun_lalu[] = (int)$value;
        }

        $grafik_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
        foreach($grafik_tahun_ini_query as $key => $value){
        $grafik_arus_kunjungan_kapal_international_tahun_ini[] = (int)$value;
        }

        $grafik_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'SHIPCALL') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
        foreach($grafik_rkap_query as $key => $value){
        $grafik_arus_kunjungan_kapal_international_rkap[] = (int)$value;
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('arus.kunjungan_kapal.international',$leftmenu)->with(compact('title','tahun_ini','tahun_lalu','bulan','tahun_grafik_kunjungan_kapal','data_kunjungan_kapal_international','grafik_arus_kunjungan_kapal_international_tahun_lalu','grafik_arus_kunjungan_kapal_international_tahun_ini','grafik_arus_kunjungan_kapal_international_rkap'));
    }

    public function cari_arus_kunjungan_kapal_international(Request $request)
    {
        $title = "arus_kunjungan_kapal_international";
        $tahun_grafik_kunjungan_kapal =  DB::select('SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');

        // menangkap data pencarian
        $bulan = $request->cari_bulan;
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;

        $data_kunjungan_kapal_international =  DB::select("SELECT a.tahun, a.bulan, a.shipcall shipcall_tahun_ini, a.gt gt_tahun_ini, a.lokasi, b.tahun tahun_lalu, b.shipcall shipcall_tahun_lalu, a.gt gt_tahun_lalu, a.shipcall - b.shipcall yoy, ROUND ((((a.shipcall - b.shipcall) / a.shipcall) * 100), 1) trend,
            (SELECT TARGET_RKAP from V_TARGET_RKAP_PERBULAN I  where I.tahun=A.tahun and I.bulan   =A.BULAN and type='INT' AND satuan='BOX') RKAP
            FROM (SELECT a.tahun, a.bulan, SUM (a.shipcall) shipcall, SUM (a.gt) gt, a.lokasi FROM v_produksi_pendapatan a 
                WHERE a.tahun = $tahun_ini AND a.bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) a,
            (SELECT a.tahun, a.bulan, SUM (a.shipcall) shipcall, SUM (a.gt) gt, a.lokasi FROM v_produksi_pendapatan a 
                WHERE a.tahun = $tahun_lalu AND a.bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi and a.lokasi ='INT'
            ORDER BY TAHUN,BULAN");

        $grafik_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
        ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
        foreach($grafik_tahun_lalu_query as $key => $value){
        $grafik_arus_kunjungan_kapal_international_tahun_lalu[] = (int)$value;
        }

        $grafik_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
        foreach($grafik_tahun_ini_query as $key => $value){
        $grafik_arus_kunjungan_kapal_international_tahun_ini[] = (int)$value;
        }

        $grafik_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'SHIPCALL') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
        foreach($grafik_rkap_query as $key => $value){
        $grafik_arus_kunjungan_kapal_international_rkap[] = (int)$value;
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('arus.kunjungan_kapal.international',$leftmenu)->with(compact('title','tahun_ini','tahun_lalu','bulan','tahun_grafik_kunjungan_kapal','data_kunjungan_kapal_international','grafik_arus_kunjungan_kapal_international_tahun_lalu','grafik_arus_kunjungan_kapal_international_tahun_ini','grafik_arus_kunjungan_kapal_international_rkap'));
    }

////////////////////////////////////////////////////////////////////

    public function arus_petikemas_domestik ()
    {
        $title = "arus_petikemas_domestik";
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

        $data_arus_petikemas_box_domestik = DB::select("SELECT a.lokasi,  a.tahun, a.bulan, a.box_import, a.box_export, a.total_box, b.box_import_thn_lalu, box_export_thn_lalu,  total_box_thn_lalu,  total_box - total_box_thn_lalu yoy_box,
            ROUND ( ( (total_box - total_box_thn_lalu) / total_box_thn_lalu) * 100, 1) trend_box,
            ( select target_rkap from v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='DOM' AND satuan='BOX') rkap
            FROM (  SELECT lokasi,  tahun, bulan,  SUM (jml_box_import) box_import, SUM (jml_box_export) box_export, SUM (jml_box_import) + SUM (jml_box_export) total_box
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) a,
            ( SELECT lokasi, tahun,  bulan, SUM (jml_box_import) box_import_thn_lalu, SUM (jml_box_export) box_export_thn_lalu, SUM (jml_box_import) + SUM (jml_box_export) total_box_thn_lalu
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_lalu AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='DOM'
            ORDER by bulan");

        $data_arus_petikemas_teus_domestik = DB::select("SELECT a.lokasi,  a.tahun, a.bulan, a.teus_import, a.teus_export, a.total_teus, b.teus_import_thn_lalu, teus_export_thn_lalu,  total_teus_thn_lalu,  total_teus - total_teus_thn_lalu yoy_teus,
            ROUND ( ( (total_teus - total_teus_thn_lalu) / total_teus_thn_lalu) * 100, 1) trend_teus,
            ( select target_rkap from v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='DOM' AND satuan='TEUS') rkap
            FROM (  SELECT lokasi,  tahun, bulan,  SUM (jml_teus_import) teus_import, SUM (jml_teus_export) teus_export, SUM (jml_teus_import) + SUM (jml_teus_export) total_teus
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) a,
            ( SELECT lokasi, tahun, bulan, SUM (jml_teus_import) teus_import_thn_lalu, SUM (jml_teus_export) teus_export_thn_lalu, SUM (jml_teus_import) + SUM (jml_teus_export) total_teus_thn_lalu
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_lalu AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='DOM'
            ORDER by bulan");

        $data_arus_petikemas_pendapatan_domestik = DB::select("SELECT a.tahun, a.bulan, a.total_pendapatan, a.lokasi, b.tahun tahun_lalu, b.total_pendapatan total_pendapatan_tahun_lalu, 
            a.total_pendapatan - b.total_pendapatan yoy, ROUND ( ( ( (a.total_pendapatan - b.total_pendapatan) / a.total_pendapatan) * 100), 1) trend,
            ( select target_rkap from DASHBOARDGRAFIK.v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='DOM' AND satuan='PENDAPATAN') rkap
            FROM (  SELECT a.tahun, a.bulan, SUM (a.total_pendapatan) total_pendapatan, a.lokasi
            FROM DASHBOARDGRAFIK.v_produksi_pendapatan a
            WHERE a.tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY a.tahun, a.bulan, a.lokasi) a,
                ( SELECT a.tahun, a.bulan, SUM (a.total_pendapatan) total_pendapatan, a.lokasi
                 FROM DASHBOARDGRAFIK.v_produksi_pendapatan a
                WHERE a.tahun = $tahun_lalu AND bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) b
                WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='DOM'
                ORDER BY bulan");

        ////////////// BOX /////////////////////
            $grafik_box_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_domestik_box_tahun_lalu[] = (int)$value;
            }
            
            $grafik_box_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_domestik_box_tahun_ini[] = (int)$value;
            }

            $grafik_box_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'BOX') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_box_rkap_query as $key => $value){
            $grafik_arus_petikemas_domestik_box_rkap[] = (int)$value;
            }

        ////////////// TEUS /////////////////////
            $grafik_teus_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_domestik_teus_tahun_lalu[] = (int)$value;
            }
            
            $grafik_teus_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_domestik_teus_tahun_ini[] = (int)$value;
            }

            $grafik_teus_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'TEUS') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_teus_rkap_query as $key => $value){
            $grafik_arus_petikemas_domestik_teus_rkap[] = (int)$value;
            }

        ////////////// PENDAPATAN /////////////////////
            $grafik_pendapatan_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_domestik_pendapatan_tahun_lalu[] = (int)$value;
            }

            $grafik_pendapatan_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_domestik_pendapatan_tahun_ini[] = (int)$value;
            }

            $grafik_pendapatan_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'PENDAPATAN') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_pendapatan_rkap_query as $key => $value){
            $grafik_arus_petikemas_domestik_pendapatan_rkap[] = (int)$value;
            }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('arus.petikemas.domestik',$leftmenu)->with(compact('title','tahun_ini','tahun_lalu','bulan','tahun_grafik_arus_petikemas','data_arus_petikemas_box_domestik','data_arus_petikemas_teus_domestik','data_arus_petikemas_pendapatan_domestik','grafik_arus_petikemas_domestik_box_tahun_lalu','grafik_arus_petikemas_domestik_box_tahun_ini','grafik_arus_petikemas_domestik_box_rkap','grafik_arus_petikemas_domestik_teus_tahun_lalu','grafik_arus_petikemas_domestik_teus_tahun_ini','grafik_arus_petikemas_domestik_teus_rkap','grafik_arus_petikemas_domestik_pendapatan_tahun_lalu','grafik_arus_petikemas_domestik_pendapatan_tahun_ini','grafik_arus_petikemas_domestik_pendapatan_rkap'));
    }

    public function cari_arus_petikemas_domestik(Request $request)
    {
        $title = "arus_petikemas_domestik";
        $tahun_grafik_arus_petikemas =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

        // menangkap data pencarian
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;
        $bulan = $request->cari_bulan;

        $data_arus_petikemas_box_domestik = DB::select("SELECT a.lokasi,  a.tahun, a.bulan, a.box_import, a.box_export, a.total_box, b.box_import_thn_lalu, box_export_thn_lalu,  total_box_thn_lalu,  total_box - total_box_thn_lalu yoy_box,
            ROUND ( ( (total_box - total_box_thn_lalu) / total_box_thn_lalu) * 100, 1) trend_box,
            ( select target_rkap from v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='DOM' AND satuan='BOX') rkap
            FROM (  SELECT lokasi,  tahun, bulan,  SUM (jml_box_import) box_import, SUM (jml_box_export) box_export, SUM (jml_box_import) + SUM (jml_box_export) total_box
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) a,
            ( SELECT lokasi, tahun,  bulan, SUM (jml_box_import) box_import_thn_lalu, SUM (jml_box_export) box_export_thn_lalu, SUM (jml_box_import) + SUM (jml_box_export) total_box_thn_lalu
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_lalu AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='DOM'
            ORDER by bulan");

        $data_arus_petikemas_teus_domestik = DB::select("SELECT a.lokasi,  a.tahun, a.bulan, a.teus_import, a.teus_export, a.total_teus, b.teus_import_thn_lalu, teus_export_thn_lalu,  total_teus_thn_lalu,  total_teus - total_teus_thn_lalu yoy_teus,
            ROUND ( ( (total_teus - total_teus_thn_lalu) / total_teus_thn_lalu) * 100, 1) trend_teus,
            ( select target_rkap from v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='DOM' AND satuan='TEUS') rkap
            FROM (  SELECT lokasi,  tahun, bulan,  SUM (jml_teus_import) teus_import, SUM (jml_teus_export) teus_export, SUM (jml_teus_import) + SUM (jml_teus_export) total_teus
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) a,
            ( SELECT lokasi, tahun, bulan, SUM (jml_teus_import) teus_import_thn_lalu, SUM (jml_teus_export) teus_export_thn_lalu, SUM (jml_teus_import) + SUM (jml_teus_export) total_teus_thn_lalu
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_lalu AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='DOM'
            ORDER by bulan");

        $data_arus_petikemas_pendapatan_domestik = DB::select("SELECT a.tahun, a.bulan, a.total_pendapatan, a.lokasi, b.tahun tahun_lalu, b.total_pendapatan total_pendapatan_tahun_lalu, 
            a.total_pendapatan - b.total_pendapatan yoy, ROUND ( ( ( (a.total_pendapatan - b.total_pendapatan) / a.total_pendapatan) * 100), 1) trend,
            ( select target_rkap from DASHBOARDGRAFIK.v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='DOM' AND satuan='PENDAPATAN') rkap
            FROM (  SELECT a.tahun, a.bulan, SUM (a.total_pendapatan) total_pendapatan, a.lokasi
            FROM DASHBOARDGRAFIK.v_produksi_pendapatan a
            WHERE a.tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY a.tahun, a.bulan, a.lokasi) a,
                ( SELECT a.tahun, a.bulan, SUM (a.total_pendapatan) total_pendapatan, a.lokasi
                 FROM DASHBOARDGRAFIK.v_produksi_pendapatan a
                WHERE a.tahun = $tahun_lalu AND bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) b
                WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='DOM'
                ORDER BY bulan");

        ////////////// BOX /////////////////////
            $grafik_box_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_domestik_box_tahun_lalu[] = (int)$value;
            }
            
            $grafik_box_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_domestik_box_tahun_ini[] = (int)$value;
            }

            $grafik_box_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'BOX') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_box_rkap_query as $key => $value){
            $grafik_arus_petikemas_domestik_box_rkap[] = (int)$value;
            }

        ////////////// TEUS /////////////////////
            $grafik_teus_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_domestik_teus_tahun_lalu[] = (int)$value;
            }
            
            $grafik_teus_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_domestik_teus_tahun_ini[] = (int)$value;
            }

            $grafik_teus_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'TEUS') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_teus_rkap_query as $key => $value){
            $grafik_arus_petikemas_domestik_teus_rkap[] = (int)$value;
            }

        ////////////// PENDAPATAN /////////////////////
            $grafik_pendapatan_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_domestik_pendapatan_tahun_lalu[] = (int)$value;
            }

            $grafik_pendapatan_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_domestik_pendapatan_tahun_ini[] = (int)$value;
            }

            $grafik_pendapatan_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'PENDAPATAN') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_pendapatan_rkap_query as $key => $value){
            $grafik_arus_petikemas_domestik_pendapatan_rkap[] = (int)$value;
            }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('arus.petikemas.domestik',$leftmenu)->with(compact('title','tahun_ini','tahun_lalu','bulan','tahun_grafik_arus_petikemas','data_arus_petikemas_box_domestik','data_arus_petikemas_teus_domestik','data_arus_petikemas_pendapatan_domestik','grafik_arus_petikemas_domestik_box_tahun_lalu','grafik_arus_petikemas_domestik_box_tahun_ini','grafik_arus_petikemas_domestik_box_rkap','grafik_arus_petikemas_domestik_teus_tahun_lalu','grafik_arus_petikemas_domestik_teus_tahun_ini','grafik_arus_petikemas_domestik_teus_rkap','grafik_arus_petikemas_domestik_pendapatan_tahun_lalu','grafik_arus_petikemas_domestik_pendapatan_tahun_ini','grafik_arus_petikemas_domestik_pendapatan_rkap'));
    }

    public function arus_petikemas_international ()
    {
        $title = "arus_petikemas_international";
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

        $data_arus_petikemas_box_international = DB::select("SELECT a.lokasi,  a.tahun, a.bulan, a.box_import, a.box_export, a.total_box, b.box_import_thn_lalu, box_export_thn_lalu,  total_box_thn_lalu,  total_box - total_box_thn_lalu yoy_box,
            ROUND ( ( (total_box - total_box_thn_lalu) / total_box_thn_lalu) * 100, 1) trend_box,
            ( select target_rkap from v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='INT' AND satuan='BOX') rkap
            FROM (  SELECT lokasi,  tahun, bulan,  SUM (jml_box_import) box_import, SUM (jml_box_export) box_export, SUM (jml_box_import) + SUM (jml_box_export) total_box
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) a,
            ( SELECT lokasi, tahun,  bulan, SUM (jml_box_import) box_import_thn_lalu, SUM (jml_box_export) box_export_thn_lalu, SUM (jml_box_import) + SUM (jml_box_export) total_box_thn_lalu
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_lalu AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='INT'
            ORDER by bulan");

        $data_arus_petikemas_teus_international = DB::select("SELECT a.lokasi,  a.tahun, a.bulan, a.teus_import, a.teus_export, a.total_teus, b.teus_import_thn_lalu, teus_export_thn_lalu,  total_teus_thn_lalu,  total_teus - total_teus_thn_lalu yoy_teus,
            ROUND ( ( (total_teus - total_teus_thn_lalu) / total_teus_thn_lalu) * 100, 1) trend_teus,
            ( select target_rkap from v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='INT' AND satuan='TEUS') rkap
            FROM (  SELECT lokasi,  tahun, bulan,  SUM (jml_teus_import) teus_import, SUM (jml_teus_export) teus_export, SUM (jml_teus_import) + SUM (jml_teus_export) total_teus
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) a,
            ( SELECT lokasi, tahun, bulan, SUM (jml_teus_import) teus_import_thn_lalu, SUM (jml_teus_export) teus_export_thn_lalu, SUM (jml_teus_import) + SUM (jml_teus_export) total_teus_thn_lalu
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_lalu AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='INT'
            ORDER by bulan");

        $data_arus_petikemas_pendapatan_international = DB::select("SELECT a.tahun, a.bulan, a.total_pendapatan, a.lokasi, b.tahun tahun_lalu, b.total_pendapatan total_pendapatan_tahun_lalu, 
            a.total_pendapatan - b.total_pendapatan yoy, ROUND ( ( ( (a.total_pendapatan - b.total_pendapatan) / a.total_pendapatan) * 100), 1) trend,
            ( select target_rkap from DASHBOARDGRAFIK.v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='INT' AND satuan='PENDAPATAN') rkap
            FROM (  SELECT a.tahun, a.bulan, SUM (a.total_pendapatan) total_pendapatan, a.lokasi
            FROM DASHBOARDGRAFIK.v_produksi_pendapatan a
            WHERE a.tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY a.tahun, a.bulan, a.lokasi) a,
                ( SELECT a.tahun, a.bulan, SUM (a.total_pendapatan) total_pendapatan, a.lokasi
                 FROM DASHBOARDGRAFIK.v_produksi_pendapatan a
                WHERE a.tahun = $tahun_lalu AND bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) b
                WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='INT'
                ORDER BY bulan");

        ////////////// BOX /////////////////////
            $grafik_box_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_international_box_tahun_lalu[] = (int)$value;
            }
            
            $grafik_box_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_international_box_tahun_ini[] = (int)$value;
            }

            $grafik_box_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'BOX') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_box_rkap_query as $key => $value){
            $grafik_arus_petikemas_international_box_rkap[] = (int)$value;
            }

        ////////////// TEUS /////////////////////
            $grafik_teus_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_international_teus_tahun_lalu[] = (int)$value;
            }
            
            $grafik_teus_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_international_teus_tahun_ini[] = (int)$value;
            }

            $grafik_teus_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'TEUS') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_teus_rkap_query as $key => $value){
            $grafik_arus_petikemas_international_teus_rkap[] = (int)$value;
            }

        ////////////// PENDAPATAN /////////////////////
            $grafik_pendapatan_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_international_pendapatan_tahun_lalu[] = (int)$value;
            }

            $grafik_pendapatan_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_international_pendapatan_tahun_ini[] = (int)$value;
            }

            $grafik_pendapatan_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'PENDAPATAN') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_pendapatan_rkap_query as $key => $value){
            $grafik_arus_petikemas_international_pendapatan_rkap[] = (int)$value;
            }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('arus.petikemas.international',$leftmenu)->with(compact('title','tahun_ini','tahun_lalu','bulan','tahun_grafik_arus_petikemas','data_arus_petikemas_box_international','data_arus_petikemas_teus_international','data_arus_petikemas_pendapatan_international','grafik_arus_petikemas_international_box_tahun_lalu','grafik_arus_petikemas_international_box_tahun_ini','grafik_arus_petikemas_international_box_rkap','grafik_arus_petikemas_international_teus_tahun_lalu','grafik_arus_petikemas_international_teus_tahun_ini','grafik_arus_petikemas_international_teus_rkap','grafik_arus_petikemas_international_pendapatan_tahun_lalu','grafik_arus_petikemas_international_pendapatan_tahun_ini','grafik_arus_petikemas_international_pendapatan_rkap'));
    }

    public function cari_arus_petikemas_international(Request $request)
    {
        $title = "arus_petikemas_international";
        $tahun_grafik_arus_petikemas =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

        // menangkap data pencarian
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;
        $bulan = $request->cari_bulan;

        $data_arus_petikemas_box_international = DB::select("SELECT a.lokasi,  a.tahun, a.bulan, a.box_import, a.box_export, a.total_box, b.box_import_thn_lalu, box_export_thn_lalu,  total_box_thn_lalu,  total_box - total_box_thn_lalu yoy_box,
            ROUND ( ( (total_box - total_box_thn_lalu) / total_box_thn_lalu) * 100, 1) trend_box,
            ( select target_rkap from v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='INT' AND satuan='BOX') rkap
            FROM (  SELECT lokasi,  tahun, bulan,  SUM (jml_box_import) box_import, SUM (jml_box_export) box_export, SUM (jml_box_import) + SUM (jml_box_export) total_box
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) a,
            ( SELECT lokasi, tahun,  bulan, SUM (jml_box_import) box_import_thn_lalu, SUM (jml_box_export) box_export_thn_lalu, SUM (jml_box_import) + SUM (jml_box_export) total_box_thn_lalu
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_lalu AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='INT'
            ORDER by bulan");

        $data_arus_petikemas_teus_international = DB::select("SELECT a.lokasi,  a.tahun, a.bulan, a.teus_import, a.teus_export, a.total_teus, b.teus_import_thn_lalu, teus_export_thn_lalu,  total_teus_thn_lalu,  total_teus - total_teus_thn_lalu yoy_teus,
            ROUND ( ( (total_teus - total_teus_thn_lalu) / total_teus_thn_lalu) * 100, 1) trend_teus,
            ( select target_rkap from v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='INT' AND satuan='TEUS') rkap
            FROM (  SELECT lokasi,  tahun, bulan,  SUM (jml_teus_import) teus_import, SUM (jml_teus_export) teus_export, SUM (jml_teus_import) + SUM (jml_teus_export) total_teus
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) a,
            ( SELECT lokasi, tahun, bulan, SUM (jml_teus_import) teus_import_thn_lalu, SUM (jml_teus_export) teus_export_thn_lalu, SUM (jml_teus_import) + SUM (jml_teus_export) total_teus_thn_lalu
            FROM v_produksi_pendapatan
            WHERE tahun = $tahun_lalu AND bulan <= $bulan
            GROUP BY lokasi, tahun, bulan) b
            WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='INT'
            ORDER by bulan");

        $data_arus_petikemas_pendapatan_international = DB::select("SELECT a.tahun, a.bulan, a.total_pendapatan, a.lokasi, b.tahun tahun_lalu, b.total_pendapatan total_pendapatan_tahun_lalu, 
            a.total_pendapatan - b.total_pendapatan yoy, ROUND ( ( ( (a.total_pendapatan - b.total_pendapatan) / a.total_pendapatan) * 100), 1) trend,
            ( select target_rkap from DASHBOARDGRAFIK.v_target_rkap_perbulan c  where c.tahun=a.tahun AND c.bulan=a.bulan AND type='INT' AND satuan='PENDAPATAN') rkap
            FROM (  SELECT a.tahun, a.bulan, SUM (a.total_pendapatan) total_pendapatan, a.lokasi
            FROM DASHBOARDGRAFIK.v_produksi_pendapatan a
            WHERE a.tahun = $tahun_ini AND bulan <= $bulan
            GROUP BY a.tahun, a.bulan, a.lokasi) a,
                ( SELECT a.tahun, a.bulan, SUM (a.total_pendapatan) total_pendapatan, a.lokasi
                 FROM DASHBOARDGRAFIK.v_produksi_pendapatan a
                WHERE a.tahun = $tahun_lalu AND bulan <= $bulan
                GROUP BY a.tahun, a.bulan, a.lokasi) b
                WHERE a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.lokasi='INT'
                ORDER BY bulan");

        ////////////// BOX /////////////////////
            $grafik_box_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_international_box_tahun_lalu[] = (int)$value;
            }
            
            $grafik_box_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_international_box_tahun_ini[] = (int)$value;
            }

            $grafik_box_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'BOX') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_box_rkap_query as $key => $value){
            $grafik_arus_petikemas_international_box_rkap[] = (int)$value;
            }

        ////////////// TEUS /////////////////////
            $grafik_teus_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_international_teus_tahun_lalu[] = (int)$value;
            }
            
            $grafik_teus_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_international_teus_tahun_ini[] = (int)$value;
            }

            $grafik_teus_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'TEUS') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_teus_rkap_query as $key => $value){
            $grafik_arus_petikemas_international_teus_rkap[] = (int)$value;
            }

        ////////////// PENDAPATAN /////////////////////
            $grafik_pendapatan_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_lalu_query as $key => $value){
            $grafik_arus_petikemas_international_pendapatan_tahun_lalu[] = (int)$value;
            }

            $grafik_pendapatan_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_ini_query as $key => $value){
            $grafik_arus_petikemas_international_pendapatan_tahun_ini[] = (int)$value;
            }

            $grafik_pendapatan_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'PENDAPATAN') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_pendapatan_rkap_query as $key => $value){
            $grafik_arus_petikemas_international_pendapatan_rkap[] = (int)$value;
            }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('arus.petikemas.international',$leftmenu)->with(compact('title','tahun_ini','tahun_lalu','bulan','tahun_grafik_arus_petikemas','data_arus_petikemas_box_international','data_arus_petikemas_teus_international','data_arus_petikemas_pendapatan_international','grafik_arus_petikemas_international_box_tahun_lalu','grafik_arus_petikemas_international_box_tahun_ini','grafik_arus_petikemas_international_box_rkap','grafik_arus_petikemas_international_teus_tahun_lalu','grafik_arus_petikemas_international_teus_tahun_ini','grafik_arus_petikemas_international_teus_rkap','grafik_arus_petikemas_international_pendapatan_tahun_lalu','grafik_arus_petikemas_international_pendapatan_tahun_ini','grafik_arus_petikemas_international_pendapatan_rkap'));
    }

}
