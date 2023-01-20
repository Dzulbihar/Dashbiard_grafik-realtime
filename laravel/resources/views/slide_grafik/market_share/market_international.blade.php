@section('header', 'Grafik Market Share International')

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
            <form action="{{url('/market_international/cari_tahun_market_international')}}" method="GET">
              <p class="card-title"> 
                <b>Pilih Tahun</b> 
                <select name="cari_tahun" id="cari_tahun" class="btn btn-secondary btn-sm">
                  @foreach($tahun_arus_international as $tahun)
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
                <input type="submit" value="Cari" class="btn btn-secondary btn-sm">
                <?php 
                if(isset($_GET['cari_tahun'],$_GET['cari_bulan'])){
                  $cari_tahun = $_GET['cari_tahun'];
                  $cari_bulan = $_GET['cari_bulan'];
                  ?>
                  <a class="btn btn-secondary btn-sm text-white"> Hasil pencarian <?php echo "tahun : $cari_tahun" ?></a>
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

  @include('slide_grafik.market_share.slide_market_share_international_box')

  @include('slide_grafik.market_share.slide_market_share_international_teus')

  @include('slide_grafik.market_share.slide_market_share_international_pendapatan')

@endsection