<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V_produksi_pendapatan;
use App\Models\V_produksi_pendapatan_customer;
use DB;

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

        $data_kunjungan_kapal_domestik =  DB::select("SELECT a.lokasi, a.tahun, a.bulan, SUM (a.shipcall) shipcall_tahun_ini, SUM (b.shipcall) shipcall_tahun_lalu, ROUND (( ((SUM (a.shipcall) - SUM (b.shipcall)) / SUM (a.shipcall))  * 100), 1) YOY, c.target_rkap
            FROM DASHBOARDGRAFIK.v_produksi_pendapatan a, DASHBOARDGRAFIK.v_produksi_pendapatan b, DASHBOARDGRAFIK.v_target_rkap_perbulan c
            WHERE a.tahun = $tahun_ini AND b.tahun = $tahun_lalu AND a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.tahun = c.tahun AND a.bulan = c.bulan AND a.tahun=$tahun_ini AND a.bulan<=$bulan AND a.lokasi='DOM'
            GROUP BY a.tahun, a.bulan, a.lokasi,  b.tahun, target_rkap ORDER BY a.bulan");

        return view('arus.kunjungan_kapal.domestik',
            [
            'title' => $title,
            'tahun_grafik_kunjungan_kapal' => $tahun_grafik_kunjungan_kapal,
            'tahun_ini' => $tahun_ini,
            'tahun_lalu' => $tahun_lalu,
            'bulan' => $bulan,
            'data_kunjungan_kapal_domestik' => $data_kunjungan_kapal_domestik,
        ]);
    }

    public function cari_arus_kunjungan_kapal_domestik(Request $request)
    {
        $title = "arus_kunjungan_kapal_domestik";
        $tahun_grafik_kunjungan_kapal =  DB::select('SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');

            // menangkap data pencarian
        $bulan = $request->cari_bulan;
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;

        $data_kunjungan_kapal_domestik =  DB::select("SELECT a.lokasi, a.tahun, a.bulan, SUM (a.shipcall) shipcall_tahun_ini, SUM (b.shipcall) shipcall_tahun_lalu, ROUND (( ((SUM (a.shipcall) - SUM (b.shipcall)) / SUM (a.shipcall))  * 100), 1) YOY, c.target_rkap
            FROM DASHBOARDGRAFIK.v_produksi_pendapatan a, DASHBOARDGRAFIK.v_produksi_pendapatan b, DASHBOARDGRAFIK.v_target_rkap_perbulan c
            WHERE a.tahun = $tahun_ini AND b.tahun = $tahun_lalu AND a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.tahun = c.tahun AND a.bulan = c.bulan AND a.tahun=$tahun_ini AND a.bulan<=$bulan AND a.lokasi='DOM'
            GROUP BY a.tahun, a.bulan, a.lokasi,  b.tahun, target_rkap ORDER BY a.bulan");

        return view('arus.kunjungan_kapal.domestik',
            [
                'title' => $title,
                'tahun_grafik_kunjungan_kapal' => $tahun_grafik_kunjungan_kapal,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'data_kunjungan_kapal_domestik' => $data_kunjungan_kapal_domestik,
            ]);
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

        $data_kunjungan_kapal_international =  DB::select("SELECT a.lokasi, a.tahun, a.bulan, SUM (a.shipcall) shipcall_tahun_ini, SUM (b.shipcall) shipcall_tahun_lalu, ROUND (( ((SUM (a.shipcall) - SUM (b.shipcall)) / SUM (a.shipcall))  * 100), 1) YOY, c.target_rkap
            FROM DASHBOARDGRAFIK.v_produksi_pendapatan a, DASHBOARDGRAFIK.v_produksi_pendapatan b, DASHBOARDGRAFIK.v_target_rkap_perbulan c
            WHERE a.tahun = TO_CHAR (SYSDATE, 'yyyy') AND b.tahun = TO_CHAR (SYSDATE, 'yyyy') - 1 AND a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.tahun = c.tahun AND a.bulan = c.bulan AND a.tahun=$tahun_ini AND a.bulan<=$bulan AND a.lokasi='INT'
            GROUP BY a.tahun, a.bulan, a.lokasi,  b.tahun, target_rkap ORDER BY a.bulan");



        return view('arus.kunjungan_kapal.international',
            [
            'title' => $title,
            'tahun_grafik_kunjungan_kapal' => $tahun_grafik_kunjungan_kapal,
            'tahun_ini' => $tahun_ini,
            'tahun_lalu' => $tahun_lalu,
            'bulan' => $bulan,
            'data_kunjungan_kapal_international' => $data_kunjungan_kapal_international,
        ]);
    }

    public function cari_arus_kunjungan_kapal_international(Request $request)
    {
        $title = "arus_kunjungan_kapal_international";
        $tahun_grafik_kunjungan_kapal =  DB::select('SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC');

            // menangkap data pencarian
        $bulan = $request->cari_bulan;
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;

        $data_kunjungan_kapal_international =  DB::select("SELECT a.lokasi, a.tahun, a.bulan, SUM (a.shipcall) shipcall_tahun_ini, SUM (b.shipcall) shipcall_tahun_lalu, ROUND (( ((SUM (a.shipcall) - SUM (b.shipcall)) / SUM (a.shipcall))  * 100), 1) YOY, c.target_rkap
            FROM DASHBOARDGRAFIK.v_produksi_pendapatan a, DASHBOARDGRAFIK.v_produksi_pendapatan b, DASHBOARDGRAFIK.v_target_rkap_perbulan c
            WHERE a.tahun = $tahun_ini AND b.tahun = $tahun_lalu AND a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.tahun = c.tahun AND a.bulan = c.bulan AND a.tahun=$tahun_ini AND a.bulan<=$bulan AND a.lokasi='INT'
            GROUP BY a.tahun, a.bulan, a.lokasi,  b.tahun, target_rkap ORDER BY a.bulan");

        return view('arus.kunjungan_kapal.international',
            [
                'title' => $title,
                'tahun_grafik_kunjungan_kapal' => $tahun_grafik_kunjungan_kapal,
                'bulan' => $bulan,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'data_kunjungan_kapal_international' => $data_kunjungan_kapal_international,
            ]);
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

        $data_arus_petikemas_box_domestik = DB::select("SELECT a.lokasi, a.tahun, a.bulan, sum(a.jml_box_import)jml_box_import, sum(a.jml_box_export)jml_box_export,
            sum(a.jml_box_import + a.jml_box_export) as jml_box_tahun_ini, sum(b.jml_box_import + b.jml_box_export) as jml_box_tahun_lalu,
            ROUND (( ((SUM (a.jml_box_import + a.jml_box_export) - SUM (b.jml_box_import + a.jml_box_export)) / SUM (a.jml_box_import + a.jml_box_export))  * 100), 1) YOY, c.target_rkap
            FROM DASHBOARDGRAFIK.v_produksi_pendapatan a, DASHBOARDGRAFIK.v_produksi_pendapatan b, DASHBOARDGRAFIK.v_target_rkap_perbulan c
            WHERE a.tahun = $tahun_ini AND b.tahun = $tahun_lalu AND a.bulan = b.bulan AND a.lokasi = b.lokasi AND a.tahun = c.tahun AND a.bulan = c.bulan
            AND a.tahun=$tahun_ini and a.bulan<=$bulan and a.lokasi='DOM'
            group by a.tahun, a.bulan, a.lokasi, c.target_rkap  order by a.tahun, a.bulan");

        $data_arus_petikemas_teus_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_teus_import)  jml_teus_import, sum(jml_teus_export) jml_teus_export, sum(jml_teus_import+jml_teus_export) jml_teus
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='TEUS' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_pendapatan_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(total_pendapatan) total_pendapatan
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='PENDAPATAN' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        return view('arus.petikemas.domestik',
            [
                'title' => $title,
                'tahun_grafik_arus_petikemas' => $tahun_grafik_arus_petikemas,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'data_arus_petikemas_box_domestik' => $data_arus_petikemas_box_domestik,
                'data_arus_petikemas_teus_domestik' => $data_arus_petikemas_teus_domestik,
                'data_arus_petikemas_pendapatan_domestik' => $data_arus_petikemas_pendapatan_domestik,
            ]);
    }

    public function cari_arus_petikemas_domestik(Request $request)
    {
        $title = "arus_petikemas_domestik";
        $tahun_grafik_arus_petikemas =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

        // menangkap data pencarian
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;
        $bulan = $request->cari_bulan;

        $data_arus_petikemas_box_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_box_import)  jml_box_import, sum(jml_box_export) jml_box_export, sum(jml_box_import+jml_box_export) jml_box
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='BOX' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_teus_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_teus_import)  jml_teus_import, sum(jml_teus_export) jml_teus_export, sum(jml_teus_import+jml_teus_export) jml_teus
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='TEUS' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_pendapatan_domestik = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(total_pendapatan) total_pendapatan
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='PENDAPATAN' and type='DOM' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        return view('arus.petikemas.domestik',
            [
                'title' => $title,
                'tahun_grafik_arus_petikemas' => $tahun_grafik_arus_petikemas,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'data_arus_petikemas_box_domestik' => $data_arus_petikemas_box_domestik,
                'data_arus_petikemas_teus_domestik' => $data_arus_petikemas_teus_domestik,
                'data_arus_petikemas_pendapatan_domestik' => $data_arus_petikemas_pendapatan_domestik,
            ]);
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

        $data_arus_petikemas_box_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_box_import)  jml_box_import, sum(jml_box_export) jml_box_export, sum(jml_box_import+jml_box_export) jml_box
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='BOX' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_teus_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_teus_import)  jml_teus_import, sum(jml_teus_export) jml_teus_export, sum(jml_teus_import+jml_teus_export) jml_teus
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='TEUS' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_pendapatan_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(total_pendapatan) total_pendapatan
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='PENDAPATAN' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        return view('arus.petikemas.international',
            [
                'title' => $title,
                'tahun_grafik_arus_petikemas' => $tahun_grafik_arus_petikemas,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'data_arus_petikemas_box_international' => $data_arus_petikemas_box_international,
                'data_arus_petikemas_teus_international' => $data_arus_petikemas_teus_international,
                'data_arus_petikemas_pendapatan_international' => $data_arus_petikemas_pendapatan_international,
            ]);
    }

    public function cari_arus_petikemas_international(Request $request)
    {
        $title = "arus_petikemas_international";
        $tahun_grafik_arus_petikemas =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

        // menangkap data pencarian
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;
        $bulan = $request->cari_bulan;

        $data_arus_petikemas_box_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_box_import)  jml_box_import, sum(jml_box_export) jml_box_export, sum(jml_box_import+jml_box_export) jml_box
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='BOX' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_teus_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(jml_teus_import)  jml_teus_import, sum(jml_teus_export) jml_teus_export, sum(jml_teus_import+jml_teus_export) jml_teus
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='TEUS' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        $data_arus_petikemas_pendapatan_international = DB::select("SELECT A.target_rkap, A.tahun, A.bulan, type, satuan, sum(total_pendapatan) total_pendapatan
            FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN A join DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN B on A.tahun=B.tahun and A.bulan=B.bulan and A.type=B.lokasi
            WHERE A.tahun=$tahun_ini and A.bulan<=$bulan and satuan='PENDAPATAN' and type='INT' group by A.target_rkap, A.tahun, A.bulan, type, satuan order by A.bulan");

        return view('arus.petikemas.international',
            [
                'title' => $title,
                'tahun_grafik_arus_petikemas' => $tahun_grafik_arus_petikemas,
                'tahun_ini' => $tahun_ini,
                'tahun_lalu' => $tahun_lalu,
                'bulan' => $bulan,
                'data_arus_petikemas_box_international' => $data_arus_petikemas_box_international,
                'data_arus_petikemas_teus_international' => $data_arus_petikemas_teus_international,
                'data_arus_petikemas_pendapatan_international' => $data_arus_petikemas_pendapatan_international,
            ]);
    }

}
