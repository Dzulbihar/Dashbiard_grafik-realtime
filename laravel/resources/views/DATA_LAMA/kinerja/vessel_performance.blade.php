@section('header', 'Vessel Performance')

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
			            <form action="{{url('/vessel_performance/cari')}}" method="GET">
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
			                		<option value="{{$tahun->from_ts}}">
			                			{{$tahun->from_ts}}
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
							Data Vessel Performance
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
									<th>ID</th>
									<th>VES_ID</th>
									<th>CHE_ID</th>
									<th>ET</th>
									<th>ET_NET</th>
									<th>BSHGROSS</th>
									<th>BSHNET</th>
									<th>BSH</th>
									<th>BSH_GROSS</th>
									<th>BSH_NET</th>
									<th>BCH</th>
									<th>BCH_GROSS</th>
									<th>BCH_NET</th>
									<th>BOX</th>
									<th>TEUS</th>
									<th>OVD</th>
									<th>SHIFT</th>
									<th>WORK_TS</th>
									<th>FROM_TS</th>
									<th>TO_TS</th>
									<th>Bulan</th>
									<th>Tahun</th>
								</tr>
							</thead>
							<tbody>
								<?php $nomer = 1; ?>
								@foreach($vessel_performance as $vessel)
								<tr>
									<th>{{ $nomer++}}</th>
									<td> {{ $vessel->ves_id}} </td>
									<td> {{ $vessel->che_id}} </td>
									<td> {{ $vessel->et}} </td>
									<td> {{ $vessel->et_net}} </td>
									<td> {{ $vessel->bshgross}} </td>
									<td> {{ $vessel->bshnet}} </td>
									<td> {{ $vessel->bsh}} </td>
									<td> {{ $vessel->bsh_gross}} </td>
									<td> {{ $vessel->bsh_net}} </td>
									<td> {{ $vessel->bch}} </td>
									<td> {{ $vessel->bch_gross}} </td>
									<td> {{ $vessel->bch_net}} </td>
									<td> {{ $vessel->box}} </td>
									<td> {{ $vessel->teus}} </td>
									<td> {{ $vessel->ovd}} </td>
									<td> {{ $vessel->shift}} </td>
									<td> {{ $vessel->work_ts}} </td>
									<td> {{ $vessel->from_ts}} </td>
									<td> {{ $vessel->to_ts}} </td>
									<td> {{ $vessel->bulan}} </td>
									<td> {{ $vessel->tahun}} </td>
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
