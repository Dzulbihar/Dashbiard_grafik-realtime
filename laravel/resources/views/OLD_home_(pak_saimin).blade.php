@section('header', 'Dashboard')

@extends('layouts.app')

@section('content')

<!-- durasi slide -->
<?php 
  $durasi_slide = $durasi ;
  $durasi_slide;
?>

<!-- Cari -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <form action="{{url('/home/cari_home')}}" method="GET">
              <p class="card-title"> 
                <b>Pilih Tahun</b> 
                <select name="cari_tahun" id="cari_tahun" class="btn btn-secondary btn-sm">
                  @foreach($pilih_tahun as $tahun)
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
                <b>Pilih Durasi Slide</b>
                <select name="cari_durasi" id="cari_durasi" class="btn btn-secondary btn-sm">
                  @foreach($pilih_durasi as $durasi)
                  <option value="{{$durasi->value_number}}">
                    {{$durasi->ket_number}}
                  </option>
                  @endforeach
                </select>
                <input type="submit" value="Cari" class="btn btn-secondary btn-sm">
                <?php 
                if(isset($_GET['cari_tahun'],$_GET['cari_bulan'],$_GET['cari_durasi'])){
                  $cari_tahun = $_GET['cari_tahun'];
                  $cari_bulan = $_GET['cari_bulan'];
                  $cari_durasi = $_GET['cari_durasi'];
                ?>
                  <a class="btn btn-secondary btn-sm text-white"> 
                    Hasil pencarian,
                    <?php 
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
                      if ($cari_durasi=='5000') {
                        echo 'Durasi slide: 5 detik, ';
                      }elseif ($cari_durasi=='10000') {
                        echo 'Durasi slide: 10 detik, ';
                      }elseif ($cari_durasi=='20000') {
                        echo 'Durasi slide: 20 detik, ';
                      }elseif ($cari_durasi=='30000') {
                        echo 'Durasi slide: 30 detik, ';
                      }elseif ($cari_durasi=='60000') {
                        echo 'Durasi slide: 1 menit, ';
                      }elseif ($cari_durasi=='300000') {
                        echo 'Durasi slide: 5 menit, ';
                      }elseif ($cari_durasi=='600000') {
                        echo 'Durasi slide: 10 menit, ';
                      }else{
                       echo 'Durasi Slide belum terdefinisi';
                     }
                    ?>
                  </a>
                <?php 
                  }
                ?>

                @empty ($cari_durasi)
                  <p align="right">Default Durasi Slide = 30 detik </p>
                @else
                  <!-- @if ($cari_durasi == '5000')
                    <p align="right">Durasi Slide = 5 detik </p>
                  @elseif ($cari_durasi == '10000')
                    <p align="right">Durasi Slide = 10 detik </p>
                  @elseif ($cari_durasi == '20000')
                    <p align="right">Durasi Slide = 20 detik </p>
                  @elseif ($cari_durasi == '30000')
                    <p align="right">Durasi Slide = 30 detik </p>
                  @elseif ($cari_durasi == '60000')
                    <p align="right">Durasi Slide = 1 menit </p>
                  @elseif ($cari_durasi == '300000')
                    <p align="right">Durasi Slide = 5 menit </p>
                  @elseif ($cari_durasi == '600000')
                    <p align="right">Durasi Slide = 10 menit </p>
                  @else
                    <p align="right">Durasi Slide belum terdefinisi </p>
                  @endif -->
                @endempty

              </p>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="5" aria-label="Slide 6"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="6" aria-label="Slide 7"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="7" aria-label="Slide 8"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="8" aria-label="Slide 9"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="9" aria-label="Slide 10"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="10" aria-label="Slide 11"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="11" aria-label="Slide 12"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="12" aria-label="Slide 13"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="13" aria-label="Slide 14"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="14" aria-label="Slide 15"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="15" aria-label="Slide 16"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="16" aria-label="Slide 17"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="17" aria-label="Slide 18"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="18" aria-label="Slide 19"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="19" aria-label="Slide 20"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="20" aria-label="Slide 21"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="21" aria-label="Slide 22"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="22" aria-label="Slide 23"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="23" aria-label="Slide 24"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="24" aria-label="Slide 25"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="25" aria-label="Slide 26"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="26" aria-label="Slide 27"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="27" aria-label="Slide 28"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="28" aria-label="Slide 29"></button>

          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="29" aria-label="Slide 30"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="30" aria-label="Slide 31"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="31" aria-label="Slide 32"></button>

        </div>
        <div class="carousel-inner">

          <!-- Arus kapal shipcall gt-->
          <div class="carousel-item active" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_kapal.slide_kotak_shipcall')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <!-- Arus kapal shipcall gt dom int -->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_kapal.slide_grafik_shipcall')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Arus grafik domestik-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_grafik.slide_arus_domestik_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_grafik.slide_arus_domestik_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_grafik.slide_arus_domestik_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Arus grafik international-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_grafik.slide_arus_international_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_grafik.slide_arus_international_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_grafik.slide_arus_international_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Arus grafik total-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_grafik.slide_arus_total_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_grafik.slide_arus_total_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.arus_grafik.slide_arus_total_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Market share domestik-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.market_share.slide_market_share_domestik_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.market_share.slide_market_share_domestik_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.market_share.slide_market_share_domestik_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Market share international-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.market_share.slide_market_share_international_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.market_share.slide_market_share_international_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.market_share.slide_market_share_international_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Market share total-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.market_share.slide_market_share_total_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.market_share.slide_market_share_total_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.market_share.slide_market_share_total_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Nota-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.nota.slide_grafik.slide_nota_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.nota.slide_grafik.slide_nota_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.nota.slide_grafik.slide_nota_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Departure Domestik-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.departure.slide_grafik.departure_domestik.slide_departure_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.departure.slide_grafik.departure_domestik.slide_departure_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.departure.slide_grafik.departure_domestik.slide_departure_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Departure International-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.departure.slide_grafik.departure_international.slide_departure_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.departure.slide_grafik.departure_international.slide_departure_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.departure.slide_grafik.departure_international.slide_departure_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

          <!-- Departure Total-->
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.departure.slide_grafik.departure_total.slide_departure_box')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.departure.slide_grafik.departure_total.slide_departure_teus')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
          <div class="carousel-item" data-bs-interval=<?php echo $durasi_slide ?>>
            <div class="single-hero-slide bg-img">
              @include('slide_grafik.departure.slide_grafik.departure_total.slide_departure_pendapatan')
            </div>     
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div>
  </div>
</section>



@endsection
