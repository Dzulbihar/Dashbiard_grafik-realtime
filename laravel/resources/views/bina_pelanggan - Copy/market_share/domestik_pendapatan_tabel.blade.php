        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Market Share Pendapatan Domestik
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel5" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Jumlah</th>
                  <th>Agent</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_market_share_pendapatan_domestik as $data)
                <tr>
                  <td> {{ $data->total_pendapatan}} </td>
                  <td> {{ $data->agent}} </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>