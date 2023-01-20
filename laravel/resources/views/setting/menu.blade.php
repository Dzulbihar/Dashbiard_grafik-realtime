@section('header', 'User')

@extends('layouts.app')

@section('content')

<br>

<!-- Main Tabel -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
			            <form action="{{url('/setting_menu/cari')}}" method="GET">
			              	<h3 class="card-title">Setting
				              	<?php 
				                	if(isset($_GET['cari'])){
				                 	$cari = $_GET['cari'];
				                 	}
				              	?>
				              	@empty ($cari)
				              		Menu
				              	@else
				              		@if($cari==1)
				              			Sub Menu
				              		@elseif($cari==2)
				              			Sub Menu 2
				              		@endif
				              	@endempty
				              	<select type="text" name="cari" class="btn btn-default btn-sm">
				                	<option value="0">Menu</option>
				                	<option value="1">Sub Menu</option>
				                	<option value="2">Sub Menu 2</option>
				              	</select>
				              	<input type="submit" value="CARI" class="btn btn-default btn-sm">
			              	</h3>
			            </form>
					</div>
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Menu</th>
									<th>Nama URL</th>
									<th>Nama Icon</th>
									<th>Role Id</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php $nomer = 1; ?>
								@foreach($setting_menus as $setting_menu)
								<tr>
									<th>{{ $nomer++}}</th>
									<td> {{ $setting_menu->menu_label}} </td>
									<td> {{ $setting_menu->menu_url}} </td>
									<td> {{ $setting_menu->menu_icon}} </td>
									<td> {{ $setting_menu->role_id}} </td>
									<td>
										<a href="{{url('setting_menu')}}/{{$setting_menu->id}}/{{('edit')}}" class="btn btn-warning text-white btn-sm">
											<i class="fas fa-pencil-alt"></i>
											Edit
										</a>
										<a href="#" class="btn btn-danger btn-sm delete_menu" data-setting_menu-id="{{ $setting_menu->id}}" data-setting_menu-name="{{ $setting_menu->menu_label}}">
											<i class="fas fa-trash"></i>
											Hapus
										</a>
									</td>
								</tr>
								@endforeach 
							</tbody>
						</table>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#menu">
							Tambah Menu
						</button>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#submenu">
							Tambah Sub Menu
						</button>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#submenu2">
							Tambah Sub Menu 2
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->




<!-- Modal Sub Menu ------------------------------------------------- -->
<div class="modal fade" id="submenu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> <b> Tambah Sub Menu </b> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{url('setting_menu')}}/{{('tambah')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}

					<input type="hidden" name="sub_menu" value="1">
					<div class="form-group row">
	                  	<div class="col-md-3">
							<label> Role Menu </label>
						</div>
						<div class="col-md-9">
							<select class="form-control" name="role_id" required>
	                      		<option selected> {{ old('role_id') }} </option>
	                      		@foreach ($users as $ka)
	                      			<option  value="{{$ka->id}}">{{$ka->role}}</option>
	                      		@endforeach
	                    	</select>
						</div>
					</div>
	                <div class="form-group row">
	                  	<div class="col-md-3">
							<label> Menu Parent </label>
						</div>
						<div class="col-md-9">
							<select class="form-control" name="menu_parent" required>
	                      		<option selected> {{ old('menu_parent') }} </option>
	                      		@foreach ($setting_submenu as $ka)
	                      			<option  value="{{$ka->id}}">{{$ka->menu_label}} ({{$ka->role_id}})</option>
	                      		@endforeach
	                    	</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama Menu </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="menu_label" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama URL </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="menu_url" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama Icon </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="menu_icon" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group row">
	                  	<div class="col-md-3">
							<label> Buat Turunan  </label>
						</div>
						<div class="col-md-9">
							<select class="form-control" name="alt_url" required>
	                      		<option selected> {{ old('alt_url') }} </option>
	                      			<option  value="right fas fa-angle-left">Ya</option>
	                      			<option  value="#">Tidak</option>
	                    	</select>
						</div>
					</div>
					<div class="form-group row">
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

<!-- Modal Sub Menu 2 ------------------------------------------------- -->
<div class="modal fade" id="submenu2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> <b> Tambah Sub Menu 2 </b> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{url('setting_menu')}}/{{('tambah')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}

					<input type="hidden" name="sub_menu" value="2">
					
					<div class="form-group row">
	                  	<div class="col-md-3">
							<label> Role Menu </label>
						</div>
						<div class="col-md-9">
							<select class="form-control" name="role_id" required>
	                      		<option selected> {{ old('role_id') }} </option>
	                      		@foreach ($users as $ka)
	                      			<option  value="{{$ka->id}}">{{$ka->role}}</option>
	                      		@endforeach
	                    	</select>
						</div>
					</div>
	                <div class="form-group row">
	                  	<div class="col-md-3">
							<label> Menu Parent </label>
						</div>
						<div class="col-md-9">
							<select class="form-control" name="menu_parent" required>
	                      		<option selected> {{ old('menu_parent') }} </option>
	                      		@foreach ($setting_submenu2 as $ka)
	                      			<option  value="{{$ka->id}}">{{$ka->menu_label}} ({{$ka->role_id}})</option>
	                      		@endforeach
	                    	</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama Menu </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="menu_label" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama URL </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="menu_url" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama Icon </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="menu_icon" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group row">
	                  	<div class="col-md-3">
							<label> Buat Turunan  </label>
						</div>
						<div class="col-md-9">
							<select class="form-control" name="alt_url" required>
	                      		<option selected> {{ old('alt_url') }} </option>
	                      			<option  value="right fas fa-angle-left">Ya</option>
	                      			<option  value="#">Tidak</option>
	                    	</select>
						</div>
					</div>
					<div class="form-group row">
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

<!-- Modal Menu ------------------------------------------------- -->
<div class="modal fade" id="menu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> <b> Tambah Menu </b> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{url('setting_menu')}}/{{('tambah')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}

					<input type="hidden" name="menu_parent" value="0">
					<input type="hidden" name="sub_menu" value="0">
					<div class="form-group row">
	                  	<div class="col-md-3">
							<label> Role Menu </label>
						</div>
						<div class="col-md-9">
							<select class="form-control" name="role_id" required>
	                      		<option selected> {{ old('role_id') }} </option>
	                      		@foreach ($users as $ka)
	                      			<option  value="{{$ka->id}}">{{$ka->role}}</option>
	                      		@endforeach
	                    	</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama Menu </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="menu_label" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama URL </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="menu_url" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama Icon </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="menu_icon" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<!-- <div class="form-group row">
	                  	<div class="col-md-3">
							<label> Status Menu  </label>
						</div>
						<div class="col-md-9">
							<select class="form-control" name="sub_menu" required>
	                      		<option selected> {{ old('sub_menu') }} </option>
	                      			<option  value="0">Menu</option>
	                      			<option  value="1">Sub Menu</option>
	                      			<option  value="2">Sub Menu 2</option>
	                    	</select>
						</div>
					</div> -->
					<div class="form-group row">
	                  	<div class="col-md-3">
							<label> Buat Turunan  </label>
						</div>
						<div class="col-md-9">
							<select class="form-control" name="alt_url" required>
	                      		<option selected> {{ old('alt_url') }} </option>
	                      			<option  value="right fas fa-angle-left">Ya</option>
	                      			<option  value="#">Tidak</option>
	                    	</select>
						</div>
					</div>
					<div class="form-group row">
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






@endsection
