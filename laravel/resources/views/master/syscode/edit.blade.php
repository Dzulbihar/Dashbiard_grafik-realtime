@section('header', 'Edit Syscode')

@extends('layouts.app')

@section('content')

<br>

@if ($syscode->kode == 'TAHUN')
	<!-- Tahun -->
	<section class="content">
		<div class="container-fluid">
			<form action="{{ url('syscode') }}/{{$syscode->id}}/{{('update_tahun')}}" method="POST" enctype="multipart/form-data"  >
			{{csrf_field()}}
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"> Edit Data Tahun </h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<input type="hidden" name="id" value="{{ $syscode->id}}">
								<input type="hidden" name="kode" value="{{ $syscode->kode}}">
								<div class="form-group row">
									<div class="col-md-12">
										<label>  Tahun </label>
										<input type="number" name="value_number" class="form-control" value="{{ $syscode->value_number}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<button type="submit" class="btn btn-primary btn-sm">
											Simpan
										</button>
									</div>
									<div class="col-md-6">
										<a href="{{url('/syscode')}}" class="btn btn-secondary btn-sm float-right">Tutup</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
@endif

@if ($syscode->kode == 'WAKTU')
	<!-- Waktu -->
	<section class="content">
		<div class="container-fluid">
			<form action="{{ url('syscode') }}/{{$syscode->id}}/{{('update_waktu')}}" method="POST" enctype="multipart/form-data"  >
						{{csrf_field()}}
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"> Edit Data Waktu </h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<input type="hidden" name="id" value="{{ $syscode->id}}">
								<input type="hidden" name="kode" value="{{ $syscode->kode}}">
								<div class="form-group row">
									<div class="col-md-12">
										<label>  Sekon </label>
										<input type="number" name="value_number" class="form-control" value="{{ $syscode->value_number}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<label>  Waktu </label>
										<input type="text" name="ket_number" class="form-control" value="{{ $syscode->ket_number}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<button type="submit" class="btn btn-primary btn-sm">
											Simpan
										</button>
									</div>
									<div class="col-md-6">
										<a href="{{url('/syscode')}}" class="btn btn-secondary btn-sm float-right">Tutup</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
@endif

@if ($syscode->kode == 'TYPE')
	<!-- Waktu -->
	<section class="content">
		<div class="container-fluid">
			<form action="{{ url('syscode') }}/{{$syscode->id}}/{{('update_type')}}" method="POST" enctype="multipart/form-data"  >
						{{csrf_field()}}
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"> Edit Data Type </h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<input type="hidden" name="id" value="{{ $syscode->id}}">
								<input type="hidden" name="kode" value="{{ $syscode->kode}}">
								<div class="form-group row">
									<div class="col-md-12">
										<label>  Type (char) </label>
										<input type="text" name="value_char" class="form-control" value="{{ $syscode->value_char}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<label>  Type (keterangan) </label>
										<input type="text" name="ket_char" class="form-control" value="{{ $syscode->ket_char}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<button type="submit" class="btn btn-primary btn-sm">
											Simpan
										</button>
									</div>
									<div class="col-md-6">
										<a href="{{url('/syscode')}}" class="btn btn-secondary btn-sm float-right">Tutup</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
@endif

@if ($syscode->kode == 'SATUAN')
	<!-- Waktu -->
	<section class="content">
		<div class="container-fluid">
			<form action="{{ url('syscode') }}/{{$syscode->id}}/{{('update_satuan')}}" method="POST" enctype="multipart/form-data"  >
						{{csrf_field()}}
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"> Edit Data Satuan </h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<input type="hidden" name="id" value="{{ $syscode->id}}">
								<input type="hidden" name="kode" value="{{ $syscode->kode}}">
								<div class="form-group row">
									<div class="col-md-12">
										<label>  Satuan (char) </label>
										<input type="text" name="value_char" class="form-control" value="{{ $syscode->value_char}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<label>  Satuan (keterangan) </label>
										<input type="text" name="ket_char" class="form-control" value="{{ $syscode->ket_char}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<button type="submit" class="btn btn-primary btn-sm">
											Simpan
										</button>
									</div>
									<div class="col-md-6">
										<a href="{{url('/syscode')}}" class="btn btn-secondary btn-sm float-right">Tutup</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
@endif


@endsection