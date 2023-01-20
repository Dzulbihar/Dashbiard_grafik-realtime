<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V_produksi_pendapatan_customer;
use DB;
use App\Models\DataModel;

class OLD_Market_share_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function data_market_share ()
    {
        $title = "data_market_share";
        $data_market_share = \App\Models\V_produksi_pendapatan_customer::orderBy('tahun', 'ASC')
        ->get();
        $lokasi_data_market_share =  DB::select('SELECT distinct Lokasi From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER');
        $tahun_data_market_share =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER order by tahun DESC');

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.market_share.data',$leftmenu)->with(compact('title','data_market_share','lokasi_data_market_share','tahun_data_market_share'));
    }

    public function cari_data_market_share(Request $request)
    {
        $title = "data_market_share";
        $lokasi_data_market_share =  DB::select('SELECT distinct Lokasi From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER');
        $tahun_data_market_share =  DB::select('SELECT distinct Tahun From DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER order by tahun DESC');

        // menangkap data pencarian
        $cari_lokasi = $request->cari_lokasi;
        $cari_tahun = $request->cari_tahun;
        $data_market_share =  DB::select("SELECT * FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE LOKASI LIKE'%$cari_lokasi%' AND TAHUN LIKE'%$cari_tahun%'");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.market_share.data',$leftmenu)->with(compact('title','data_market_share','lokasi_data_market_share','tahun_data_market_share'));
    }

    public function grafik_market_share ()
    {
        $title = "grafik_market_share";
        $tahun_grafik_market_share =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

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

        $data_market_share_box_domestik = DB::select("SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL ASC) WHERE rownum <=10");
        $data_market_share_box_international = DB::select("SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL ASC) WHERE rownum <=10");

        $data_market_share_teus_domestik = DB::select("SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,sum(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL ASC) WHERE rownum <=10");
        $data_market_share_teus_international = DB::select("SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,sum(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL ASC) WHERE rownum <=10");

        $data_market_share_pendapatan_domestik = DB::select("SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN ASC) where rownum <=10");
        $data_market_share_pendapatan_international = DB::select("SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN ASC) where rownum <=10");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.market_share.grafik',$leftmenu)->with(compact('title','tahun_grafik_market_share','tahun_ini','tahun_lalu','bulan','data_market_share_box_domestik','data_market_share_box_international','data_market_share_teus_domestik','data_market_share_teus_international','data_market_share_pendapatan_domestik','data_market_share_pendapatan_international'));
    }

    public function cari_grafik_market_share(Request $request)
    {
        $title = "grafik_market_share";
        $tahun_grafik_market_share =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN order by Tahun DESC");

        // menangkap data pencarian
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;
        $bulan = $request->cari_bulan;

        $data_market_share_box_domestik = DB::select("SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL ASC) WHERE rownum <=10");
        $data_market_share_box_international = DB::select("SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL ASC) WHERE rownum <=10");

        $data_market_share_teus_domestik = DB::select("SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,sum(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL ASC) WHERE rownum <=10");
        $data_market_share_teus_international = DB::select("SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,sum(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL ASC) WHERE rownum <=10");

        $data_market_share_pendapatan_domestik = DB::select("SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN ASC) where rownum <=10");
        $data_market_share_pendapatan_international = DB::select("SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN ASC) where rownum <=10");

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('DATA_LAMA.market_share.grafik',$leftmenu)->with(compact('title','tahun_grafik_market_share','tahun_ini','tahun_lalu','bulan','data_market_share_box_domestik','data_market_share_box_international','data_market_share_teus_domestik','data_market_share_teus_international','data_market_share_pendapatan_domestik','data_market_share_pendapatan_international'));
    }

}
