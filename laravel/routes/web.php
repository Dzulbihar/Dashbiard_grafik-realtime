<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//ajax (home)
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/grafik_ajax/arus_kunjungan_kapal_domestik', [App\Http\Controllers\Ajax_grafik_Controller::class, 'arus_kunjungan_kapal_domestik']);
    Route::get('/grafik_ajax/arus_kunjungan_kapal_international', [App\Http\Controllers\Ajax_grafik_Controller::class, 'arus_kunjungan_kapal_international']);

    Route::get('/grafik_ajax/arus_petikemas_domestik_box', [App\Http\Controllers\Ajax_grafik_Controller::class, 'arus_petikemas_domestik_box']);
    Route::get('/grafik_ajax/arus_petikemas_domestik_teus', [App\Http\Controllers\Ajax_grafik_Controller::class, 'arus_petikemas_domestik_teus']);
    Route::get('/grafik_ajax/arus_petikemas_domestik_pendapatan', [App\Http\Controllers\Ajax_grafik_Controller::class, 'arus_petikemas_domestik_pendapatan']);
    Route::get('/grafik_ajax/arus_petikemas_international_box', [App\Http\Controllers\Ajax_grafik_Controller::class, 'arus_petikemas_international_box']);
    Route::get('/grafik_ajax/arus_petikemas_international_teus', [App\Http\Controllers\Ajax_grafik_Controller::class, 'arus_petikemas_international_teus']);
    Route::get('/grafik_ajax/arus_petikemas_international_pendapatan', [App\Http\Controllers\Ajax_grafik_Controller::class, 'arus_petikemas_international_pendapatan']);

    Route::get('/grafik_ajax/bin_pel_market_share_domestik_box', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_market_share_domestik_box']);
    Route::get('/grafik_ajax/bin_pel_market_share_domestik_teus', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_market_share_domestik_teus']);
    Route::get('/grafik_ajax/bin_pel_market_share_domestik_pendapatan', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_market_share_domestik_pendapatan']);
    Route::get('/grafik_ajax/bin_pel_market_share_international_box', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_market_share_international_box']);
    Route::get('/grafik_ajax/bin_pel_market_share_international_teus', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_market_share_international_teus']);
    Route::get('/grafik_ajax/bin_pel_market_share_international_pendapatan', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_market_share_international_pendapatan']);

    Route::get('/grafik_ajax/bin_pel_carier', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_carier']);
    Route::get('/grafik_ajax/bin_pel_mlo', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_mlo']);
    Route::get('/grafik_ajax/bin_pel_emkl', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_emkl']);

    Route::get('/grafik_ajax/bin_pel_pemilik_barang', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_pemilik_barang']);
    Route::get('/grafik_ajax/bin_pel_pemilik_barang_eksportir', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_pemilik_barang_eksportir']);
    Route::get('/grafik_ajax/bin_pel_pemilik_barang_importir', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_pemilik_barang_importir']);

    Route::get('/grafik_ajax/bin_pel_produksi_international_import', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_produksi_international_import']);
    Route::get('/grafik_ajax/bin_pel_produksi_international_eksport', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_produksi_international_eksport']);
    Route::get('/grafik_ajax/bin_pel_produksi_domestik_import', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_produksi_domestik_import']);
    Route::get('/grafik_ajax/bin_pel_produksi_domestik_eksport', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_produksi_domestik_eksport']);

    Route::get('/grafik_ajax/bin_pel_pod', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_pod']);
    Route::get('/grafik_ajax/bin_pel_fpod', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_fpod']);
    Route::get('/grafik_ajax/bin_pel_pol', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_pol']);
    Route::get('/grafik_ajax/bin_pel_origin', [App\Http\Controllers\Ajax_grafik_Controller::class, 'bin_pel_origin']);

//arus (sudah)
    Route::get('/arus_kunjungan_kapal_domestik', [App\Http\Controllers\Arus_Controller::class, 'arus_kunjungan_kapal_domestik'])->name('arus_kunjungan_kapal_domestik');
    Route::get('/cari_arus_kunjungan_kapal_domestik', [App\Http\Controllers\Arus_Controller::class, 'cari_arus_kunjungan_kapal_domestik'])->name('arus_kunjungan_kapal_domestik');
    Route::get('/arus_kunjungan_kapal_international', [App\Http\Controllers\Arus_Controller::class, 'arus_kunjungan_kapal_international'])->name('arus_kunjungan_kapal_international');
    Route::get('/cari_arus_kunjungan_kapal_international', [App\Http\Controllers\Arus_Controller::class, 'cari_arus_kunjungan_kapal_international'])->name('arus_kunjungan_kapal_international');
    Route::get('/arus_petikemas_domestik', [App\Http\Controllers\Arus_Controller::class, 'arus_petikemas_domestik'])->name('arus_petikemas_domestik');
    Route::get('/cari_arus_petikemas_domestik', [App\Http\Controllers\Arus_Controller::class, 'cari_arus_petikemas_domestik'])->name('arus_petikemas_domestik');
    Route::get('/arus_petikemas_international', [App\Http\Controllers\Arus_Controller::class, 'arus_petikemas_international'])->name('arus_petikemas_international');
    Route::get('/cari_arus_petikemas_international', [App\Http\Controllers\Arus_Controller::class, 'cari_arus_petikemas_international'])->name('arus_petikemas_international');

//produksi (belum)
    Route::get('/produksi_petikemas_domestik', [App\Http\Controllers\Produksi_Controller::class, 'produksi_petikemas_domestik']);
    Route::get('/produksi_petikemas_international', [App\Http\Controllers\Produksi_Controller::class, 'produksi_petikemas_international']);

//pendapatan (belum)
    Route::get('/pendapatan_kegiatan_bongkar_muat_domestik', [App\Http\Controllers\Pendapatan_Controller::class, 'pendapatan_kegiatan_bongkar_muat_domestik']);
    Route::get('/pendapatan_kegiatan_bongkar_muat_international', [App\Http\Controllers\Pendapatan_Controller::class, 'pendapatan_kegiatan_bongkar_muat_international']);
    Route::get('/pendapatan_kegiatan_lapangan_domestik', [App\Http\Controllers\Pendapatan_Controller::class, 'pendapatan_kegiatan_lapangan_domestik']);
    Route::get('/pendapatan_kegiatan_lapangan_international', [App\Http\Controllers\Pendapatan_Controller::class, 'pendapatan_kegiatan_lapangan_international']);

//kinerja (belum)
    Route::get('/kinerja_bongkar_muat_domestik', [App\Http\Controllers\Kinerja_Controller::class, 'kinerja_bongkar_muat_domestik']);
    Route::get('/kinerja_bongkar_muat_international', [App\Http\Controllers\Kinerja_Controller::class, 'kinerja_bongkar_muat_international']);
    Route::get('/kinerja_lapangan_domestik', [App\Http\Controllers\Kinerja_Controller::class, 'kinerja_lapangan_domestik']);
    Route::get('/kinerja_lapangan_international', [App\Http\Controllers\Kinerja_Controller::class, 'kinerja_lapangan_international']);

//bina pelanggan / market share (belum)
    //market_share
        Route::get('/bina_pelanggan_market_share_domestik', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_market_share_domestik']);
        Route::get('/cari_bina_pelanggan_market_share_domestik', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'cari_bina_pelanggan_market_share_domestik']);
        Route::get('/bina_pelanggan_market_share_international', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_market_share_international']);
        Route::get('/cari_bina_pelanggan_market_share_international', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'cari_bina_pelanggan_market_share_international']);

    //carrier
        Route::get('/bina_pelanggan_agen_pelayaran_carrier', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_agen_pelayaran_carrier'])->name('bina_pelanggan_agen_pelayaran_carrier');

        Route::get('/bina_pelanggan_agen_pelayaran_carrier/{agent}/{lokasi}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_agen_pelayaran_carrier_agent'])->name('bina_pelanggan_agen_pelayaran_carrier_agent');

        Route::get('/excel_carrier/{lokasi}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_carrier']);
        Route::get('/excel_carrier_agent/{agent}/{lokasi}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_carrier_agent']);

    //mlo
        Route::get('/bina_pelanggan_agen_pelayaran_mlo', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_agen_pelayaran_mlo'])->name('bina_pelanggan_agen_pelayaran_mlo');

        Route::get('/bina_pelanggan_agen_pelayaran_mlo/{agent}/{lokasi}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_agen_pelayaran_mlo_agent'])->name('bina_pelanggan_agen_pelayaran_mlo_agent');

        Route::get('/excel_mlo/{lokasi}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_mlo']);
        Route::get('/excel_mlo_agent/{agent}/{lokasi}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_mlo_agent']);

    //emkl
        Route::get('/bina_pelanggan_emkl', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_emkl'])->name('bina_pelanggan_emkl');

        Route::get('/bina_pelanggan_emkl/{agent}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_emkl_agent'])->name('bina_pelanggan_emkl_agent');

        Route::get('/excel_emkl/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_emkl']);
        Route::get('/excel_emkl_agent/{agent}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_emkl_agent']);

    //pemilik barang
        Route::get('/bina_pelanggan_pemilik_barang', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_pemilik_barang'])->name('bina_pelanggan_pemilik_barang');
        Route::get('/bina_pelanggan_pemilik_barang/{agent}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_pemilik_barang_agent'])->name('bina_pelanggan_pemilik_barang_agent');
        Route::get('/excel_pemilik_barang/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_pemilik_barang']);
        Route::get('/excel_pemilik_barang_agent/{agent}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_pemilik_barang_agent']);

        Route::get('/bina_pelanggan_pemilik_barang_eksportir', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_pemilik_barang_eksportir'])->name('bina_pelanggan_pemilik_barang_eksportir');
        Route::get('/bina_pelanggan_pemilik_barang_eksportir/{agent}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_pemilik_barang_eksportir_agent'])->name('bina_pelanggan_pemilik_barang_eksportir_agent');
        Route::get('/excel_pemilik_barang_eksportir/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_pemilik_barang_eksportir']);
        Route::get('/excel_pemilik_barang_eksportir_agent/{agent}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_pemilik_barang_eksportir_agent']);

        Route::get('/bina_pelanggan_pemilik_barang_importir', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_pemilik_barang_importir'])->name('bina_pelanggan_pemilik_barang_importir');
        Route::get('/bina_pelanggan_pemilik_barang_importir/{agent}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_pemilik_barang_importir_agent'])->name('bina_pelanggan_pemilik_barang_importir_agent');
        Route::get('/excel_pemilik_barang_importir/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_pemilik_barang_importir']);
        Route::get('/excel_pemilik_barang_importir_agent/{agent}/{start_date}/{end_date}', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'excel_pemilik_barang_importir_agent']);
       
        Route::get('/bina_pelanggan_pemilik_barang_emkl_agen', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_pemilik_barang_emkl_agen']);

    //produksi
        Route::get('/bina_pelanggan_produksi', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_produksi']);

    //pod
        Route::get('/bina_pelanggan_pod_fpod_pol_origin', [App\Http\Controllers\Bina_pelanggan_Controller::class, 'bina_pelanggan_pod_fpod_pol_origin']);

//setting (sudah = menunggu kalo ada penambahan)
    Route::get('/setting_menu', [App\Http\Controllers\Setting_Controller::class, 'setting_menu'])->name('setting_menu');
    Route::post('/setting_menu/tambah', [App\Http\Controllers\Setting_Controller::class, 'tambah_setting_menu']);
    Route::get('/setting_menu/{id}/edit', [App\Http\Controllers\Setting_Controller::class, 'edit_setting_menu'])->name('setting_menu');
    Route::post('/setting_menu/{id}/update', [App\Http\Controllers\Setting_Controller::class, 'update_setting_menu']);
    Route::get('/setting_menu/{id}/hapus', [App\Http\Controllers\Setting_Controller::class, 'hapus_setting_menu']);
    Route::get('/setting_menu/cari', [App\Http\Controllers\Setting_Controller::class, 'cari']);

    Route::get('/setting_user', [App\Http\Controllers\Setting_Controller::class, 'setting_user'])->name('setting_user');
    Route::post('/setting_user/tambah', [App\Http\Controllers\Setting_Controller::class, 'tambah_setting_user']);
    Route::get('/setting_user/{id}/edit', [App\Http\Controllers\Setting_Controller::class, 'edit_setting_user'])->name('setting_user');
    Route::post('/setting_user/{id}/update', [App\Http\Controllers\Setting_Controller::class, 'update_setting_user']);
    Route::get('/setting_user/{id}/hapus', [App\Http\Controllers\Setting_Controller::class, 'hapus_setting_user']);

    Route::get('/setting_rkap', [App\Http\Controllers\Setting_Controller::class, 'setting_rkap'])->name('setting_rkap');
    Route::post('/setting_rkap/tambah', [App\Http\Controllers\Setting_Controller::class, 'tambah_setting_rkap']);
    Route::get('/setting_rkap/{id}/edit', [App\Http\Controllers\Setting_Controller::class, 'edit_setting_rkap'])->name('setting_rkap');
    Route::post('/setting_rkap/{id}/update', [App\Http\Controllers\Setting_Controller::class, 'update_setting_rkap']);
    Route::get('/setting_rkap/{id}/hapus', [App\Http\Controllers\Setting_Controller::class, 'hapus_setting_rkap']);
    Route::get('/setting_rkap/cari_tahun', [App\Http\Controllers\Setting_Controller::class, 'cari_tahun_setting_rkap'])->name('setting_rkap');
    Route::get('/setting_rkap/export_excel', [App\Http\Controllers\Setting_Controller::class, 'export_excel']);
    Route::post('/setting_satuan_rkap/tambah', [App\Http\Controllers\Setting_Controller::class, 'tambah_setting_satuan_rkap']);
    Route::get('/setting_satuan_rkap/{id}/edit', [App\Http\Controllers\Setting_Controller::class, 'edit_setting_satuan_rkap'])->name('setting_rkap');
    Route::post('/setting_satuan_rkap/{id}/update', [App\Http\Controllers\Setting_Controller::class, 'update_setting_satuan_rkap']);
    Route::get('/setting_satuan_rkap/{id}/hapus', [App\Http\Controllers\Setting_Controller::class, 'hapus_setting_satuan_rkap']);

///////////////////////////////////////////////////////////////////////

//DATA_LAMA = kunjungan kapal, arus petikemas, market share, vessel
    Route::get('/data_kunjungan_kapal', [App\Http\Controllers\OLD_Kunjungan_kapal_Controller::class, 'data_kunjungan_kapal']);
    Route::get('/cari_data_kunjungan_kapal', [App\Http\Controllers\OLD_Kunjungan_kapal_Controller::class, 'cari_data_kunjungan_kapal']);
    Route::get('/grafik_kunjungan_kapal', [App\Http\Controllers\OLD_Kunjungan_kapal_Controller::class, 'grafik_kunjungan_kapal']);
    Route::get('/cari_grafik_kunjungan_kapal', [App\Http\Controllers\OLD_Kunjungan_kapal_Controller::class, 'cari_grafik_kunjungan_kapal']);

    Route::get('/data_arus_petikemas', [App\Http\Controllers\OLD_Arus_petikemas_Controller::class, 'data_arus_petikemas']);
    Route::get('/cari_data_arus_petikemas', [App\Http\Controllers\OLD_Arus_petikemas_Controller::class, 'cari_data_arus_petikemas']);
    Route::get('/grafik_arus_petikemas', [App\Http\Controllers\OLD_Arus_petikemas_Controller::class, 'grafik_arus_petikemas']);
    Route::get('/cari_grafik_arus_petikemas', [App\Http\Controllers\OLD_Arus_petikemas_Controller::class, 'cari_grafik_arus_petikemas']);

    Route::get('/data_market_share', [App\Http\Controllers\OLD_Market_share_Controller::class, 'data_market_share']);
    Route::get('/cari_data_market_share', [App\Http\Controllers\OLD_Market_share_Controller::class, 'cari_data_market_share']);
    Route::get('/grafik_market_share', [App\Http\Controllers\OLD_Market_share_Controller::class, 'grafik_market_share']);
    Route::get('/cari_grafik_market_share', [App\Http\Controllers\OLD_Market_share_Controller::class, 'cari_grafik_market_share']);

    Route::get('/vessel_detail', [App\Http\Controllers\OLD_KinerjaController::class, 'vessel_detail']);
    Route::get('/vessel_detail/cari', [App\Http\Controllers\OLD_KinerjaController::class, 'cari_vessel_detail']);
    Route::get('/vessel_performance', [App\Http\Controllers\OLD_KinerjaController::class, 'vessel_performance']);
    Route::get('/vessel_performance/cari', [App\Http\Controllers\OLD_KinerjaController::class, 'cari_vessel_performance']);

    Route::get('/grafik_vessel_performance', [App\Http\Controllers\OLD_KinerjaController::class, 'grafik_vessel_performance']);
    Route::get('/grafik_vessel_performance/cari', [App\Http\Controllers\OLD_KinerjaController::class, 'cari_grafik_vessel_performance']);

    Route::get('/tanggal_vessel_performance', [App\Http\Controllers\OLD_KinerjaController::class, 'tanggal_vessel_performance']);
    Route::get('/tanggal_vessel_performance/cari', [App\Http\Controllers\OLD_KinerjaController::class, 'cari_tanggal_vessel_performance']);

    Route::get('/bulan_vessel_performance', [App\Http\Controllers\OLD_KinerjaController::class, 'bulan_vessel_performance']);
    Route::get('/bulan_vessel_performance/cari', [App\Http\Controllers\OLD_KinerjaController::class, 'cari_bulan_vessel_performance']);

///////////////////////////////////////////////////////////////////////



//master syscode
    Route::get('/syscode', [App\Http\Controllers\MasterController::class, 'syscode']);
        Route::post('/syscode/tambah_tahun', [App\Http\Controllers\MasterController::class, 'tambah_tahun']);
        Route::get('/syscode/{id}/edit_tahun', [App\Http\Controllers\MasterController::class, 'edit_tahun']);
        Route::post('/syscode/{id}/update_tahun', [App\Http\Controllers\MasterController::class, 'update_tahun']);
        Route::get('/syscode/{id}/hapus_tahun', [App\Http\Controllers\MasterController::class, 'hapus_tahun']);
        Route::post('/syscode/tambah_waktu', [App\Http\Controllers\MasterController::class, 'tambah_waktu']);
        Route::get('/syscode/{id}/edit_waktu', [App\Http\Controllers\MasterController::class, 'edit_waktu']);
        Route::post('/syscode/{id}/update_waktu', [App\Http\Controllers\MasterController::class, 'update_waktu']);
        Route::get('/syscode/{id}/hapus_waktu', [App\Http\Controllers\MasterController::class, 'hapus_waktu']);
        Route::post('/syscode/tambah_type', [App\Http\Controllers\MasterController::class, 'tambah_type']);
        Route::get('/syscode/{id}/edit_type', [App\Http\Controllers\MasterController::class, 'edit_type']);
        Route::post('/syscode/{id}/update_type', [App\Http\Controllers\MasterController::class, 'update_type']);
        Route::get('/syscode/{id}/hapus_type', [App\Http\Controllers\MasterController::class, 'hapus_type']);
        Route::post('/syscode/tambah_satuan', [App\Http\Controllers\MasterController::class, 'tambah_satuan']);
        Route::get('/syscode/{id}/edit_satuan', [App\Http\Controllers\MasterController::class, 'edit_satuan']);
        Route::post('/syscode/{id}/update_satuan', [App\Http\Controllers\MasterController::class, 'update_satuan']);
        Route::get('/syscode/{id}/hapus_satuan', [App\Http\Controllers\MasterController::class, 'hapus_satuan']);



//slide grafik

    Route::get('/shipcall_gt', [App\Http\Controllers\Slide_grafikController::class, 'shipcall_gt']);
    Route::get('/shipcall_gt/cari_tahun_shipcall_gt', [App\Http\Controllers\Slide_grafikController::class, 'cari_tahun_shipcall_gt']);

    Route::get('/arus_grafik', [App\Http\Controllers\Slide_grafikController::class, 'arus_grafik']);
    Route::get('/cari_arus_grafik', [App\Http\Controllers\Slide_grafikController::class, 'cari_arus_grafik']);
        Route::get('/arus_domestik', [App\Http\Controllers\Slide_grafikController::class, 'arus_domestik']);
        Route::get('/arus_domestik/cari_tahun_arus_domestik', [App\Http\Controllers\Slide_grafikController::class, 'cari_tahun_arus_domestik']);
        Route::get('/arus_international', [App\Http\Controllers\Slide_grafikController::class, 'arus_international']);
        Route::get('/arus_international/cari_tahun_arus_international', [App\Http\Controllers\Slide_grafikController::class, 'cari_tahun_arus_international']);
        Route::get('/arus_total', [App\Http\Controllers\Slide_grafikController::class, 'arus_total']);
        Route::get('/arus_total/cari_tahun_arus_total', [App\Http\Controllers\Slide_grafikController::class, 'cari_tahun_arus_total']);
        
    Route::get('/market_share', [App\Http\Controllers\Slide_grafikController::class, 'market_share']);
    Route::get('/cari_market_share', [App\Http\Controllers\Slide_grafikController::class, 'cari_market_share']);
        Route::get('/market_domestik', [App\Http\Controllers\Slide_grafikController::class, 'market_domestik']);
        Route::get('/market_domestik/cari_tahun_market_domestik', [App\Http\Controllers\Slide_grafikController::class, 'cari_tahun_market_domestik']);
        Route::get('/market_international', [App\Http\Controllers\Slide_grafikController::class, 'market_international']);
        Route::get('/market_international/cari_tahun_market_international', [App\Http\Controllers\Slide_grafikController::class, 'cari_tahun_market_international']);
        Route::get('/market_total', [App\Http\Controllers\Slide_grafikController::class, 'market_total']);
        Route::get('/market_total/cari_tahun_market_total', [App\Http\Controllers\Slide_grafikController::class, 'cari_tahun_market_total']);

    Route::get('/nota', [App\Http\Controllers\Slide_grafikController::class, 'nota']);
    Route::get('/nota/cari_nota', [App\Http\Controllers\Slide_grafikController::class, 'cari_nota']);
        Route::get('/nota_satuan', [App\Http\Controllers\Slide_grafikController::class, 'nota_satuan']);
        Route::get('/nota_satuan/cari_nota_satuan', [App\Http\Controllers\Slide_grafikController::class, 'cari_nota_satuan']);

    Route::get('/departure', [App\Http\Controllers\Slide_grafikController::class, 'departure']);
    Route::get('/departure/cari_departure', [App\Http\Controllers\Slide_grafikController::class, 'cari_departure']);
        Route::get('/departure_domestik', [App\Http\Controllers\Slide_grafikController::class, 'departure_domestik']);
        Route::get('/departure_domestik/cari_departure_domestik', [App\Http\Controllers\Slide_grafikController::class, 'cari_departure_domestik']);
        Route::get('/departure_international', [App\Http\Controllers\Slide_grafikController::class, 'departure_international']);
        Route::get('/departure_international/cari_departure_international', [App\Http\Controllers\Slide_grafikController::class, 'cari_departure_international']);
        Route::get('/departure_total', [App\Http\Controllers\Slide_grafikController::class, 'departure_total']);
        Route::get('/departure_total/cari_departure_total', [App\Http\Controllers\Slide_grafikController::class, 'cari_departure_total']);


// Route::group(['middleware' => ['auth','checkRole:admin,binpel,user']],function(){
// });