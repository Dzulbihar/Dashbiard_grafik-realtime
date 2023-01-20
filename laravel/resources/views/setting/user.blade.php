@section('header', 'User')

@extends('layouts.app')

@section('content')

<br>

{{-- menampilkan error validasi --}}
@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<!-- Main Tabel -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"> Master Users
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
									<th>Role</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php $nomer = 1; ?>
								@foreach($users as $user)
								<tr>
									<th>{{ $nomer++}}</th>
									<td> {{ $user->role}} </td>
									<td> {{ $user->name}} </td>
									<td> {{ $user->email}} </td>
									<td>
										<a href="{{url('setting_user')}}/{{$user->id}}/{{('edit')}}" class="btn btn-warning text-white btn-sm">
											<i class="fas fa-pencil-alt"></i>
											Edit
										</a>
										<a href="#" class="btn btn-danger btn-sm delete_user" data-user-id="{{ $user->id}}" data-user-name="{{ $user->name}}">
											<i class="fas fa-trash"></i>
											Hapus
										</a>
									</td>
								</tr>
								@endforeach 
							</tbody>
						</table>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
							Tambah Data
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->


<!-- Modal Tambah ------------------------------------------------- -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> <b> Tambah Data User </b> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{url('setting_user')}}/{{('tambah')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="form-group row">
						<div class="col-md-3">
							<label> Role </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="role" class="form-control" placeholder="Role" autocomplete="off" value="{{ old('role') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Nama </label>
						</div>
						<div class="col-md-9">
							<input type="text" name="name" class="form-control" placeholder="Nama" autocomplete="off" value="{{ old('name') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							<label> Email </label>
						</div>
						<div class="col-md-9">
							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" autocomplete="off" value="{{ old('email') }}" required>
							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<!-- password -->
					<div class="form-group row">
						<div class="col-md-3">
							<label> Password </label>
						</div>
						<div class="col-md-9">
							<input type="password" class="form-control kata_sandi @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="off">
							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<!-- password_confirmation -->
					<div class="form-group row">
						<div class="col-md-3">
							<label> Ulangi Password </label>
						</div>
						<div class="col-md-9">
							<input type="password" class="form-control kata_sandi @error('password2') is-invalid @enderror" name="password_confirmation" placeholder="Ulangi password" required autocomplete="off">
							@error('password_confirmation')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<!-- Show password -->
					<div class="form-group row">
						<div class="col-md-3">
							<label>  </label>
						</div>
						<div class="col-md-9">
							<input type="checkbox" class="form-checkbox"> Show password
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
<!-- EndModal ------------------------------------------------- -->



<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.kata_sandi').attr('type','text');
			}else{
				$('.kata_sandi').attr('type','password');
			}
		});
	});
</script>




@endsection
