        <div class="card">  
          <div class="card-header">
            <h3 class="card-title"> 
              <b>Agent</b>
            </h3>
          </div>                
          <div class="card-body">
            <ul class="chart-legend clearfix">
              @foreach($data_carrier as $data)
              <li>
                <!-- <i class="far fa-circle text-info"></i> -->
                <form action="{{url('/data_bina_pelanggan_agen_pelayaran_carrier_agent')}}" method="GET">
                  <input hidden name="data_agent" value="{{$data->agent}}" class="btn btn-default btn-sm">
                  <input type="submit" value="{{$data->agent}}" class="btn btn-default btn-sm"> 
                  <?php 
                  if(isset($_GET['data_agent'])){
                    $data_agent = $_GET['data_agent'];
                  }
                  ?>
                </form>
              </li>
              @endforeach 
            </ul>
          </div>
        </div>