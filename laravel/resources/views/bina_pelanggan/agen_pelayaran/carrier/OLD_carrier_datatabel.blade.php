<br>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              <b> Real time produksi pendapatan agen pelayaran  
                @empty ($lokasi)
                @else
                  @if($lokasi=='DOM')
                    DOMESTIK
                  @endif
                  @if($lokasi=='INT')
                    INTERNATIONAL
                  @endif
                @endempty
                (CARIER)
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
            <table class="table table-bordered yajra-datatable table-striped">
              <thead>
                <tr>
                  <th rowspan="2" > <p align="center">No.</p></th>
                  <th rowspan="2"> <p align="center">Agent</p></th>
                  <th rowspan="2"> <p align="center">Nama Agent</p></th>
                  <th rowspan="2"> <p align="center">Lokasi</p></th>
                  <!-- <th rowspan="2"> <p align="center">Bulan</p></th> -->
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
  $(function () {
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('bina_pelanggan_agen_pelayaran_carrier') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'agent', name: 'agent'},
            {data: 'nama_agent', name: 'nama_agent'},
            {data: 'lokasi', name: 'lokasi'},
            {data: 'jml_teus_20', name: 'jml_teus_20'},
            {data: 'jml_teus_40', name: 'jml_teus_40'},
            {data: 'jml_teus_45', name: 'jml_teus_45'},
            {data: 'jml_teus_total', name: 'jml_teus_total'},
            {data: 'persen', name: 'persen'},
            {data: 'total_pendapatan', name: 'total_pendapatan'},
        ]
    });
  });
</script>