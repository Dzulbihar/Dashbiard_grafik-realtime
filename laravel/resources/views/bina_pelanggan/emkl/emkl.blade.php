@section('header', 'EMKL')

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
                  <button class="btn btn-primary" type="submit">Cari</button>
                  <a href="{{url('/bina_pelanggan_emkl')}}" class="btn btn-primary" type="submit">Reset</a>
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

<!-- Judul EMKL Teus -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1 align="center"> 
              <label class="badge badge-light">
                <b> EMKL / JPT </b>
              </label> 
            </h1>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

@empty ($start_date)
<!-- Judul EMKL Teus -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4> <label class="badge badge-light"> Silakan pilih periode terlebih dahulu </label> </h4>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->
@else
  <!-- Grafik -->
  @include('bina_pelanggan.emkl.emkl_grafik')

  <!-- Tabel -->
  @include('bina_pelanggan.emkl.emkl_datatabel')
@endempty








@endsection