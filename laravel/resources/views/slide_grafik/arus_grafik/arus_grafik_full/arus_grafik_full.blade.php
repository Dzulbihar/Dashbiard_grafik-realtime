@section('header', 'Grafik Arus Domestik')

@extends('layouts.app')

@section('content')

<br>

<!-- Cari -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <form action="{{url('/cari_arus_grafik')}}" method="GET">
              <p class="card-title"> 
                <b>Pilih Satuan</b> 
                <select name="pilih_satuan" id="pilih_satuan" class="btn btn-secondary btn-sm">
                  <option value="JML_BOX"> Jumlah BOX </option>
                  <option value="JML_TEUS"> Jumlah TEUS </option>
                  <option value="TOTAL_PENDAPATAN"> Total Pendapatan </option>
                </select>
                <b>Pilih Lokasi</b> 
                <select name="pilih_lokasi" id="pilih_lokasi" class="btn btn-secondary btn-sm">
                  <option value="DOM"> Domestik </option>
                  <option value="INT"> International </option>
                  <option value=""> Domestik & International</option>
                </select>
                <b>Pilih Tahun</b> 
                <select name="cari_tahun" id="cari_tahun" class="btn btn-secondary btn-sm">
                  @foreach($tahun_arus_grafik as $tahun)
                  <option value="{{$tahun->tahun}}">
                    {{$tahun->tahun}}
                  </option>
                  @endforeach
                </select>
                <b>Pilih Bulan</b> 
                <select name="cari_bulan" id="cari_bulan" class="btn btn-secondary btn-sm">
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
                <b>Pilih Grafik</b> 
                <select name="pilih_grafik" id="pilih_grafik" class="btn btn-secondary btn-sm">
                  <option> Grafik Batang </option>
                  <option> Grafik Line </option>
                </select>
                <input type="submit" value="Cari" class="btn btn-secondary btn-sm">
                <?php 
                if(isset($_GET['pilih_satuan'],$_GET['pilih_lokasi'],$_GET['cari_tahun'],$_GET['cari_bulan'],$_GET['pilih_grafik'])){
                  $pilih_satuan = $_GET['pilih_satuan'];
                  $pilih_lokasi = $_GET['pilih_lokasi'];
                  $cari_tahun = $_GET['cari_tahun'];
                  $cari_bulan = $_GET['cari_bulan'];
                  $pilih_grafik = $_GET['pilih_grafik'];
                  ?>
                  <br><br>
                  <a class="btn btn-secondary btn-sm text-white"> 
                    Hasil pencarian, 
                    <?php
                      if ($pilih_satuan=='JML_BOX') {
                          echo 'Satuan: Jumlah BOX, ';
                      }elseif ($pilih_satuan=='JML_TEUS') {
                            echo 'Satuan: Jumlah TEUS, ';
                      }else{
                           echo 'Satuan: Total Pendapatan, ';
                      } 

                      if ($pilih_lokasi=='DOM') {
                          echo 'Lokasi: Domestik, ';
                      }elseif ($pilih_lokasi=='INT') {
                            echo 'Lokasi: International,';
                      }else{
                           echo 'Lokasi: Domestik & International, ';
                      }

                      echo "Tahun: $cari_tahun, ";

                      if ($cari_bulan=='01') {
                          echo 'Bulan: Januari, ';
                      }elseif ($cari_bulan=='02') {
                            echo 'Bulan: Februari, ';
                      }elseif ($cari_bulan=='03') {
                            echo 'Bulan: Maret, ';
                      }elseif ($cari_bulan=='04') {
                            echo 'Bulan: April, ';
                      }elseif ($cari_bulan=='05') {
                            echo 'Bulan: Mei, ';
                      }elseif ($cari_bulan=='06') {
                            echo 'Bulan: Juni, ';
                      }elseif ($cari_bulan=='07') {
                            echo 'Bulan: Juli, ';
                      }elseif ($cari_bulan=='08') {
                            echo 'Bulan: Agustus, ';
                      }elseif ($cari_bulan=='09') {
                            echo 'Bulan: September, ';
                      }elseif ($cari_bulan=='10') {
                            echo 'Bulan: Oktober, ';
                      }elseif ($cari_bulan=='11') {
                            echo 'Bulan: November, ';
                      }else{
                           echo 'Bulan: Desember, ';
                      }

                      echo "Grafik: $pilih_grafik";

                    ?>
                  </a>
                  <?php 
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

  @include('slide_grafik.arus_grafik.arus_grafik_full.kotak_arus_grafik_full')



@empty ($grafik)
  <!-- Grafik BOX -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('slide_grafik.arus_grafik.arus_grafik_full.grafik_arus_grafik_full')
        </div>
      </div>        
    </div>
  </section>
  <!-- /.content -->
@else
  @if ($grafik == 'Grafik Batang')
  <!-- Grafik BOX -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('slide_grafik.arus_grafik.arus_grafik_full.grafik_arus_grafik_full')
        </div>
      </div>        
    </div>
  </section>
  <!-- /.content -->
  @endif
  @if ($grafik == 'Grafik Line')
  <!-- Grafik BOX -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('slide_grafik.arus_grafik.arus_grafik_full.line_arus_grafik_full.grafik_arus_grafik_full')
        </div>
      </div>        
    </div>
  </section>
  <!-- /.content -->
  @endif
@endempty


@endsection


<?php 
  // if(isset($_GET['cari_tahun'])){
  // $cari_tahun = $_GET['cari_tahun'];
?>    
<!-- code tidak berfungsi jika belum pilih tahun     -->    
<?php 
  // }
?>