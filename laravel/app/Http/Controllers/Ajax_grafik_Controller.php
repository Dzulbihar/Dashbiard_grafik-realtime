<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\V_produksi_pendapatan;
use App\Models\V_produksi_pendapatan_cus;
use App\Models\V_target_rkap_perbulan;
use DB;
use Carbon\Carbon;
use App\Models\DataModel;

class Ajax_grafik_Controller extends Controller
{   
    public function arus_kunjungan_kapal_domestik()
    {
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
        
        ////////////// arus_kunjungan_kapal_domestik //////////////
            $grafik_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
            foreach($grafik_tahun_lalu_query as $key => $value){
            $grafik_kunjungan_kapal_domestik_tahun_lalu[] = (int)$value;
            }

            $grafik_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
            foreach($grafik_tahun_ini_query as $key => $value){
            $grafik_kunjungan_kapal_domestik_tahun_ini[] = (int)$value;
            }

            $grafik_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'SHIPCALL') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_rkap_query as $key => $value){
            $grafik_kunjungan_kapal_domestik_rkap[] = (int)$value;
            }

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_kunjungan_kapal_domestik_tahun_lalu' => $grafik_kunjungan_kapal_domestik_tahun_lalu,'grafik_kunjungan_kapal_domestik_tahun_ini' => $grafik_kunjungan_kapal_domestik_tahun_ini,'grafik_kunjungan_kapal_domestik_rkap' => $grafik_kunjungan_kapal_domestik_rkap
        ]);
    }

    public function arus_kunjungan_kapal_international()
    {
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
        
        ////////////// arus_kunjungan_kapal_international //////////////
            $grafik_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
            foreach($grafik_tahun_lalu_query as $key => $value){
            $grafik_kunjungan_kapal_international_tahun_lalu[] = (int)$value;
            }

            $grafik_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
            foreach($grafik_tahun_ini_query as $key => $value){
            $grafik_kunjungan_kapal_international_tahun_ini[] = (int)$value;
            }

            $grafik_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'SHIPCALL') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_rkap_query as $key => $value){
            $grafik_kunjungan_kapal_international_rkap[] = (int)$value;
            }

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_kunjungan_kapal_international_tahun_lalu' => $grafik_kunjungan_kapal_international_tahun_lalu,'grafik_kunjungan_kapal_international_tahun_ini' => $grafik_kunjungan_kapal_international_tahun_ini,'grafik_kunjungan_kapal_international_rkap' => $grafik_kunjungan_kapal_international_rkap
        ]);
    }

    public function arus_petikemas_domestik_box()
    {
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
        
        ////////////// arus_petikemas_domestik_box //////////////
            $grafik_box_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_lalu_query as $key => $value){
            $grafik_petikemas_domestik_box_tahun_lalu[] = (int)$value;
            }
                
            $grafik_box_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_ini_query as $key => $value){
            $grafik_petikemas_domestik_box_tahun_ini[] = (int)$value;
            }

            $grafik_box_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'BOX') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_box_rkap_query as $key => $value){
            $grafik_petikemas_domestik_box_rkap[] = (int)$value;
            }            $grafik_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
            foreach($grafik_tahun_lalu_query as $key => $value){
            $grafik_kunjungan_kapal_international_tahun_lalu[] = (int)$value;
            }

            $grafik_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(shipcall) AS shipcall,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('shipcall');
            foreach($grafik_tahun_ini_query as $key => $value){
            $grafik_kunjungan_kapal_international_tahun_ini[] = (int)$value;
            }

            $grafik_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'SHIPCALL') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_rkap_query as $key => $value){
            $grafik_kunjungan_kapal_international_rkap[] = (int)$value;
            }

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_petikemas_domestik_box_tahun_lalu' => $grafik_petikemas_domestik_box_tahun_lalu,'grafik_petikemas_domestik_box_tahun_ini' => $grafik_petikemas_domestik_box_tahun_ini,'grafik_petikemas_domestik_box_rkap' => $grafik_petikemas_domestik_box_rkap
        ]);
    }

    public function arus_petikemas_domestik_teus()
    {
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
        
        ////////////// arus_petikemas_domestik_teus //////////////
            $grafik_teus_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_lalu_query as $key => $value){
            $grafik_petikemas_domestik_teus_tahun_lalu[] = (int)$value;
            }
                
            $grafik_teus_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_ini_query as $key => $value){
            $grafik_petikemas_domestik_teus_tahun_ini[] = (int)$value;
            }

            $grafik_teus_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'TEUS') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_teus_rkap_query as $key => $value){
            $grafik_petikemas_domestik_teus_rkap[] = (int)$value;
            }

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_petikemas_domestik_teus_tahun_lalu' => $grafik_petikemas_domestik_teus_tahun_lalu,'grafik_petikemas_domestik_teus_tahun_ini' => $grafik_petikemas_domestik_teus_tahun_ini,'grafik_petikemas_domestik_teus_rkap' => $grafik_petikemas_domestik_teus_rkap
        ]);
    }

    public function arus_petikemas_domestik_pendapatan()
    {
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
        
        ////////////// arus_petikemas_domestik_pendapatan //////////////
            $grafik_pendapatan_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_lalu_query as $key => $value){
            $grafik_petikemas_domestik_pendapatan_tahun_lalu[] = (int)$value;
            }

            $grafik_pendapatan_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_ini_query as $key => $value){
            $grafik_petikemas_domestik_pendapatan_tahun_ini[] = (int)$value;
            }

            $grafik_pendapatan_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'DOM') ->where('satuan', 'PENDAPATAN') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_pendapatan_rkap_query as $key => $value){
            $grafik_petikemas_domestik_pendapatan_rkap[] = (int)$value;
            }

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_petikemas_domestik_pendapatan_tahun_lalu' => $grafik_petikemas_domestik_pendapatan_tahun_lalu,'grafik_petikemas_domestik_pendapatan_tahun_ini' => $grafik_petikemas_domestik_pendapatan_tahun_ini,'grafik_petikemas_domestik_pendapatan_rkap' => $grafik_petikemas_domestik_pendapatan_rkap
        ]);
    }

    public function arus_petikemas_international_box()
    {
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
        
        ////////////// arus_petikemas_international_box //////////////
            $grafik_box_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_lalu_query as $key => $value){
            $grafik_petikemas_international_box_tahun_lalu[] = (int)$value;
            }
                
            $grafik_box_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_box_import+jml_box_export) AS jml_box,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_box');
            foreach($grafik_box_tahun_ini_query as $key => $value){
            $grafik_petikemas_international_box_tahun_ini[] = (int)$value;
            }

            $grafik_box_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'BOX') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_box_rkap_query as $key => $value){
            $grafik_petikemas_international_box_rkap[] = (int)$value;
            }

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_petikemas_international_box_tahun_lalu' => $grafik_petikemas_international_box_tahun_lalu,'grafik_petikemas_international_box_tahun_ini' => $grafik_petikemas_international_box_tahun_ini,'grafik_petikemas_international_box_rkap' => $grafik_petikemas_international_box_rkap
        ]);
    }

    public function arus_petikemas_international_teus()
    {
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
        
        ////////////// arus_petikemas_international_teus //////////////
            $grafik_teus_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_lalu_query as $key => $value){
            $grafik_petikemas_international_teus_tahun_lalu[] = (int)$value;
            }
                
            $grafik_teus_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(jml_teus_import+jml_teus_export) AS jml_teus,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('jml_teus');
            foreach($grafik_teus_tahun_ini_query as $key => $value){
            $grafik_petikemas_international_teus_tahun_ini[] = (int)$value;
            }

            $grafik_teus_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'TEUS') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_teus_rkap_query as $key => $value){
            $grafik_petikemas_international_teus_rkap[] = (int)$value;
            }

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_petikemas_international_teus_tahun_lalu' => $grafik_petikemas_international_teus_tahun_lalu,'grafik_petikemas_international_teus_tahun_ini' => $grafik_petikemas_international_teus_tahun_ini,'grafik_petikemas_international_teus_rkap' => $grafik_petikemas_international_teus_rkap
        ]);
    }

    public function arus_petikemas_international_pendapatan()
    {
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
        
        ////////////// arus_petikemas_international_pendapatan //////////////
            $grafik_pendapatan_tahun_lalu_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_lalu) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_lalu_query as $key => $value){
            $grafik_petikemas_international_pendapatan_tahun_lalu[] = (int)$value;
            }

            $grafik_pendapatan_tahun_ini_query = V_produksi_pendapatan::select(\DB::raw("SUM(total_pendapatan) AS total_pendapatan,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('bulan')) ->orderBy(\DB::raw('bulan')) ->pluck('total_pendapatan');
            foreach($grafik_pendapatan_tahun_ini_query as $key => $value){
            $grafik_petikemas_international_pendapatan_tahun_ini[] = (int)$value;
            }

            $grafik_pendapatan_rkap_query = V_target_rkap_perbulan::select(\DB::raw("target_rkap,bulan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('type', 'INT') ->where('satuan', 'PENDAPATAN') ->orderBy(\DB::raw('bulan')) ->pluck('target_rkap');
            foreach($grafik_pendapatan_rkap_query as $key => $value){
            $grafik_petikemas_international_pendapatan_rkap[] = (int)$value;
            }

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_petikemas_international_pendapatan_tahun_lalu' => $grafik_petikemas_international_pendapatan_tahun_lalu,'grafik_petikemas_international_pendapatan_tahun_ini' => $grafik_petikemas_international_pendapatan_tahun_ini,'grafik_petikemas_international_pendapatan_rkap' => $grafik_petikemas_international_pendapatan_rkap
        ]);
    }

    public function bin_pel_market_share_domestik_box()
    {
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
        
        ////////////// bin_pel_market_share_domestik_box //////////////
            $market_box_dom = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_box_import+jml_box_export) AS jml_box_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_box_total'),'DESC') ->take(10) ->get('jml_box_total','agent');
            foreach ($market_box_dom as $key => $value) {{
                $grafik_market_box_dom[$key][] = $value->agent."[$value->jml_box_total]";
                $grafik_market_box_dom[$key][] = (int)$value->jml_box_total;
            }}

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_market_box_dom' => $grafik_market_box_dom,
        ]);
    }

    public function bin_pel_market_share_domestik_teus()
    {
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
        
        ////////////// bin_pel_market_share_domestik_teus //////////////
            $market_teus_dom = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($market_teus_dom as $key => $value) {{
                $grafik_market_teus_dom[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_market_teus_dom[$key][] = (int)$value->jml_teus_total;
            }}

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_market_teus_dom' => $grafik_market_teus_dom,
        ]);
    }

    public function bin_pel_market_share_domestik_pendapatan()
    {
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
        
        ////////////// bin_pel_market_share_domestik_pendapatan //////////////
            $market_pendapatan_dom = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(total_pendapatan) AS total_pendapatan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('total_pendapatan'),'DESC') ->take(10) ->get('total_pendapatan','agent');
            foreach ($market_pendapatan_dom as $key => $value) {{
                $grafik_market_pendapatan_dom[$key][] = $value->agent."[$value->total_pendapatan]";
                $grafik_market_pendapatan_dom[$key][] = (int)$value->total_pendapatan;
            }}

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_market_pendapatan_dom' => $grafik_market_pendapatan_dom,
        ]);
    }

    public function bin_pel_market_share_international_box()
    {
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
        
        ////////////// bin_pel_market_share_international_box //////////////
            $market_box_int = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_box_import+jml_box_export) AS jml_box_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_box_total'),'DESC') ->take(10) ->get('jml_box_total','agent');
            foreach ($market_box_int as $key => $value) {{
                $grafik_market_box_int[$key][] = $value->agent."[$value->jml_box_total]";
                $grafik_market_box_int[$key][] = (int)$value->jml_box_total;
            }}

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_market_box_int' => $grafik_market_box_int,
        ]);
    }

    public function bin_pel_market_share_international_teus()
    {
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
        
        ////////////// bin_pel_market_share_international_teus //////////////
            $market_teus_int = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($market_teus_int as $key => $value) {{
                $grafik_market_teus_int[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_market_teus_int[$key][] = (int)$value->jml_teus_total;
            }}

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_market_teus_int' => $grafik_market_teus_int,
        ]);
    }

    public function bin_pel_market_share_international_pendapatan()
    {
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
        
        ////////////// bin_pel_market_share_international_pendapatan //////////////
            $market_pendapatan_int = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(total_pendapatan) AS total_pendapatan"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('total_pendapatan'),'DESC') ->take(10) ->get('total_pendapatan','agent');
            foreach ($market_pendapatan_int as $key => $value) {{
                $grafik_market_pendapatan_int[$key][] = $value->agent."[$value->total_pendapatan]";
                $grafik_market_pendapatan_int[$key][] = (int)$value->total_pendapatan;
            }}

        return response()->json(['tahun_ini' => $tahun_ini,'tahun_lalu' => $tahun_lalu,'bulan' => $bulan,
        'grafik_market_pendapatan_int' => $grafik_market_pendapatan_int,
        ]);
    }

