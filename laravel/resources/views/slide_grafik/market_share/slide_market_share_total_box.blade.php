<!-- Judul BOX -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 align="center"> 
							<b>
								Laporan Market Share BOX Domestik & International
							</b>
						</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

<!-- BOX -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-12">
        <div class="info-box bg-danger" border-style: solid>
          <h5 align="center" class="text-white">
            <b> Tahun lalu </b>
            <br><br>
            <b>
            @foreach($tahun_lalu_tampil_box_market as $arus)
            	{{$arus->box}}
            @endforeach
            <br>
            @if($arus->box ==0) 
            	0
            @elseif($arus->box=!0)
           		@foreach($tahun_ini_nilai_box_market as $arus_ini)
	           	@endforeach
	           	@foreach($tahun_lalu_nilai_box_market as $arus_lalu)
	           	@endforeach
	           	<?php 
	            	$persen = ($arus_ini->box / $arus_lalu->box * 100);
	            	echo ceil ($persen);
	           		echo '%';
	           	?>
            @endif
            </b>
          </h5>
          <div class="info-box-content">
            <h3 align="center" class="text-white">
              <b>
	            <?php echo "Tahun : $tahun_ini" ?>
              </b>
            </h3>
            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <h1 align="center">
              <b>
            	@foreach($tahun_ini_tampil_box_market as $arus)
            		{{$arus->box}}
            	@endforeach
              </b>
              <i class="fas fa-cube bg-danger" aria-hidden="true"></i>
            </h1>
            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
          </div>
          <h5 align="center" class="text-white">
            <b> RKAP </b>
            <br><br>
            <b>
            @foreach($rkap_tampil_box_market as $arus)
           		{{$arus->target_rkap}}
            @endforeach
            <br>
            @if($arus->target_rkap ==0) 
           		0
            @elseif($arus->target_rkap=!0)
           		@foreach($tahun_ini_nilai_box_market as $arus_ini)
	           	@endforeach
	           	@foreach($rkap_nilai_box_market as $arus_rkap)
	           	@endforeach
	           	<?php 
	           		$persen = ($arus_ini->box / $arus_rkap->target_rkap * 100);
	           		echo ceil ($persen);
	           		echo '%';
	           	?>
           	@endif
            </b>
          </h5>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Grafik BOX -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        @include('slide_grafik.market_share.grafik_market_share_box_total_bar')
      </div>
      <div class="col-md-6">
        @include('slide_grafik.market_share.grafik_market_share_box_total_pie')
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->