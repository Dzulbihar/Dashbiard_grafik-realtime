@section('header', 'Edit setting_menu')

@extends('layouts.app')

@section('content')

<br>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<form action="{{ url('setting_menu') }}/{{$setting_menu->id}}/{{('update')}}" method="POST" enctype="multipart/form-data"  >
		{{csrf_field()}}
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"> Edit Data Menu </h3>
						</div>
						<div class="card-body">
							<div class="form-group row">
			                  	<div class="col-md-2">
									<label> Role Menu </label>
								</div>
								<div class="col-md-10">
									<select class="form-control" name="role_id" required>
			                      		<option selected> {{ $setting_menu->role_id}} </option>
			                      		@foreach ($users as $ka)
			                      			<option  value="{{$ka->id}}">{{$ka->role}} </option>
			                      		@endforeach
			                    	</select>
								</div>
							</div>
							<div class="form-group row">
			                  	<div class="col-md-2">
									<label> Menu Parent </label>
								</div>
								<div class="col-md-10">
									<select class="form-control" name="menu_parent" required>
			                      		<option selected value="{{$setting_menu->menu_parent}}"> {{ $setting_menu->menu_label}} </option>
			                      		@foreach ($menu_parent as $ka)
			                      			<option  value="{{$ka->menu_parent}}">{{$ka->menu_label}} (sub menu = {{$ka->sub_menu}})</option>
			                      		@endforeach
			                    	</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label> Nama Menu </label>
								</div>
								<div class="col-md-10">
									<input type="text" name="menu_label" class="form-control" value="{{ $setting_menu->menu_label}}">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label> Nama URL </label>
								</div>
								<div class="col-md-10">
									<input type="text" name="menu_url" class="form-control" value="{{ $setting_menu->menu_url}}">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label> Nama Icon </label>
								</div>
								<div class="col-md-10">
									<input type="text" name="menu_icon" class="form-control" value="{{ $setting_menu->menu_icon}}">
								</div>
							</div>
							<div class="form-group row">
			                  	<div class="col-md-2">
									<label> Buat Turunan </label>
								</div>
								<div class="col-md-10">
									<select class="form-control" name="alt_url" required>
										<option selected> {{ $setting_menu->alt_url}} </option>
			                      		<option value="right fas fa-angle-left" @if($setting_menu->alt_url == 'right fas fa-angle-left') selected @endif> Ya </option>
			                      		<option value="" @if($setting_menu->alt_url == '') selected @endif> Tidak </option>
			                    	</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-sm">
										Simpan
									</button>
									<a href="{{url('/setting_menu')}}" class="btn btn-default btn-sm float-right">Tutup</a>
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
