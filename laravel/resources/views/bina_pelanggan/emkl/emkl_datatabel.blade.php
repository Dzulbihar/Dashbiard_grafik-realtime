<br>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              <b> Real time produksi pendapatan EMKL / JPT
              </b>
            </h3>
            <p align="right">
                @empty ($start_date)
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
            <table class="table table-bordered yajra-datatable table-striped">
              <thead>
                <tr>
                  <th rowspan="2" > <p align="center">No.</p></th>
                  <th rowspan="2"> <p align="center">Agent</p></th>
                  <th rowspan="2"> <p align="center">Nama Agent</p></th>
                  <th rowspan="2"> <p align="center">Lokasi</p></th>
                  <th colspan="5"> <p align="center">Produksi (TEUS)</p></th>
                  <th rowspan="2"> <p align="center">Pendapatan (IDR)</p></th>
                </tr>
                <tr>
                  <th>20</th>
                  <th>40</th>
                  <th>45</th>
                  <th>Total</th>
                  <th>%</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <a href="{{url('excel_emkl')}}/{{($start_date)}}/{{($end_date)}}" target="_blank" class="btn btn-default btn-sm">
              <i class="fa fa-download"></i>
              Download Excel
            </a>
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

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">

  // DataTable.setOptions({
  //   colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
  // });

  $(document).ready(function () {
    var table = $('.yajra-datatable').DataTable({

    processing: true,
    serverSide: true,
    ajax: {
      url:  "{{ route('bina_pelanggan_emkl') }}",
      data: {
              start_date:start_date,
              end_date: end_date,
            },      
    },
    
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {
          data: 'tombol', 
          name: 'tombol', 
          orderable: true, 
          searchable: true
        },
        {data: 'nama_agent', name: 'nama_agent'},
        {data: 'lokasi', data: 'lokasi'},
        {data: 'jml_teus_20', name: 'jml_teus_20', render: $.fn.dataTable.render.number( '.', ',', 0)},
        {data: 'jml_teus_40', name: 'jml_teus_40', render: $.fn.dataTable.render.number( '.', ',', 0)},
        {data: 'jml_teus_45', name: 'jml_teus_45', render: $.fn.dataTable.render.number( '.', ',', 0)},
        {data: 'jml_teus_total', name: 'jml_teus_total', render: $.fn.dataTable.render.number( '.', ',', 0)},
        {data: 'persen', name: 'persen'},
        {data: 'total_pendapatan', name: 'total_pendapatan', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )},
      ],



    });
    $.fn.dataTable.ext.errMode = 'throw';
    setInterval( function () {
        table.ajax.reload(); // user paging is not reset on reload //table.ajax.reload( null, false );
    }, 10000 );
  });
</script>