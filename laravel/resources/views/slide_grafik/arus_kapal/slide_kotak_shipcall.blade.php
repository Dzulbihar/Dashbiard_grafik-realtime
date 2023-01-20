<!-- Data Arus -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 align="center"> 
							<b>
								Laporan Data Arus Ships call
								<?php echo "$tahun_ini" ?>
							</b>
						</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

<section class="content-header">
  <div class="container-fluid">

    <div class="row">

      <div class="col-md-12">
        <div class="card card-widget widget-user">
          <div class="widget-user-header text-white" style="background: url('{{asset('logo/call.jpg')}}') center center;">
          </div>
          <div class="widget-user-image">
            <img class="img-circle" src="{{asset('logo/call.jpg')}}" alt="User Avatar">
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <span>
                    <b> Tahun Ini</b>
                  </span>
                  <h5 class="description-header">
		             		@foreach($tahun_ini_shipcall as $arus)
		              		@number($arus->shipcall) ships call
		              	@endforeach 
		              	<br>
		             		@foreach($tahun_ini_shipcall_persen as $arus)
		             			@number($arus->shipcall) % Arus
		              	@endforeach 
                  </h5>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <span>
                    <b> Tahun lalu</b>
                  </span>
                  <h5 class="description-header">
		             		@foreach($tahun_lalu_shipcall as $arus)
		              		@number($arus->shipcall) ships call
		              	@endforeach 
		              	<br>
		             		@foreach($tahun_lalu_shipcall_persen as $arus)
		             			@number($arus->shipcall) % Arus
		              	@endforeach 
                  </h5>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <span>
                    <b> RKAP </b>
                  </span>
                  <h5 class="description-header">
		             		@foreach($rkap as $arus)
		              		@number($arus->target_rkap) Target
		              	@endforeach 
		              	<br>
		             		@foreach($rkap_persen as $arus)
		             			@number($arus->target_rkap) % Arus
		              	@endforeach 
                  </h5>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->

  </div>
</section>
<!-- /.content -->

