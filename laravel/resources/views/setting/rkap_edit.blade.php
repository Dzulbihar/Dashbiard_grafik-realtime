@section('header', 'Edit RKAP')

@extends('layouts.app')

@section('content')

<br>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<form action="{{ url('setting_rkap') }}/{{$target_rkap_perbulan->id}}/{{('update')}}" method="POST" enctype="multipart/form-data"  >
			{{csrf_field()}}
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"> RKAP </h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group row">
								<div class="col-md-6">
									<label>  Tahun </label>
									<input type="number" name="tahun" class="form-control" value="{{ $target_rkap_perbulan->tahun}}">
									<!-- <select name="tahun" class="form-control">
										<option value="{{ $target_rkap_perbulan->tahun}}">
											{{ $target_rkap_perbulan->tahun}}
										</option>
										@foreach($select_tahun as $tahun)
										<option value="{{$tahun->value_number}}">
											{{$tahun->value_number}}
										</option>
										@endforeach
									</select>  -->
								</div>
								<div class="col-md-6">
									<label>  Bulan </label>
									<select name="bulan" class="form-control" required>
										<option value="01" @if($target_rkap_perbulan->bulan == '01') selected @endif> Januari </option>
										<option value="02" @if($target_rkap_perbulan->bulan == '02') selected @endif> Februari </option>
										<option value="03" @if($target_rkap_perbulan->bulan == '03') selected @endif> Maret </option>
										<option value="04" @if($target_rkap_perbulan->bulan == '04') selected @endif> April </option>
										<option value="05" @if($target_rkap_perbulan->bulan == '05') selected @endif> Mei </option>
										<option value="06" @if($target_rkap_perbulan->bulan == '06') selected @endif> Juni </option>
										<option value="07" @if($target_rkap_perbulan->bulan == '07') selected @endif> Juli </option>
										<option value="08" @if($target_rkap_perbulan->bulan == '08') selected @endif> Agustus </option>
										<option value="09" @if($target_rkap_perbulan->bulan == '09') selected @endif> September </option>
										<option value="10" @if($target_rkap_perbulan->bulan == '10') selected @endif> Oktober </option>
										<option value="11" @if($target_rkap_perbulan->bulan == '11') selected @endif> November </option>
										<option value="12" @if($target_rkap_perbulan->bulan == '12') selected @endif> Desember </option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label>  Target RKAP </label>
									<input type="number" name="target_rkap" class="form-control" value="{{ $target_rkap_perbulan->target_rkap}}">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label> Satuan </label>
									<select name="satuan" class="form-control">
										<option> {{ $target_rkap_perbulan->satuan}} </option>
										@foreach($pilih_satuan_rkap as $satuan)
										<option value="{{$satuan->satuan}}">
											{{$satuan->satuan}}
										</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label> Type </label>
									<select name="type" class="form-control">
										<option value="DOM" @if($target_rkap_perbulan->type == 'DOM') selected @endif> Domestik </option>
										<option value="INT" @if($target_rkap_perbulan->type == 'INT') selected @endif> International </option>
										<!-- @foreach($select_type as $type)
										<option value="{{$type->value_char}}">
											{{$type->ket_char}}
										</option>
										@endforeach -->
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-sm">
										Simpan
									</button>
									<a href="{{url('/setting_rkap')}}" class="btn btn-default btn-sm float-right">Tutup</a>
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