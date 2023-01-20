@section('header', 'Kunjungan Kapal International')

@extends('layouts.app')

@section('content')

<br>

<!-- Cari Tahun-->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <form action="{{url('/cari_arus_kunjungan_kapal_international')}}" method="GET">
              <p class="card-title"> 
                <b>Tahun</b> 
                <select name="cari_tahun" id="cari_tahun" class="btn btn-default btn-sm">
                  @foreach($tahun_grafik_kunjungan_kapal as $tahun)
                  <option value="{{$tahun->tahun}}">
                    {{$tahun->tahun}}
                  </option>
                  @endforeach
                </select>
                <b>Bulan</b> 
                <select name="cari_bulan" id="cari_bulan" class="btn btn-default btn-sm">
                  <option value="01"> Januari </option>
                  <option value="02"> Februari </option>
                  <option value="03"> Maret </option>
                  <option value="04"> April </option>
                  <option value="05"> Mei </option>
                  <option value="06"> Juni </option>
                  <option value="07"> Juli </option>
                  <option value="08"> Agustus </option>
                  <option value="09"> September </option>
                  <option value="10"> Oktober </option>
                  <option value="11"> November </option>
                  <option value="12"> Desember </option>
                </select>
                <input type="submit" value="Cari" class="btn btn-default btn-sm">
                <?php 
                if(isset($_GET['cari_tahun'],$_GET['cari_bulan'],$_GET['pilih_grafik'])){
                  $cari_tahun = $_GET['cari_tahun'];
                  $cari_bulan = $_GET['cari_bulan'];
                  $pilih_grafik = $_GET['pilih_grafik'];
                }
                ?>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->


<!-- Grafik Shipcall -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            @include('arus.kunjungan_kapal.international_grafik')

          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Tabel -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

            @include('arus.kunjungan_kapal.international_tabel')

      </div>
    </div>
  </div>
</section>
<!-- /.content -->




@endsection