///////////// BINA PELANGGAN ///////////////////////////////////////////////

    public function bin_pel_carier(Request $request)
    {
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
        
        if (request()->start_date || request()->end_date || request()->cari_lokasi) {
            $lokasi = request()->cari_lokasi;
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

            $grafik_pie_carrier = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) ->where('lokasi', $lokasi) ->whereBetween('tanggal',[$start_date,$end_date]) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
                foreach ($grafik_pie_carrier as $key => $value) {{
                    $grafik_carrier[$key][] = $value->agent."[$value->jml_teus_total]";
                    $grafik_carrier[$key][] = (int)$value->jml_teus_total;
                }}
                
        } 
        else {
            $grafik_pie_carrier = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->groupBy(\DB::raw('lokasi')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_carrier as $key => $value) {{
                $grafik_carrier[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_carrier[$key][] = (int)$value->jml_teus_total;
            }}
        }
            
        return response()->json(['grafik_carrier' => $grafik_carrier]);
    }

    public function bin_pel_mlo(Request $request)
    {
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

        if (request()->start_date || request()->end_date || request()->cari_lokasi) {
            $lokasi = request()->cari_lokasi;
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

            $grafik_pie_mlo = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) ->where('lokasi', $lokasi) ->whereBetween('tanggal',[$start_date,$end_date]) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
                foreach ($grafik_pie_mlo as $key => $value) {{
                    $grafik_mlo[$key][] = $value->agent."[$value->jml_teus_total]";
                    $grafik_mlo[$key][] = (int)$value->jml_teus_total;
                }}
                
        }
        else {
            $grafik_pie_mlo = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->groupBy(\DB::raw('lokasi')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_mlo as $key => $value) {{
                $grafik_mlo[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_mlo[$key][] = (int)$value->jml_teus_total;
            }}
        }

        return response()->json(['grafik_mlo' => $grafik_mlo]);
    }

    public function bin_pel_emkl(Request $request)
    {
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

        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

            $grafik_pie_emkl = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) ->whereBetween('tanggal',[$start_date,$end_date]) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
                foreach ($grafik_pie_emkl as $key => $value) {{
                    $grafik_emkl[$key][] = $value->agent."[$value->jml_teus_total]";
                    $grafik_emkl[$key][] = (int)$value->jml_teus_total;
                }}
        }
            
        else {
            $grafik_pie_emkl = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->groupBy(\DB::raw('lokasi')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_emkl as $key => $value) {{
                $grafik_emkl[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_emkl[$key][] = (int)$value->jml_teus_total;
            }}
        }

        return response()->json(['grafik_emkl' => $grafik_emkl]);
    }

    public function bin_pel_pemilik_barang(Request $request)
    {
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

        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

            $grafik_pie_pemilik_barang = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) ->whereBetween('tanggal',[$start_date,$end_date]) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
                foreach ($grafik_pie_pemilik_barang as $key => $value) {{
                    $grafik_pemilik_barang[$key][] = $value->agent."[$value->jml_teus_total]";
                    $grafik_pemilik_barang[$key][] = (int)$value->jml_teus_total;
                }}
        }
            
        else {
            $grafik_pie_pemilik_barang = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->groupBy(\DB::raw('lokasi')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_pemilik_barang as $key => $value) {{
                $grafik_pemilik_barang[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_pemilik_barang[$key][] = (int)$value->jml_teus_total;
            }}
        }

        return response()->json(['grafik_pemilik_barang' => $grafik_pemilik_barang]);
    }

    public function bin_pel_pemilik_barang_eksportir(Request $request)
    {
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

        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

            $grafik_pie_pemilik_barang_eksportir = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) ->whereBetween('tanggal',[$start_date,$end_date]) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
                foreach ($grafik_pie_pemilik_barang_eksportir as $key => $value) {{
                    $grafik_pemilik_barang_eksportir[$key][] = $value->agent."[$value->jml_teus_total]";
                    $grafik_pemilik_barang_eksportir[$key][] = (int)$value->jml_teus_total;
                }}
        }
            
        else {
            $grafik_pie_pemilik_barang_eksportir = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->groupBy(\DB::raw('lokasi')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_pemilik_barang_eksportir as $key => $value) {{
                $grafik_pemilik_barang_eksportir[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_pemilik_barang_eksportir[$key][] = (int)$value->jml_teus_total;
            }}
        }

        return response()->json(['grafik_pemilik_barang_eksportir' => $grafik_pemilik_barang_eksportir]);
    }

    public function bin_pel_pemilik_barang_importir(Request $request)
    {
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

        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

            $grafik_pie_pemilik_barang_importir = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) ->whereBetween('tanggal',[$start_date,$end_date]) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
                foreach ($grafik_pie_pemilik_barang_importir as $key => $value) {{
                    $grafik_pemilik_barang_importir[$key][] = $value->agent."[$value->jml_teus_total]";
                    $grafik_pemilik_barang_importir[$key][] = (int)$value->jml_teus_total;
                }}
        }
            
        else {
            $grafik_pie_pemilik_barang_importir = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
            ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) ->groupBy(\DB::raw('lokasi')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_pemilik_barang_importir as $key => $value) {{
                $grafik_pemilik_barang_importir[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_pemilik_barang_importir[$key][] = (int)$value->jml_teus_total;
            }}
        }
            
        return response()->json(['grafik_pemilik_barang_importir' => $grafik_pemilik_barang_importir]);
    }            


    /////////////// belum bisa query ///////////////////////////////
    // SELECT JML_TEUS_IMPORT, JML_TEUS_EXPORT FROM  DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES
    public function bin_pel_produksi_international_import()
    {
        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $grafik_pie_produksi_international_import = V_produksi_pendapatan_cus::select(\DB::raw("jml_teus_import"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) 
        ->orderBy(\DB::raw('jml_teus_import'),'DESC') ->take(10) ->get('jml_teus_import');
        foreach ($grafik_pie_produksi_international_import as $key => $value) {{
            $grafik_produksi_international_import[$key][] = "Import"."[$value->jml_teus_import]";
            $grafik_produksi_international_import[$key][] = (int)$value->jml_teus_import;
        }}
            
        return response()->json(['grafik_produksi_international_import' => $grafik_produksi_international_import]);
    } 

    public function bin_pel_produksi_international_eksport()
    {
        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $grafik_pie_produksi_international_eksport = V_produksi_pendapatan_cus::select(\DB::raw("jml_teus_export"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) 
        ->orderBy(\DB::raw('jml_teus_export'),'DESC') ->take(10) ->get('jml_teus_export');
        foreach ($grafik_pie_produksi_international_eksport as $key => $value) {{
            $grafik_produksi_international_eksport[$key][] = "Eksport"."[$value->jml_teus_export]";
            $grafik_produksi_international_eksport[$key][] = (int)$value->jml_teus_export;
        }}
            
        return response()->json(['grafik_produksi_international_eksport' => $grafik_produksi_international_eksport]);
    } 

    public function bin_pel_produksi_domestik_import()
    {
        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $grafik_pie_produksi_domestik_import = V_produksi_pendapatan_cus::select(\DB::raw("jml_teus_import"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) 
        ->orderBy(\DB::raw('jml_teus_import'),'DESC') ->take(10) ->get('jml_teus_import');
        foreach ($grafik_pie_produksi_domestik_import as $key => $value) {{
            $grafik_produksi_domestik_import[$key][] = "Import"."[$value->jml_teus_import]";
            $grafik_produksi_domestik_import[$key][] = (int)$value->jml_teus_import;
        }}
            
        return response()->json(['grafik_produksi_domestik_import' => $grafik_produksi_domestik_import]);
    } 

    public function bin_pel_produksi_domestik_eksport()
    {
        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $grafik_pie_produksi_domestik_eksport = V_produksi_pendapatan_cus::select(\DB::raw("jml_teus_export"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) 
        ->orderBy(\DB::raw('jml_teus_export'),'DESC') ->take(10) ->get('jml_teus_export');
        foreach ($grafik_pie_produksi_domestik_eksport as $key => $value) {{
            $grafik_produksi_domestik_eksport[$key][] = "Eksport"."[$value->jml_teus_export]";
            $grafik_produksi_domestik_eksport[$key][] = (int)$value->jml_teus_export;
        }}
            
        return response()->json(['grafik_produksi_domestik_eksport' => $grafik_produksi_domestik_eksport]);
    } 


    public function bin_pel_pod(Request $request)
    {
        $grafik_pie_pod = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) 
        ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) 
        ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_pod as $key => $value) {{
                $grafik_pod[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_pod[$key][] = (int)$value->jml_teus_total;
            }}
            
        return response()->json(['grafik_pod' => $grafik_pod]);
    }

    public function bin_pel_fpod(Request $request)
    {
        $grafik_pie_fpod = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) 
        ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) 
        ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_fpod as $key => $value) {{
                $grafik_fpod[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_fpod[$key][] = (int)$value->jml_teus_total;
            }}
            
        return response()->json(['grafik_fpod' => $grafik_fpod]);
    }

    public function bin_pel_pol(Request $request)
    {
        $grafik_pie_pol = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) 
        ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) 
        ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_pol as $key => $value) {{
                $grafik_pol[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_pol[$key][] = (int)$value->jml_teus_total;
            }}
            
        return response()->json(['grafik_pol' => $grafik_pol]);
    }

    public function bin_pel_origin(Request $request)
    {
        $grafik_pie_origin = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total")) 
        ->groupBy(\DB::raw('tahun')) ->groupBy(\DB::raw('agent')) 
        ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
            foreach ($grafik_pie_origin as $key => $value) {{
                $grafik_origin[$key][] = $value->agent."[$value->jml_teus_total]";
                $grafik_origin[$key][] = (int)$value->jml_teus_total;
            }}
            
        return response()->json(['grafik_origin' => $grafik_origin]);
    }


}
