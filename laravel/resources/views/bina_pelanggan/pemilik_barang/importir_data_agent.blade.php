@section('header', 'Importir')

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
              <b> Real time produksi pendapatan Importir {{$agent}}</b>
            </h3>
            <p align="right">
                @empty ($start_date)
                  Tahun  {{$tahun_ini}} sampai dengan bulan  {{$bulan}}
                @else
                @endempty

                @empty ($start_date)
                @else
                  @empty ($start_date_agent)
                    Antara tanggal {{$start_date}} sampai tanggal {{$end_date}}
                  @else
                    Antara tanggal {{$start_date_agent}} sampai tanggal {{$end_date_agent}}
                  @endempty
                @endempty

                
            </p>
          </div>
          <div class="card-body">

            <form action="" method="get">
              <div class="row g-3 align-items-center">
                <div class="col-auto">
                  <label class="col-form-label">Periode</label>
                </div>
                <div class="col-auto">
                  <input type="date" id="start_date_agent" class="form-control" name="start_date_agent" required>
                </div>
                <div class="col-auto">
                  <label class="col-form-label">To</label>
                </div>
                <div class="col-auto">
                  <input type="date" id="end_date_agent" class="form-control" name="end_date_agent" required>
                </div>
                <div class="col-auto">
                  <button class="btn btn-primary" type="submit">Cari</button>
                  <a href="{{url('/bina_pelanggan_pemilik_barang_importir')}}/{{($agent)}}/{{($start_date)}}/{{($end_date)}}" class="btn btn-primary" type="submit">Reset</a>
                </div>
              </div>
            </form>

            <br>

            <table class="table table-bordered yajra-datatable table-striped">
              <thead>
                <tr>
                  <th rowspan="2" > <p align="center">No.</p></th>
                  <th rowspan="2"> <p align="center">Agent</p></th>
                  <th rowspan="2"> <p align="center">Nama Agent</p></th>
                  <th rowspan="2"> <p align="center">Lokasi</p></th>
                  <th rowspan="2"> <p align="center">Tahun</p></th>
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
              </tbody>
            </table>
            <a href="{{url('excel_pemilik_barang_importir_agent')}}/{{($agent)}}/{{($start_date)}}/{{($end_date)}}" target="_blank" class="btn btn-default btn-sm">
              <i class="fa fa-download"></i>
              Download Excel
            </a>
            <a href="{{url('/bina_pelanggan_pemilik_barang_importir')}}" class="btn btn-default btn-sm"> <i class="fa fa-undo"></i> Back </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).ready(function () {
    var table = $('.yajra-datatable').DataTable({

        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],

        processing: true,
        serverSide: true,
        ajax: {
          url:  "{{url('bina_pelanggan_pemilik_barang_importir')}}/{{($agent)}}/{{($start_date)}}/{{($end_date)}}",

          @empty ($start_date_agent)     
          @else
            data: {
                    start_date_agent:'<?php echo $start_date_agent ?>',
                    end_date_agent:'<?php echo $end_date_agent ?>',
                  },
          @endempty 
        },

        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'agent', name: 'agent'},
            {data: 'nama_agent', name: 'nama_agent'},

            {data: 'lokasi', data: 'lokasi'},
            {data: 'tahun', data: 'tahun'},
            {data: 'bulan', data: 'bulan'},

            {data: 'jml_teus_20', name: 'jml_teus_20', render: $.fn.dataTable.render.number( '.', ',', 0)},
            {data: 'jml_teus_40', name: 'jml_teus_40', render: $.fn.dataTable.render.number( '.', ',', 0)},
            {data: 'jml_teus_45', name: 'jml_teus_45', render: $.fn.dataTable.render.number( '.', ',', 0)},
            {data: 'jml_teus_total', name: 'jml_teus_total', render: $.fn.dataTable.render.number( '.', ',', 0)},
            {data: 'total_pendapatan', name: 'total_pendapatan', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )},
        ],
    });
    $.fn.dataTable.ext.errMode = 'throw';
    setInterval( function () {
        table.ajax.reload(); // user paging is not reset on reload //table.ajax.reload( null, false );
    }, 10000 );
  });
</script>

@endsection