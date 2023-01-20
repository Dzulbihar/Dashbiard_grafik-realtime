

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
                (carrier)
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

            <table id="tabel1" class="table table-bordered table-striped">
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
                <?php $nomer = 1; ?>
                @foreach($data_carrier as $data)
                <tr>
                  <td> {{$nomer++}} </td>
                  <td>
                    <form action="{{url('/bina_pelanggan_agen_pelayaran_carrier_agent')}}" method="GET">
                      <input hidden name="data_agent" value="{{$data->agent}}">
                      <input hidden name="data_lokasi" value="{{$data->lokasi}}">
                      <input type="submit" value="{{$data->agent}}"> 
                      <?php 
                      if(isset($_GET['data_agent'],$_GET['data_lokasi'])){
                        $data_agent = $_GET['data_agent'];
                        $data_lokasi = $_GET['data_lokasi'];
                      }
                      ?>
                    </form>
                  </td>
                  <td> {{ $data->nama_agent}} </td>
                  <td> {{ $data->lokasi}} </td>
                  <td> @number ($data->jml_teus_20) </td>
                  <td> @number ($data->jml_teus_40) </td>
                  <td> @number ($data->jml_teus_45) </td>
                  <td> @number ($data->jml_teus_total) </td>
                  <td> @number ($data->persen) </td>
                  <td> @number ($data->total_pendapatan) </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

