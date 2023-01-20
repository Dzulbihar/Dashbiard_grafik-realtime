@section('header', 'Vessel Details')

@extends('layouts.app')

@section('content')

<br>

<!-- Cari -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
			            <form action="{{url('/vessel_detail/cari')}}" method="GET">
			              	<p class="card-title"> 
			                	<b>Bulan</b>
			                	<select name="pilih_bulan" class="btn btn-secondary btn-sm">
			                		<option value="01">Januari</option>
			                		<option value="02">Februari</option>
			                		<option value="03">Maret</option>
			                		<option value="04">April</option>
			                		<option value="05">Mei</option>
			                		<option value="06">Juni</option>
			                		<option value="07">Juli</option>
			                		<option value="08">Agustus</option>
			                		<option value="09">September</option>
			                		<option value="10">Oktober</option>
			                		<option value="11">November</option>
			                		<option value="12">Desember</option>
			                	</select>
			                	<b>Tahun</b>
			                  	<select name="pilih_tahun" class="btn btn-secondary btn-sm">
			                		@foreach($pilih_tahun as $tahun)
			                		<option value="{{$tahun->act_start_work_ts}}">
			                			{{$tahun->act_start_work_ts}}
			                		</option>
			                		@endforeach
			                	</select>
			              		<input type="submit" value="Cari" class="btn btn-secondary btn-sm text-white">
			              		<?php 
			              			if(isset($_GET['pilih_bulan'],$_GET['pilih_tahun'])){
			              			$pilih_bulan = $_GET['pilih_bulan'];
			              			$pilih_tahun = $_GET['pilih_tahun'];
			              		?>
				                <a class="btn btn-secondary btn-sm text-white"> 
				                    Hasil pencarian, 
				                    <?php
				                      if ($pilih_bulan=='01') {
				                          echo 'Bulan: Januari, ';
				                      }elseif ($pilih_bulan=='02') {
				                            echo 'Bulan: Februari, ';
				                      }elseif ($pilih_bulan=='03') {
				                            echo 'Bulan: Maret, ';
				                      }elseif ($pilih_bulan=='04') {
				                            echo 'Bulan: April, ';
				                      }elseif ($pilih_bulan=='05') {
				                            echo 'Bulan: Mei, ';
				                      }elseif ($pilih_bulan=='06') {
				                            echo 'Bulan: Juni, ';
				                      }elseif ($pilih_bulan=='07') {
				                            echo 'Bulan: Juli, ';
				                      }elseif ($pilih_bulan=='08') {
				                            echo 'Bulan: Agustus, ';
				                      }elseif ($pilih_bulan=='09') {
				                            echo 'Bulan: September, ';
				                      }elseif ($pilih_bulan=='10') {
				                            echo 'Bulan: Oktober, ';
				                      }elseif ($pilih_bulan=='11') {
				                            echo 'Bulan: November, ';
				                      }else{
				                           echo 'Bulan: Desember, ';
				                      }

				                      echo "Tahun: $pilih_tahun, ";
				                    ?>
				                </a>
			              		<?php 
			              			}
			              		?>
			                </p>
			            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

<!-- Main Tabel -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"> 
							Data Vessel Details
						</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>VES_ID</th>
									<th>AGENT</th>
									<th>SHIPPER</th>
									<th>OCEAN_INTERISLAND</th>
									<th>VES_NAME</th>
									<th>IN_VOYAGE</th>
									<th>OUT_VOYAGE</th>
									<th>VES_SERVICE</th>
									<th>BERTH_FR_METRE</th>
									<th>BERTH_TO_METRE</th>
									<th>DISCHARGE</th>
									<th>LOAD</th>
									<th>EST_BERTH_TS</th>
									<th>ACT_BERTH_TS</th>
									<th>EST_START_WORK_TS</th>
									<th>ACT_START_WORK_TS</th>
									<th>EST_END_WORK_TS</th>
									<th>ACT_END_WORK_TS</th>
									<th>EST_DEP_TS</th>
									<th>ACT_DEP_TS</th>
								</tr>
							</thead>
							<tbody>
								<?php $nomer = 1; ?>
								@foreach($vessel_detail as $vessel)
								<tr>
									<th>{{ $nomer++}}</th>
									<td> {{ $vessel->ves_id}} </td>
									<td> {{ $vessel->agent}} </td>
									<td> {{ $vessel->shipper}} </td>
									<td> {{ $vessel->ocean_interisland}} </td>
									<td> {{ $vessel->ves_name}} </td>
									<td> {{ $vessel->in_voyage}} </td>
									<td> {{ $vessel->out_voyage}} </td>
									<td> {{ $vessel->ves_service}} </td>
									<td> {{ $vessel->berth_fr_metre}} </td>
									<td> {{ $vessel->berth_to_metre}} </td>
									<td> {{ $vessel->discharge}} </td>
									<td> {{ $vessel->load}} </td>
									<td> {{ $vessel->est_berth_ts}} </td>
									<td> {{ $vessel->act_berth_ts}} </td>
									<td> {{ $vessel->est_start_work_ts}} </td>
									<td> {{ $vessel->act_start_work_ts}} </td>
									<td> {{ $vessel->est_end_work_ts}} </td>
									<td> {{ $vessel->act_end_work_ts}} </td>
									<td> {{ $vessel->est_dep_ts}} </td>
									<td> {{ $vessel->act_dep_ts}} </td>
								</tr>
								@endforeach 
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

@endsection
