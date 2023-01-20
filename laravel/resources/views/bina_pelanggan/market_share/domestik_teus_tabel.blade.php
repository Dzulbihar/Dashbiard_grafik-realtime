        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Market Share Teus Domestik
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
                  <th>Jumlah</th>
                  <th>Agent</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_market_share_teus_domestik as $data)
                <tr>
                  <td> {{ $data->jml_teus_total}} </td>
                  <td> {{ $data->agent}} </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>