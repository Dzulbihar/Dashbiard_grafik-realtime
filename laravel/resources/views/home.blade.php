@section('header', 'Dashboard')

@extends('layouts.app')

@section('content')

 
<br>

<!-- Grafik Arus Shipcall -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.kunjungan_kapal.domestik_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.kunjungan_kapal.international_grafik')

          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Grafik Arus Box TEUS -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.petikemas.domestik_box_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.petikemas.domestik_teus_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.petikemas.international_box_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.petikemas.international_teus_grafik')

          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Grafik Arus Pendapatan -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.petikemas.domestik_pendapatan_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.petikemas.international_pendapatan_grafik')

          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Grafik Market Share Box TEUS -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.market_share.domestik_box_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.market_share.domestik_teus_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.market_share.international_box_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.market_share.international_teus_grafik')

          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Grafik Market Share Pendapatan -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.market_share.domestik_pendapatan_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.market_share.international_pendapatan_grafik')

          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Grafik Agen Pelayaran -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.agen_pelayaran.carrier_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.agen_pelayaran.mlo_grafik')

          </div>
        </div>
      </div>      
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Grafik EMKL -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.emkl.emkl_grafik')

          </div>
        </div>
      </div>      
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Grafik Pemilik Barang -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.pemilik_barang.pemilik_barang_grafik')

          </div>
        </div>
      </div>    
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.pemilik_barang.eksportir_grafik')

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.pemilik_barang.importir_grafik')

          </div>
        </div>
      </div>  
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Grafik Produksi -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.produksi.produksi_grafik')

          </div>
        </div>
      </div>        
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Grafik pod_fpod_pol_origin -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            @include('grafik_home.pod_fpod_pol_origin.pod_fpod_pol_origin_grafik')

          </div>
        </div>
      </div>        
    </div>        
  </div>
</section>
<!-- /.content -->

@endsection