@section('header', 'Grafik Departure Total')

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
            <form action="{{url('/departure_total/cari_departure_total')}}" method="GET">
              <p class="card-title"> 
                <b>Pilih Tahun</b> 
                <select name="cari_tahun" id="cari_tahun" class="btn btn-secondary btn-sm">
                  @foreach($tahun_departure as $tahun)
                  <option value="{{$tahun->tahun_departure}}">
                    {{$tahun->tahun_departure}}
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
                if(isset($_GET['cari_tahun'],$_GET['cari_bulan'],$_GET['pilih_grafik'])){
                  $cari_tahun = $_GET['cari_tahun'];
                  $cari_bulan = $_GET['cari_bulan'];
                  $pilih_grafik = $_GET['pilih_grafik'];
                  ?>
                  <a class="btn btn-secondary btn-sm text-white"> Hasil pencarian <?php echo "tahun : $cari_tahun, bulan : $cari_bulan, grafik : $pilih_grafik" ?></a>
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

  @include('slide_grafik.departure.slide_grafik.departure_total.slide_departure_box')

  @include('slide_grafik.departure.slide_grafik.departure_total.slide_departure_teus')

  @include('slide_grafik.departure.slide_grafik.departure_total.slide_departure_pendapatan')


@endsection


<?php 
	// if(isset($_GET['cari_tahun'])){
	// $cari_tahun = $_GET['cari_tahun'];
?>		
<!-- code tidak berfungsi jika belum pilih tahun		 -->		
<?php 
	// }
?>