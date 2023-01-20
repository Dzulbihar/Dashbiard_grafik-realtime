        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Arus Petikemas International (Teus)
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel2" class="table table-bordered table-striped">
              <thead>
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
                @foreach($data_arus_petikemas_teus_international as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> @number ($data->teus_import) </td>
                  <td> @number ($data->teus_export) </td>
                  <th> @number ($data->total_teus) </th>
                  <td> @number ($data->teus_import_thn_lalu) </td>
                  <td> @number ($data->teus_export_thn_lalu) </td>
                  <th> @number ($data->total_teus_thn_lalu) </th>
                  <td> 
                    @if($data->yoy_teus > 0 )
                    <p class="text-success mr-1">
                      <i class="fas fa-arrow-up"></i>
                      @number ($data->yoy_teus)
                    </p>
                    @else
                    <p class="text-danger mr-1">
                      <i class="fas fa-arrow-down"></i>
                      @number ($data->yoy_teus)
                    </p>
                    @endif
                  </td>
                  <td> 
                    @if($data->trend_teus > 0 )
                    <p class="text-success mr-1">
                      <i class="fas fa-arrow-up"></i>
                      {{ $data->trend_teus}} %
                    </p>
                    @else
                    <p class="text-danger mr-1">
                      <i class="fas fa-arrow-down"></i>
                      {{ $data->trend_teus}} %
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