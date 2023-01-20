<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V_produksi_pendapatan_cus;
use DB;
use App\Models\DataModel;
use Carbon\Carbon;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Carrier;
use App\Exports\Carrier_Agent;
use App\Exports\MLO;
use App\Exports\MLO_Agent;
use App\Exports\EMKL;
use App\Exports\EMKL_Agent;
use App\Exports\Pemilik_Barang;
use App\Exports\Pemilik_Barang_Agent;
use App\Exports\Pemilik_Barang_Eksportir;
use App\Exports\Pemilik_Barang_Eksportir_Agent;
use App\Exports\Pemilik_Barang_Importir;
use App\Exports\Pemilik_Barang_Importir_Agent;



class Bina_pelanggan_Controller extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }

/////////////// bina_pelanggan_market_share_domestik ///////////////////////////////

    public function bina_pelanggan_market_share_domestik ()
    {
        $title = "bina_pelanggan_market_share_domestik";
        $tahun_grafik_market_share =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES order by Tahun DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $data_market_share_box_domestik = DB::select("SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL DESC) WHERE rownum <=10");
        $data_market_share_teus_domestik = DB::select("SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,sum(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
        $data_market_share_pendapatan_domestik = DB::select("SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN DESC) where rownum <=10");

        $market_box_dom = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_box_import+jml_box_export) AS jml_box_total"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_box_total'),'DESC') ->take(10) ->get('jml_box_total','agent');
        foreach ($market_box_dom as $key => $value) {{
            $grafik_market_box_dom[$key][] = $value->agent."[$value->jml_box_total]";
            $grafik_market_box_dom[$key][] = (int)$value->jml_box_total;
        }}
        $market_teus_dom = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
        foreach ($market_teus_dom as $key => $value) {{
            $grafik_market_teus_dom[$key][] = $value->agent."[$value->jml_teus_total]";
            $grafik_market_teus_dom[$key][] = (int)$value->jml_teus_total;
        }}
        $market_pendapatan_dom = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(total_pendapatan) AS total_pendapatan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('total_pendapatan'),'DESC') ->take(10) ->get('total_pendapatan','agent');
        foreach ($market_pendapatan_dom as $key => $value) {{
            $grafik_market_pendapatan_dom[$key][] = $value->agent."[$value->total_pendapatan]";
            $grafik_market_pendapatan_dom[$key][] = (int)$value->total_pendapatan;
        }}

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.market_share.domestik',$leftmenu)->with(compact('title','tahun_grafik_market_share','tahun_ini','tahun_lalu','bulan','data_market_share_box_domestik','data_market_share_teus_domestik','data_market_share_pendapatan_domestik','grafik_market_box_dom','grafik_market_teus_dom','grafik_market_pendapatan_dom'));
    }

    public function cari_bina_pelanggan_market_share_domestik(Request $request)
    {
        $title = "bina_pelanggan_market_share_domestik";
        $tahun_grafik_market_share =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES order by Tahun DESC");

        // menangkap data pencarian
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;
        $bulan = $request->cari_bulan;

        $data_market_share_box_domestik = DB::select("SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL DESC) WHERE rownum <=10");
        $data_market_share_teus_domestik = DB::select("SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,sum(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
        $data_market_share_pendapatan_domestik = DB::select("SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN DESC) where rownum <=10");

        $market_box_dom = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_box_import+jml_box_export) AS jml_box_total"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_box_total'),'DESC') ->take(10) ->get('jml_box_total','agent');
        foreach ($market_box_dom as $key => $value) {{
            $grafik_market_box_dom[$key][] = $value->agent."[$value->jml_box_total]";
            $grafik_market_box_dom[$key][] = (int)$value->jml_box_total;
        }}
        $market_teus_dom = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
        foreach ($market_teus_dom as $key => $value) {{
            $grafik_market_teus_dom[$key][] = $value->agent."[$value->jml_teus_total]";
            $grafik_market_teus_dom[$key][] = (int)$value->jml_teus_total;
        }}
        $market_pendapatan_dom = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(total_pendapatan) AS total_pendapatan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'DOM') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('total_pendapatan'),'DESC') ->take(10) ->get('total_pendapatan','agent');
        foreach ($market_pendapatan_dom as $key => $value) {{
            $grafik_market_pendapatan_dom[$key][] = $value->agent."[$value->total_pendapatan]";
            $grafik_market_pendapatan_dom[$key][] = (int)$value->total_pendapatan;
        }}

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.market_share.domestik',$leftmenu)->with(compact('title','tahun_grafik_market_share','tahun_ini','tahun_lalu','bulan','data_market_share_box_domestik','data_market_share_teus_domestik','data_market_share_pendapatan_domestik','grafik_market_box_dom','grafik_market_teus_dom','grafik_market_pendapatan_dom'));
    }

