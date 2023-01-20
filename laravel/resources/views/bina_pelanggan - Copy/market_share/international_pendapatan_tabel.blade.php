        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Market Share Pendapatan International
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel6" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Agent</th>
                  <th>Jumlah</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_market_share_pendapatan_international as $data)
                <tr>
                  <td> {{ $data->agent}} </td>
                  <td> {{ $data->total_pendapatan}} </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>