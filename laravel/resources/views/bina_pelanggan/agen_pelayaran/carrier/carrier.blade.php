@section('header', 'Carrier')

@extends('layouts.app')

@section('content')



<br>

<!-- Cari Tanggal-->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">

            <form action="" method="get">
              <div class="row g-3 align-items-center">
                <div class="col-auto">
                  <label class="col-form-label">Periode</label>
                </div>
                <div class="col-auto">
                  <input type="date" id="start_date" class="form-control" name="start_date" required>
                </div>
                <div class="col-auto">
                  <label class="col-form-label">To</label>
                </div>
                <div class="col-auto">
                  <input type="date" id="end_date" class="form-control" name="end_date" required>
                </div>
                <div class="col-auto">
                  <label class="col-form-label">Lokasi</label>
                </div>
                <div class="col-auto">
                  <select id="lokasi" name="cari_lokasi" class="form-control" required>
                    <option value="">Cari</option>
                    <option value="DOM"> Domestik </option>
                    <option value="INT"> International </option>
                  </select>
                </div>
                <div class="col-auto">
                  <button class="btn btn-primary" type="submit">Cari</button>
                  <a href="{{url('/bina_pelanggan_agen_pelayaran_carrier')}}" class="btn btn-primary" type="submit">Reset</a>
                </div>
              </div>
            </form>

            <br>
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

@empty ($lokasi)
<!-- Judul Carrier Teus -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4> <label class="badge badge-light"> Silakan pilih periode lokasi terlebih dahulu </label> </h4>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->
@else
  <!-- Grafik -->
  @include('bina_pelanggan.agen_pelayaran.carrier.carrier_grafik')

  <!-- Tabel -->
  @include('bina_pelanggan.agen_pelayaran.carrier.carrier_datatabel')
@endempty








@endsection