/////////////// bina_pelanggan_market_share_international ///////////////////////////////

    public function bina_pelanggan_market_share_international ()
    {
        $title = "bina_pelanggan_market_share_international";
        $tahun_grafik_market_share =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES order by Tahun DESC");

        $tahun_max =  DB::select("SELECT MAX(TAHUN) AS tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($tahun_max as $max) {
            $max->tahun;
        }
        $tahun_ini = $max->tahun;
        $tahun_lalu = $tahun_ini-1;

        $bulan_max =  DB::select("SELECT MAX(BULAN) AS bulan FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES");
        foreach ($bulan_max as $max) {
            $max->bulan;
        }
        $bulan = $max->bulan;

        $data_market_share_box_international = DB::select("SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL DESC) WHERE rownum <=10");
        $data_market_share_teus_international = DB::select("SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,sum(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
        $data_market_share_pendapatan_international = DB::select("SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN DESC) where rownum <=10");

        $market_box_int = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_box_import+jml_box_export) AS jml_box_total"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_box_total'),'DESC') ->take(10) ->get('jml_box_total','agent');
        foreach ($market_box_int as $key => $value) {{
            $grafik_market_box_int[$key][] = $value->agent."[$value->jml_box_total]";
            $grafik_market_box_int[$key][] = (int)$value->jml_box_total;
        }}
        $market_teus_int = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
        foreach ($market_teus_int as $key => $value) {{
            $grafik_market_teus_int[$key][] = $value->agent."[$value->jml_teus_total]";
            $grafik_market_teus_int[$key][] = (int)$value->jml_teus_total;
        }}
        $market_pendapatan_int = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(total_pendapatan) AS total_pendapatan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('total_pendapatan'),'DESC') ->take(10) ->get('total_pendapatan','agent');
        foreach ($market_pendapatan_int as $key => $value) {{
            $grafik_market_pendapatan_int[$key][] = $value->agent."[$value->total_pendapatan]";
            $grafik_market_pendapatan_int[$key][] = (int)$value->total_pendapatan;
        }}

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.market_share.international',$leftmenu)->with(compact('title','tahun_grafik_market_share','tahun_ini','tahun_lalu','bulan','data_market_share_box_international','data_market_share_teus_international','data_market_share_pendapatan_international','grafik_market_box_int','grafik_market_teus_int','grafik_market_pendapatan_int'));
    }

    public function cari_bina_pelanggan_market_share_international(Request $request)
    {
        $title = "bina_pelanggan_market_share_international";
        $tahun_grafik_market_share =  DB::select("SELECT DISTINCT Tahun FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES order by Tahun DESC");

        // menangkap data pencarian
        $tahun_ini = $request->cari_tahun;
        $tahun_lalu = $request->cari_tahun-1;
        $bulan = $request->cari_bulan;

        $data_market_share_box_international = DB::select("SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL DESC) WHERE rownum <=10");
        $data_market_share_teus_international = DB::select("SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,sum(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
        $data_market_share_pendapatan_international = DB::select("SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSES where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN DESC) where rownum <=10");

        $market_box_int = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_box_import+jml_box_export) AS jml_box_total"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_box_total'),'DESC') ->take(10) ->get('jml_box_total','agent');
        foreach ($market_box_int as $key => $value) {{
            $grafik_market_box_int[$key][] = $value->agent."[$value->jml_box_total]";
            $grafik_market_box_int[$key][] = (int)$value->jml_box_total;
        }}
        $market_teus_int = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(jml_teus_import+jml_teus_export) AS jml_teus_total"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('jml_teus_total'),'DESC') ->take(10) ->get('jml_teus_total','agent');
        foreach ($market_teus_int as $key => $value) {{
            $grafik_market_teus_int[$key][] = $value->agent."[$value->jml_teus_total]";
            $grafik_market_teus_int[$key][] = (int)$value->jml_teus_total;
        }}
        $market_pendapatan_int = V_produksi_pendapatan_cus::select(\DB::raw("agent,SUM(total_pendapatan) AS total_pendapatan"))
        ->where('tahun', $tahun_ini) ->where('bulan', '<=', $bulan) ->where('lokasi', 'INT') ->groupBy(\DB::raw('lokasi'))->groupBy(\DB::raw('tahun'))->groupBy(\DB::raw('agent')) ->orderBy(\DB::raw('total_pendapatan'),'DESC') ->take(10) ->get('total_pendapatan','agent');
        foreach ($market_pendapatan_int as $key => $value) {{
            $grafik_market_pendapatan_int[$key][] = $value->agent."[$value->total_pendapatan]";
            $grafik_market_pendapatan_int[$key][] = (int)$value->total_pendapatan;
        }}

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.market_share.international',$leftmenu)->with(compact('title','tahun_grafik_market_share','tahun_ini','tahun_lalu','bulan','data_market_share_box_international','data_market_share_teus_international','data_market_share_pendapatan_international','grafik_market_box_int','grafik_market_teus_int','grafik_market_pendapatan_int'));
    }

