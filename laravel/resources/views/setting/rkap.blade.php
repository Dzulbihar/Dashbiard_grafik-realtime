@section('header', 'RKAP')

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
						<form action="{{url('/setting_rkap/cari_tahun')}}" method="GET">
							<p class="card-title"> 
								<b>Tahun</b> 
								<select name="cari_tahun" id="cari_tahun" class="btn btn-default btn-sm">
									@foreach($tahun_rkap as $tahun)
									<option value="{{$tahun->tahun}}">
										{{$tahun->tahun}}
									</option>
									@endforeach
								</select>
								<b>Satuan</b> 
								<select name="cari_satuan" id="cari_satuan" class="btn btn-default btn-sm">
									@foreach($satuan_rkap as $satuan)
									<option value="{{$satuan->satuan}}">
										{{$satuan->satuan}}
									</option>
									@endforeach
								</select>
								<input type="submit" value="Cari" class="btn btn-default btn-sm">
								<?php 
								if(isset($_GET['cari_tahun'],$_GET['cari_satuan'])){
									$cari_tahun = $_GET['cari_tahun'];
									$cari_satuan = $_GET['cari_satuan'];
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

<!-- Tabel RKAP -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3  class="card-title"> RKAP 
							<?php 
							if(isset($_GET['cari_tahun'])){
								$cari_tahun = $_GET['cari_tahun'];
								?>
								<?php echo "$cari_satuan, tahun: $cari_tahun" ?>
								<?php 
							}
							?>
						</h3>
					</div>
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tahun</th>
									<th>Bulan</th>
									<th> RKAP</th>
									<th>Satuan</th>
									<th>Type</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $nomer = 1; ?>
								@foreach($target_rkap_perbulan as $target_rkap)
								<tr>
									<th>{{ $nomer++}}</th>
									<td> {{ $target_rkap->tahun}} </td>
									<td> {{ $target_rkap->bulan}} </td>
									<td> {{ $target_rkap->target_rkap}} </td>
									<td> {{ $target_rkap->satuan}} </td>
									<td> {{ $target_rkap->type}} </td>
									<td>
										<a href="{{url('setting_rkap')}}/{{$target_rkap->id}}/{{('edit')}}" class="btn btn-warning text-white btn-sm">
											<i class="fas fa-pencil-alt"></i>
											Edit
										</a>
										<a href="#" class="btn btn-danger btn-sm delete_target_rkap" data-target_rkap-id="{{ $target_rkap->id}}" data-target_rkap-target_rkap="{{ $target_rkap->target_rkap}}">
											<i class="fas fa-trash"></i>
											Hapus
										</a>
									</td>
								</tr>
								@endforeach 
							</tbody>
						</table>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#target_rkap">
							Tambah RKAP
						</button>

						<!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalLong">
							Import Data
						</button> -->

						<a href="{{url('setting_rkap')}}/{{('export_excel')}}" target="_blank" class="btn btn-success btn-sm">
						  <i class="fa fa-download"></i>
						  Export Data Excel
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

<!-- Tabel Satuan -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3  class="card-title"> Satuan </h3>
					</div>
					<div class="card-body">
						<table id="example2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Satuan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $nomer = 1; ?>
								@foreach($pilih_satuan_rkap as $satuan_rkap)
								<tr>
									<th>{{ $nomer++}}</th>
									<td> {{ $satuan_rkap->satuan}} </td>
									<td>
										<a href="{{url('setting_satuan_rkap')}}/{{$satuan_rkap->id}}/{{('edit')}}" class="btn btn-warning text-white btn-sm">
											<i class="fas fa-pencil-alt"></i>
											Edit
										</a>
										<a href="#" class="btn btn-danger btn-sm delete_satuan_rkap" data-satuan_rkap-id="{{ $satuan_rkap->id}}" data-satuan_rkap-satuan="{{ $satuan_rkap->satuan}}">
											<i class="fas fa-trash"></i>
											Hapus
										</a>
									</td>
								</tr>
								@endforeach 
							</tbody>
						</table>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#satuan">
							Tambah Satuan
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

<!-- Modal Import Excel -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"> Import Excel </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" enctype="multipart/form-data" action="ms_target_rkap_import.php">
					<input class="form-control" name="fileexcel" type="file" required="required">
					<br>
					<button class="btn btn-sm btn-secondary" type="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah RKAP  -->
<div class="modal fade" id="target_rkap" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="target_rkap"> <b> Tambah RKAP </b> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{url('setting_rkap')}}/{{('tambah')}}" method="post" enctype="multipart/form-data">
          		{{csrf_field()}}
					
					<div class="form-group row">
						<div class="col-md-6">
							<label> Tahun </label>
							<input type="number" name="tahun" class="form-control" required>
							<!-- <select name="tahun" class="form-control">
								@foreach($select_tahun as $tahun)
								<option value="{{$tahun->value_number}}">
									{{$tahun->value_number}}
								</option>
								@endforeach
							</select> -->      
						</div>
						<div class="col-md-6">
							<label> Bulan </label>
							<select name="bulan" class="form-control" required>
								<option> </option>
								<option value="01"> Januari </option>
								<option value="02"> Februari </option>
								<option value="03"> Maret </option>
								<option value="04"> April </option>
								<option value="05"> Mei </option>
								<option value="06"> Juni </option>
								<option value="07"> Juli </option>
								<option value="08"> Agustus </option>
								<option value="09"> September </option>
								<option value="10"> Oktober </option>
								<option value="11"> November </option>
								<option value="12"> Desember </option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<label>  Target RKAP  </label>
							<input type="number" name="target_rkap" class="form-control" value="0" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label> Satuan </label>
							<select name="satuan" class="form-control" required>
								<option> </option>
								<!-- <option value="SHIPCALL"> Shipcall </option>
								<option value="BOX"> Box </option>
								<option value="TEUS"> Teus </option>
								<option value="PENDAPATAN"> Pendapatan </option> -->
								@foreach($pilih_satuan_rkap as $satuan)
								<option> {{$satuan->satuan}} </option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6">
							<label> Type </label>
							<select name="type" class="form-control" required>
								<option> </option>
								<option value="DOM"> Domestik </option>
								<option value="INT"> International </option>
								<!-- @foreach($select_type as $type)
								<option value="{{$type->value_char}}">
									{{$type->ket_char}}
								</option>
								@endforeach -->
							</select>
						</div>
					</div>
					<div class="form-group row">
						<!-- Tombol -->    
						<div class="col-md-12">
							<br>
							<button type="submit" class="btn btn-primary btn-sm">
								Simpan   
							</button>
							<button type="button" class="btn btn-default btn-sm float-right" data-dismiss="modal">Tutup</button>
						</div>
					</form>  
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Tambah satuan -->
<div class="modal fade" id="satuan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="satuan"> <b> Tambah RKAP </b> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{url('setting_satuan_rkap')}}/{{('tambah')}}" method="post" enctype="multipart/form-data">
          		{{csrf_field()}}
					
					<div class="form-group row">
						<div class="col-md-12">
							<label> Satuan RKAP </label>
							<input type="text" onkeyup="myFunction()" id="satuan_id" name="satuan" class="form-control" autocomplete="off" required>  
						</div>
					</div>
					<div class="form-group row">
						<!-- Tombol -->    
						<div class="col-md-12">
							<br>
							<button type="submit" class="btn btn-primary btn-sm">
								Simpan   
							</button>
							<button type="button" class="btn btn-default btn-sm float-right" data-dismiss="modal">Tutup</button>
						</div>
					</form>  
				</div>
			</div>
		</div>
	</div>
</div>


<script>
function myFunction() {
    var satuan_id = document.getElementById("satuan_id");
    satuan_id.value = satuan_id.value.toUpperCase();
}
</script>

@endsection
