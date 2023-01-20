        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Pendapatan Petikemas Domestik (IDR)
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel3" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Bulan</th>
                  <th> Pendapatan <?php echo $tahun_ini; ?> (IDR) </th>
                  <th> Pendapatan <?php echo $tahun_lalu; ?> (IDR) </th>
                  <th>YOY</th>
                  <th>Trend</th>
                  <th>RKAP</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_arus_petikemas_pendapatan_domestik as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <th> @number ($data->total_pendapatan) </th>
                  <th> @number ($data->total_pendapatan_tahun_lalu) </th>
                  <td> 
                    @if($data->yoy > 0 )
                    <p class="text-success mr-1">
                      <i class="fas fa-arrow-up"></i>
                      @number ($data->yoy)
                    </p>
                    @else
                    <p class="text-danger mr-1">
                      <i class="fas fa-arrow-down"></i>
                      @number ($data->yoy)
                    </p>
                    @endif
                  </td>
                  <td> 
                    @if($data->trend > 0 )
                    <p class="text-success mr-1">
                      <i class="fas fa-arrow-up"></i>
                      {{ $data->trend}} %
                    </p>
                    @else
                    <p class="text-danger mr-1">
                      <i class="fas fa-arrow-down"></i>
                      {{ $data->trend}} %
                    </p>
                    @endif
                  </td>
                  <td> @number ($data->rkap) </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>