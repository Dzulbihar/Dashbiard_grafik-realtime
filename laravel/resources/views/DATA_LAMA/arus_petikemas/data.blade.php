@section('header', 'Data Arus Petikemas')

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
			            <form action="{{url('/cari_data_arus_petikemas')}}" method="GET">
			            	<p class="card-title"> 
			                	<b>Lokasi</b>
			                	<select name="cari_lokasi" id="cari_lokasi" class="btn btn-default btn-sm">
			                		@foreach($lokasi_data_arus_petikemas as $lokasi)
			                		<option value="{{$lokasi->lokasi}}">
			                			{{$lokasi->lokasi}}
			                		</option>
			                		@endforeach
			                	</select>
			                	<b>Tahun</b>
			                  	<select name="cari_tahun" id="cari_tahun" class="btn btn-default btn-sm">
			                		@foreach($tahun_data_arus_petikemas as $tahun)
			                		<option value="{{$tahun->tahun}}">
			                			{{$tahun->tahun}}
			                		</option>
			                		@endforeach
			                	</select>
			              		<input type="submit" value="Cari" class="btn btn-default btn-sm">
			              		<?php 
			              			if(isset($_GET['cari_lokasi'],$_GET['cari_tahun'])){
			              			$cari_lokasi = $_GET['cari_lokasi'];
			              			$cari_tahun = $_GET['cari_tahun']; 
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

<!-- Tabel -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"> 
							Data Arus Petikemas
		              		<?php 
		              			if(isset($_GET['cari_lokasi'],$_GET['cari_tahun'])){
		              			$cari_lokasi = $_GET['cari_lokasi'];
		              			$cari_tahun = $_GET['cari_tahun'];
		              		?>
		              		@if($cari_lokasi == 'DOM') 
		              			, Lokasi Domestik
		              		@elseif($cari_lokasi == 'INT') 
		              			, Lokasi International
		              		@endif
		              		<?php echo ", Tahun $cari_tahun" ?>
		              		<?php 
		              			}
		              		?>
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
									<th>Lokasi</th>
									<th>Tahun</th>
									<th>Bulan</th>
									<th>Jumlah Box Export</th>
									<th>Jumlah Box Import</th>
									<th>Jumlah Teus Export</th>
									<th>Jumlah Teus Import</th>
									<th>Total Pendapatan</th>
								</tr>
							</thead>

							<tbody>
								<?php $nomer = 1; ?>
								@foreach($data_arus_petikemas as $arus_petikemas)
								<tr>
									<th>{{ $nomer++}}</th>
									<td> {{ $arus_petikemas->lokasi}} </td>
									<td> {{ $arus_petikemas->tahun}} </td>
									<td> {{ $arus_petikemas->bulan}} </td>
									<td> {{ $arus_petikemas->jml_box_export}} </td>
									<td> {{ $arus_petikemas->jml_box_import}} </td>
									<td> {{ $arus_petikemas->jml_teus_export}} </td>
									<td> {{ $arus_petikemas->jml_teus_import}} </td>
									<td> {{ $arus_petikemas->total_pendapatan}} </td>
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