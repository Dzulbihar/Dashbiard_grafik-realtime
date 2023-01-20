        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Kunjungan Kapal International
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Bulan</th>
                  <th>Tahun <?php echo $tahun_ini; ?></th>
                  <th>Tahun <?php echo $tahun_lalu; ?></th>
                  <th>YOY</th>
                  <th>Trend</th>
                  <th>RKAP</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_kunjungan_kapal_international as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> @number ($data->shipcall_tahun_ini) </td>
                  <td> @number ($data->shipcall_tahun_lalu) </td>
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
                  <td> @number ($data->rkap)</td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>