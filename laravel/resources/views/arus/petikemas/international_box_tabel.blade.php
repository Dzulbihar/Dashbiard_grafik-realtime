        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Arus Petikemas International (Box)
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
                  <th> Import <?php echo $tahun_ini; ?>  </th>
                  <th> Export <?php echo $tahun_ini; ?>  </th>
                  <th> Total <?php echo $tahun_ini; ?>  </th>
                  <th> Import <?php echo $tahun_lalu; ?>  </th>
                  <th> Export <?php echo $tahun_lalu; ?>  </th>
                  <th> Total <?php echo $tahun_lalu; ?>  </th>
                  <th>YOY</th>
                  <th>Trend</th>
                  <th>RKAP</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_arus_petikemas_box_international as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> @number ($data->box_import) </td>
                  <td> @number ($data->box_export) </td>
                  <th> @number ($data->total_box) </th>
                  <td> @number ($data->box_import_thn_lalu) </td>
                  <td> @number ($data->box_export_thn_lalu) </td>
                  <th> @number ($data->total_box_thn_lalu) </th>
                  <td> 
                    @if($data->yoy_box > 0 )
                    <p class="text-success mr-1">
                      <i class="fas fa-arrow-up"></i>
                      @number ($data->yoy_box)
                    </p>
                    @else
                    <p class="text-danger mr-1">
                      <i class="fas fa-arrow-down"></i>
                      @number ($data->yoy_box)
                    </p>
                    @endif
                  </td>
                  <td> 
                    @if($data->trend_box > 0 )
                    <p class="text-success mr-1">
                      <i class="fas fa-arrow-up"></i>
                      {{ $data->trend_box}} %
                    </p>
                    @else
                    <p class="text-danger mr-1">
                      <i class="fas fa-arrow-down"></i>
                      {{ $data->trend_box}} %
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