/////////////// bina_pelanggan_agen_pelayaran_carrier ///////////////////////////////

    public function bina_pelanggan_agen_pelayaran_carrier (Request $request)
    {
        $title = "bina_pelanggan_agen_pelayaran_carrier"; 

        if ($request->ajax()) {
                
            if (request()->start_date || request()->end_date || request()->cari_lokasi) {
                $start_date = request()->start_date;
                $end_date = request()->end_date;
                $lokasi = request()->cari_lokasi;
                // $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
                // $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

                // $data_carrier = \App\Models\V_produksi_pendapatan_cus::select(\DB::raw("agent,nama_agent,lokasi,SUM(JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) AS JML_TEUS_20,SUM(JML_BOX_IMPORT_40*1+JML_BOX_EXPORT_40*1) AS JML_TEUS_40,SUM(JML_BOX_IMPORT_45*1+JML_BOX_EXPORT_45*1) AS JML_TEUS_45,SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS_TOTAL,SUM(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN"))
                // ->where('lokasi', 'INT')->whereBetween('tanggal',['2022-01-01','2022-12-31'])
                // ->groupBy(\DB::raw('lokasi'),('agent'),('nama_agent'))
                // ->orderBy(\DB::raw('jml_teus_total'),'DESC')->take(10)->get();

                $data_carrier = DB::select("SELECT AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT AGENT, NAMA_AGENT,LOKASI,
                    SUM(JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    SUM(JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    SUM(JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    SUM(TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) AND LOKASI='$lokasi' 
                    GROUP BY AGENT,NAMA_AGENT,LOKASI)
                    ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
            } 

            return Datatables::of($data_carrier)
                    ->addColumn('start_date', function ($data_carrier) use ($start_date) {  
                        return $start_date;
                    })
                    ->rawColumns(['start_date'])
                    ->addColumn('end_date', function ($data_carrier) use ($end_date) {  
                        return $end_date;
                    })
                    ->rawColumns(['end_date'])
                    ->addColumn('tombol', 'bina_pelanggan.agen_pelayaran.carrier.carrier_aksi')
                    ->rawColumns(['tombol'])
                    // ->editColumn('action', function ($row) {
                    //     return V_produksi_pendapatan_cus::STATUS_COLOR[1] ? V_produksi_pendapatan_cus::STATUS_COLOR[1] : 'none';
                    // })
                    ->addIndexColumn()
                    ->make(true);
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        $start_date = request()->start_date;
        $end_date = request()->end_date;
        $lokasi = request()->cari_lokasi;

        return view('bina_pelanggan.agen_pelayaran.carrier.carrier',$leftmenu)->with(compact('title','start_date','end_date','lokasi'));

    }

    public function bina_pelanggan_agen_pelayaran_carrier_agent (Request $request, $agent, $lokasi, $start_date, $end_date)
    {
        $title = "bina_pelanggan_agen_pelayaran_carrier";

        if ($request->ajax()) {

            if (request()->start_date_agent || request()->end_date_agent) {

                $start_date_agent = request()->start_date_agent;
                $end_date_agent = request()->end_date_agent;

                $data_carrier = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT,LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date_agent','YYYY-MM-DD') AND TO_DATE('$end_date_agent','YYYY-MM-DD')) AND LOKASI='$lokasi' AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");

            } else {

                $data_carrier = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT,LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) AND LOKASI='$lokasi' AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");
            }

            return Datatables::of($data_carrier)
            ->addIndexColumn()
            ->make(true);

        }

        $start_date_agent = request()->start_date_agent;
        $end_date_agent = request()->end_date_agent;
        $start_date = $start_date;
        $end_date = $end_date;
        $agent=$agent;
        $lokasi=$lokasi;
        
        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.agen_pelayaran.carrier.carrier_data_agent',$leftmenu)->with(compact('title','agent','lokasi','start_date','end_date','start_date_agent','end_date_agent'));
    }

    public function excel_carrier(Request $request, $lokasi, $start_date, $end_date)
    {
        return Excel::download(new Carrier($lokasi, $start_date, $end_date), 'Carrier.xls');
    }

    public function excel_carrier_agent(Request $request, $agent, $lokasi, $start_date, $end_date)
    {
        return Excel::download(new Carrier_Agent($agent, $lokasi, $start_date, $end_date), 'Carrier_Agent.xls');
    }    

/////////////// bina_pelanggan_agen_pelayaran_mlo ///////////////////////////////

    public function bina_pelanggan_agen_pelayaran_mlo (Request $request)
    {
        $title = "bina_pelanggan_agen_pelayaran_mlo"; 

        if ($request->ajax()) {
                
            if (request()->start_date || request()->end_date || request()->cari_lokasi) {
                $start_date = request()->start_date;
                $end_date = request()->end_date;
                $lokasi = request()->cari_lokasi;

                $data_mlo = DB::select("SELECT AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT AGENT, NAMA_AGENT,LOKASI,
                    SUM(JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    SUM(JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    SUM(JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    SUM(TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) AND LOKASI='$lokasi' 
                    GROUP BY AGENT,NAMA_AGENT,LOKASI)
                    ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
            } 

            return Datatables::of($data_mlo)
                    ->addColumn('start_date', function ($data_mlo) use ($start_date) {  
                        return $start_date;
                    })
                    ->rawColumns(['start_date'])
                    ->addColumn('end_date', function ($data_mlo) use ($end_date) {  
                        return $end_date;
                    })
                    ->rawColumns(['end_date'])
                    ->addColumn('tombol', 'bina_pelanggan.agen_pelayaran.mlo.mlo_aksi')
                    ->rawColumns(['tombol'])
                    ->addIndexColumn()
                    ->make(true);
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        $start_date = request()->start_date;
        $end_date = request()->end_date;
        $lokasi = request()->cari_lokasi;

        return view('bina_pelanggan.agen_pelayaran.mlo.mlo',$leftmenu)->with(compact('title','start_date','end_date','lokasi'));

    }

    public function bina_pelanggan_agen_pelayaran_mlo_agent (Request $request, $agent, $lokasi, $start_date, $end_date)
    {
        $title = "bina_pelanggan_agen_pelayaran_mlo";

        if ($request->ajax()) {

            if (request()->start_date_agent || request()->end_date_agent) {

                $start_date_agent = request()->start_date_agent;
                $end_date_agent = request()->end_date_agent;

                $data_mlo = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT,LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date_agent','YYYY-MM-DD') AND TO_DATE('$end_date_agent','YYYY-MM-DD')) AND LOKASI='$lokasi' AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");

            } else {

                $data_mlo = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT,LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) AND LOKASI='$lokasi' AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");
            }

            return Datatables::of($data_mlo)
            ->addIndexColumn()
            ->make(true);

        }

        $start_date_agent = request()->start_date_agent;
        $end_date_agent = request()->end_date_agent;
        $start_date = $start_date;
        $end_date = $end_date;
        $agent=$agent;
        $lokasi=$lokasi;
        
        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.agen_pelayaran.mlo.mlo_data_agent',$leftmenu)->with(compact('title','agent','lokasi','start_date','end_date','start_date_agent','end_date_agent'));
    }

    public function excel_mlo(Request $request, $lokasi, $start_date, $end_date)
    {
        return Excel::download(new MLO($lokasi, $start_date, $end_date), 'MLO.xls');
    }

    public function excel_mlo_agent(Request $request, $agent, $lokasi, $start_date, $end_date)
    {
        return Excel::download(new MLO_Agent($agent, $lokasi, $start_date, $end_date), 'MLO_Agent.xls');
    }

/////////////// bina_pelanggan_emkl ///////////////////////////////

    public function bina_pelanggan_emkl (Request $request)
    {
        $title = "bina_pelanggan_emkl"; 

        if ($request->ajax()) {
                
            if (request()->start_date || request()->end_date) {
                $start_date = request()->start_date;
                $end_date = request()->end_date;

                $data_emkl = DB::select("SELECT AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT AGENT, NAMA_AGENT, LOKASI,
                    SUM(JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    SUM(JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    SUM(JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    SUM(TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) 
                    GROUP BY AGENT,NAMA_AGENT,LOKASI)
                    ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
            } 

            return Datatables::of($data_emkl)
                    ->addColumn('start_date', function ($data_emkl) use ($start_date) {  
                        return $start_date;
                    })
                    ->rawColumns(['start_date'])
                    ->addColumn('end_date', function ($data_emkl) use ($end_date) {  
                        return $end_date;
                    })
                    ->rawColumns(['end_date'])
                    ->addColumn('tombol', 'bina_pelanggan.emkl.emkl_aksi')
                    ->rawColumns(['tombol'])
                    ->addIndexColumn()
                    ->make(true);
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        $start_date = request()->start_date;
        $end_date = request()->end_date;

        return view('bina_pelanggan.emkl.emkl',$leftmenu)->with(compact('title','start_date','end_date'));
    }

    public function bina_pelanggan_emkl_agent (Request $request, $agent, $start_date, $end_date)
    {
        $title = "bina_pelanggan_emkl_agent";

        if ($request->ajax()) {

            if (request()->start_date_agent || request()->end_date_agent) {

                $start_date_agent = request()->start_date_agent;
                $end_date_agent = request()->end_date_agent;

                $data_emkl = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT, LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT, LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date_agent','YYYY-MM-DD') AND TO_DATE('$end_date_agent','YYYY-MM-DD')) AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");

            } else {

                $data_emkl = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT, LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT, LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");
            }

            return Datatables::of($data_emkl)
            ->addIndexColumn()
            ->make(true);

        }

        $start_date_agent = request()->start_date_agent;
        $end_date_agent = request()->end_date_agent;
        $start_date = $start_date;
        $end_date = $end_date;
        $agent=$agent;
        
        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.emkl.emkl_data_agent',$leftmenu)->with(compact('title','agent','start_date','end_date','start_date_agent','end_date_agent'));
    }

    public function excel_emkl(Request $request, $start_date, $end_date)
    {
        return Excel::download(new EMKL($start_date, $end_date), 'EMKL.xls');
    }

    public function excel_emkl_agent(Request $request, $agent, $start_date, $end_date)
    {
        return Excel::download(new EMKL_Agent($agent, $start_date, $end_date), 'EMKL_Agent.xls');
    }

/////////////// bina_pelanggan_pemilik_barang ///////////////////////////////

    public function bina_pelanggan_pemilik_barang (Request $request)
    {
        $title = "bina_pelanggan_pemilik_barang"; 

        if ($request->ajax()) {
                
            if (request()->start_date || request()->end_date) {
                $start_date = request()->start_date;
                $end_date = request()->end_date;

                $data_pemilik_barang = DB::select("SELECT AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT AGENT, NAMA_AGENT, LOKASI,
                    SUM(JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    SUM(JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    SUM(JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    SUM(TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) 
                    GROUP BY AGENT,NAMA_AGENT,LOKASI)
                    ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
            } 

            return Datatables::of($data_pemilik_barang)
                    ->addColumn('start_date', function ($data_pemilik_barang) use ($start_date) {  
                        return $start_date;
                    })
                    ->rawColumns(['start_date'])
                    ->addColumn('end_date', function ($data_pemilik_barang) use ($end_date) {  
                        return $end_date;
                    })
                    ->rawColumns(['end_date'])
                    ->addColumn('tombol', 'bina_pelanggan.pemilik_barang.pemilik_barang_aksi')
                    ->rawColumns(['tombol'])
                    ->addIndexColumn()
                    ->make(true);
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        $start_date = request()->start_date;
        $end_date = request()->end_date;

        return view('bina_pelanggan.pemilik_barang.pemilik_barang',$leftmenu)->with(compact('title','start_date','end_date'));
    }

    public function bina_pelanggan_pemilik_barang_agent (Request $request, $agent, $start_date, $end_date)
    {
        $title = "bina_pelanggan_pemilik_barang";

        if ($request->ajax()) {

            if (request()->start_date_agent || request()->end_date_agent) {

                $start_date_agent = request()->start_date_agent;
                $end_date_agent = request()->end_date_agent;

                $data_pemilik_barang = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT, LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT, LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date_agent','YYYY-MM-DD') AND TO_DATE('$end_date_agent','YYYY-MM-DD')) AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");

            } else {

                $data_pemilik_barang = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT, LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT, LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");
            }

            return Datatables::of($data_pemilik_barang)
            ->addIndexColumn()
            ->make(true);

        }

        $start_date_agent = request()->start_date_agent;
        $end_date_agent = request()->end_date_agent;
        $start_date = $start_date;
        $end_date = $end_date;
        $agent=$agent;
        
        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.pemilik_barang.pemilik_barang_data_agent',$leftmenu)->with(compact('title','agent','start_date','end_date','start_date_agent','end_date_agent'));
    }

    public function excel_pemilik_barang(Request $request, $start_date, $end_date)
    {
        return Excel::download(new Pemilik_Barang($start_date, $end_date), 'Pemilik_Barang.xls');
    }

    public function excel_pemilik_barang_agent(Request $request, $agent, $start_date, $end_date)
    {
        return Excel::download(new Pemilik_Barang_Agent($agent, $start_date, $end_date), 'Pemilik_Barang_Agent.xls');
    }

/////////////// bina_pelanggan_pemilik_barang_eksportir ///////////////////////////////

    public function bina_pelanggan_pemilik_barang_eksportir (Request $request)
    {
        $title = "bina_pelanggan_pemilik_barang"; 

        if ($request->ajax()) {
                
            if (request()->start_date || request()->end_date) {
                $start_date = request()->start_date;
                $end_date = request()->end_date;

                $data_pemilik_barang_eksportir = DB::select("SELECT AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT AGENT, NAMA_AGENT, LOKASI,
                    SUM(JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    SUM(JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    SUM(JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    SUM(TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) 
                    GROUP BY AGENT,NAMA_AGENT,LOKASI)
                    ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
            } 

            return Datatables::of($data_pemilik_barang_eksportir)
                    ->addColumn('start_date', function ($data_pemilik_barang_eksportir) use ($start_date) {  
                        return $start_date;
                    })
                    ->rawColumns(['start_date'])
                    ->addColumn('end_date', function ($data_pemilik_barang_eksportir) use ($end_date) {  
                        return $end_date;
                    })
                    ->rawColumns(['end_date'])
                    ->addColumn('tombol', 'bina_pelanggan.pemilik_barang.eksportir_aksi')
                    ->rawColumns(['tombol'])
                    ->addIndexColumn()
                    ->make(true);
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        $start_date = request()->start_date;
        $end_date = request()->end_date;

        return view('bina_pelanggan.pemilik_barang.eksportir',$leftmenu)->with(compact('title','start_date','end_date'));
    }

    public function bina_pelanggan_pemilik_barang_eksportir_agent (Request $request, $agent, $start_date, $end_date)
    {
        $title = "bina_pelanggan_pemilik_barang";

        if ($request->ajax()) {

            if (request()->start_date_agent || request()->end_date_agent) {

                $start_date_agent = request()->start_date_agent;
                $end_date_agent = request()->end_date_agent;

                $data_pemilik_barang_eksportir = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT, LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT, LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date_agent','YYYY-MM-DD') AND TO_DATE('$end_date_agent','YYYY-MM-DD')) AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");

            } else {

                $data_pemilik_barang_eksportir = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT, LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT, LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");
            }

            return Datatables::of($data_pemilik_barang_eksportir)
            ->addIndexColumn()
            ->make(true);

        }

        $start_date_agent = request()->start_date_agent;
        $end_date_agent = request()->end_date_agent;
        $start_date = $start_date;
        $end_date = $end_date;
        $agent=$agent;
        
        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.pemilik_barang.eksportir_data_agent',$leftmenu)->with(compact('title','agent','start_date','end_date','start_date_agent','end_date_agent'));
    }

    public function excel_pemilik_barang_eksportir(Request $request, $start_date, $end_date)
    {
        return Excel::download(new Pemilik_Barang_Eksportir($start_date, $end_date), 'Pemilik_Barang_Eksportir.xls');
    }

    public function excel_pemilik_barang_eksportir_agent(Request $request, $agent, $start_date, $end_date)
    {
        return Excel::download(new Pemilik_Barang_Eksportir_Agent($agent, $start_date, $end_date), 'Pemilik_Barang_Eksportir_Agent.xls');
    }

/////////////// bina_pelanggan_pemilik_barang_importir ///////////////////////////////

    public function bina_pelanggan_pemilik_barang_importir (Request $request)
    {
        $title = "bina_pelanggan_pemilik_barang"; 

        if ($request->ajax()) {
                
            if (request()->start_date || request()->end_date) {
                $start_date = request()->start_date;
                $end_date = request()->end_date;

                $data_pemilik_barang_importir = DB::select("SELECT AGENT,NAMA_AGENT,LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT AGENT, NAMA_AGENT, LOKASI,
                    SUM(JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    SUM(JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    SUM(JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    SUM(TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) 
                    GROUP BY AGENT,NAMA_AGENT,LOKASI)
                    ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
            } 

            return Datatables::of($data_pemilik_barang_importir)
                    ->addColumn('start_date', function ($data_pemilik_barang_importir) use ($start_date) {  
                        return $start_date;
                    })
                    ->rawColumns(['start_date'])
                    ->addColumn('end_date', function ($data_pemilik_barang_importir) use ($end_date) {  
                        return $end_date;
                    })
                    ->rawColumns(['end_date'])
                    ->addColumn('tombol', 'bina_pelanggan.pemilik_barang.importir_aksi')
                    ->rawColumns(['tombol'])
                    ->addIndexColumn()
                    ->make(true);
        }

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        $start_date = request()->start_date;
        $end_date = request()->end_date;

        return view('bina_pelanggan.pemilik_barang.importir',$leftmenu)->with(compact('title','start_date','end_date'));
    }

    public function bina_pelanggan_pemilik_barang_importir_agent (Request $request, $agent, $start_date, $end_date)
    {
        $title = "bina_pelanggan_pemilik_barang";

        if ($request->ajax()) {

            if (request()->start_date_agent || request()->end_date_agent) {

                $start_date_agent = request()->start_date_agent;
                $end_date_agent = request()->end_date_agent;

                $data_pemilik_barang_importir = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT, LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT, LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date_agent','YYYY-MM-DD') AND TO_DATE('$end_date_agent','YYYY-MM-DD')) AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");

            } else {

                $data_pemilik_barang_importir = DB::select("SELECT BULAN,TAHUN,AGENT,NAMA_AGENT, LOKASI, JML_TEUS_20, JML_TEUS_40, JML_TEUS_45, JML_TEUS_TOTAL,ROUND (100 * (jml_teus_total / SUM (jml_teus_total) OVER ()),3) persen,TOTAL_PENDAPATAN
                    FROM (SELECT * FROM (SELECT BULAN,TAHUN,AGENT, NAMA_AGENT, LOKASI,
                    (JML_BOX_IMPORT_20*1+JML_BOX_EXPORT_20*1) JML_TEUS_20,
                    (JML_BOX_IMPORT_40*2+JML_BOX_EXPORT_40*2) JML_TEUS_40,
                    (JML_BOX_IMPORT_45*2+JML_BOX_EXPORT_45*2) JML_TEUS_45, 
                    (JML_TEUS_IMPORT+JML_TEUS_EXPORT) JML_TEUS_TOTAL,
                    (TOTAL_PENDAPATAN) TOTAL_PENDAPATAN
                    FROM dashboardgrafik.V_PRODUKSI_PENDAPATAN_CUSES 
                    WHERE (TANGGAL BETWEEN TO_DATE('$start_date','YYYY-MM-DD') AND TO_DATE('$end_date','YYYY-MM-DD')) AND AGENT='$agent')
                    ORDER BY TAHUN,BULAN ASC)");
            }

            return Datatables::of($data_pemilik_barang_importir)
            ->addIndexColumn()
            ->make(true);

        }

        $start_date_agent = request()->start_date_agent;
        $end_date_agent = request()->end_date_agent;
        $start_date = $start_date;
        $end_date = $end_date;
        $agent=$agent;
        
        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.pemilik_barang.importir_data_agent',$leftmenu)->with(compact('title','agent','start_date','end_date','start_date_agent','end_date_agent'));
    }

    public function excel_pemilik_barang_importir(Request $request, $start_date, $end_date)
    {
        return Excel::download(new Pemilik_Barang_Importir($start_date, $end_date), 'Pemilik_Barang_Importir.xls');
    }

    public function excel_pemilik_barang_importir_agent(Request $request, $agent, $start_date, $end_date)
    {
        return Excel::download(new Pemilik_Barang_Importir_Agent($agent, $start_date, $end_date), 'Pemilik_Barang_Importir_Agent.xls');
    }



/////////////// bina_pelanggan_pemilik_barang_emkl_agen ///////////////////////////////

    public function bina_pelanggan_pemilik_barang_emkl_agen ()
    {
        $title = "bina_pelanggan_pemilik_barang_emkl_agen";

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.pemilik_barang.emkl_agent',$leftmenu)->with(compact('title'));
    }


/////////////// bina_pelanggan_produksi ///////////////////////////////
    public function bina_pelanggan_produksi  ()
    {
        $title = "bina_pelanggan_produksi";

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

        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.produksi.produksi',$leftmenu)->with(compact('title','tahun_ini','bulan',));
    }

/////////////// bina_pelanggan_pod_fpod_pol_origin ///////////////////////////////

    public function bina_pelanggan_pod_fpod_pol_origin  ()
    {
        $title = "bina_pelanggan_pod_fpod_pol_origin";

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



        $menu=new DataModel();
        $leftmenu=$menu->getmenu();

        return view('bina_pelanggan.pod_fpod_pol_origin.pod_fpod_pol_origin',$leftmenu)->with(compact('title','tahun_ini','bulan',));
    }


}
