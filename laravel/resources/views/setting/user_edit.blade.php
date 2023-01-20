@section('header', 'Edit User')

@extends('layouts.app')

@section('content')

<br>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<form action="{{ url('setting_user') }}/{{$user->id}}/{{('update')}}" method="POST" enctype="multipart/form-data"  >
		{{csrf_field()}}
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"> Edit Data User </h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<input type="hidden" name="id" value="{{ $user->id}}">
							<div class="form-group row">
								<div class="col-md-2">
									<label> Nama </label>
								</div>
								<div class="col-md-10">
									<select class="form-control" name="role" required>
										<option selected> {{ $user->role}} </option>
										<option value="admin" @if($user->role == 'admin') selected @endif> Admin </option>
										<option value="user" @if($user->role == 'user') selected @endif> User </option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label> Nama </label>
								</div>
								<div class="col-md-10">
									<input type="text" name="name" class="form-control" value="{{ $user->name}}">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label> Email </label>
								</div>
								<div class="col-md-10">
									<input type="email" name="email" class="form-control" value="{{ $user->email}}">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label> Password </label>
								</div>
								<div class="col-md-10">
									<input readonly class="form-control" value="{{ $user->password}}">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-sm">
										Simpan
									</button>
									<a href="{{url('/setting_user')}}" class="btn btn-default btn-sm float-right">Tutup</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>

@endsection
