@section('header', 'Carrier')

@extends('layouts.app')

@section('content')

<br>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <b> Real time produksi pendapatan agen pelayaran 
                  @if($data_lokasi == 'DOM')
                    DOMESTIK
                  @else($data_lokasi == 'INT')
                    INTERNASIONAL
                  @endif
                  {{$data_agent}} (carrier) 
              </b>
            </h3>
            <p align="right">
                @empty ($lokasi)
                  Tahun  {{$tahun_ini}} sampai dengan bulan  {{$bulan}}
                @else
                @endempty

                @empty ($start_date)
                @else
                  Antara tanggal {{$start_date}} sampai tanggal {{$end_date}}
                @endempty
            </p>
          </div>
          <div class="card-body">

            <form action="{{url('bina_pelanggan_agen_pelayaran_carrier_agent')}}/{{('cari_periode_agent')}}" method="get">
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
                  <input type="hidden" name="data_agent" value="{{$data_agent}}">
                  <input type="hidden" name="data_lokasi" value="{{$data_lokasi}}">
                <div class="col-auto">
                  <button class="btn btn-primary" type="submit">Cari</button>
                </div>
              </div>
            </form>
            <br>

            <table id="tabel5" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th rowspan="2" > <p align="center">No.</p></th>
                  <th rowspan="2"> <p align="center">Agent</p></th>
                  <th rowspan="2"> <p align="center">Nama Agent</p></th>
                  <th rowspan="2"> <p align="center">Lokasi</p></th>
                  <th rowspan="2"> <p align="center">Bulan</p></th>
                  <th colspan="4"> <p align="center">Produksi (TEUS)</p></th>
                  <th rowspan="2"> <p align="center">Pendapatan (IDR)</p></th>
                </tr>
                <tr>
                  <th>20</th>
                  <th>40</th>
                  <th>45</th>
                  <th>Total</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_carrier as $data)
                <tr>
                  <td> {{$nomer++}} </td>
                  <td> {{ $data->agent}} </td>
                  <td> {{ $data->nama_agent}} </td>
                  <td> {{ $data->lokasi}} </td>
                  <td> {{ $data->bulan}} </td>
                  <td> @number ($data->jml_teus_20) </td>
                  <td> @number ($data->jml_teus_40) </td>
                  <td> @number ($data->jml_teus_45) </td>
                  <td> @number ($data->jml_teus_total) </td>
                  <td> @number ($data->total_pendapatan) </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
            <div class="card-tools">
              <a href="{{url('/bina_pelanggan_agen_pelayaran_carrier')}}"> <label class="btn btn-primary btn-sm"> Back </label> </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

@endsection