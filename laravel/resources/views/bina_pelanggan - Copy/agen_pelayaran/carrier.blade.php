@section('header', 'Carrier')

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

            <form action="{{url('bina_pelanggan_agen_pelayaran_carrier')}}/{{('cari_periode')}}" method="get">
              <div class="row g-3 align-items-center">
                <div class="col-auto">
                  <label class="col-form-label">Periode</label>
                </div>
                <div class="col-auto">
                  <input type="date" class="form-control" name="start_date" required>
                </div>
                <div class="col-auto">
                  <label class="col-form-label">To</label>
                </div>
                <div class="col-auto">
                  <input type="date" class="form-control" name="end_date" required>
                </div>
                <div class="col-auto">
                  <label class="col-form-label">Lokasi</label>
                </div>
                <div class="col-auto">
                  <select name="cari_lokasi" id="cari_lokasi" class="form-control" required>
                    <option> </option>
                    <option value="DOM"> Domestik </option>
                    <option value="INT"> International </option>
                  </select>
                </div>
                <div class="col-auto">
                  <button class="btn btn-primary" type="submit">Cari</button>
                </div>
              </div>
            </form>
            <br>

            <!-- <form action="{{url('/cari_bina_pelanggan_agen_pelayaran_carrier')}}" method="GET">
              <p class="card-title">
                <b>Lokasi</b> 
                <select name="lokasi" id="lokasi" class="btn btn-default btn-sm">
                  <option value="DOM"> Domestik </option>
                  <option value="INT"> International </option>
                </select>
                <b>Tahun</b> 
                <select name="cari_tahun" id="cari_tahun" class="btn btn-default btn-sm">
                  @foreach($tahun_grafik_agen_pelayaran as $tahun)
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
                if(isset($_GET['cari_tahun'],$_GET['cari_bulan'],$_GET['lokasi'])){
                  $cari_tahun = $_GET['cari_tahun'];
                  $cari_bulan = $_GET['cari_bulan'];
                  $lokasi = $_GET['lokasi'];
                }
                ?>
              </p>
            </form> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<!-- Judul Carrier Teus -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1 align="center"> 
              <label class="badge badge-light">
                <b> 
                  Agen Pelayaran 
                  @empty ($lokasi)
                  @else
                    @if($lokasi == "DOM")
                      Domestik
                    @else($lokasi == "INT")
                      International
                    @endif
                  @endempty
                  (Carrier)
                </b>
              </label> 
            </h1>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->


<!-- Grafik Carrier Teus -->

@include('bina_pelanggan.agen_pelayaran.carrier_grafik')
 

<!-- Tabel Carrier Teus -->
           
@include('bina_pelanggan.agen_pelayaran.carrier_data')








@endsection