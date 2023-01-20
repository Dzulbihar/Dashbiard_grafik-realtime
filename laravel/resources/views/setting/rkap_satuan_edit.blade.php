@section('header', 'Edit RKAP')

@extends('layouts.app')

@section('content')

<br>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<form action="{{ url('setting_satuan_rkap') }}/{{$satuan_rkap->id}}/{{('update')}}" method="POST" enctype="multipart/form-data"  >
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
								<div class="col-md-12">
									<label>  Satuan </label>
									<input type="text" name="satuan" class="form-control" value="{{ $satuan_rkap->satuan}}" autocomplete="off" onkeyup="myFunction()" id="satuan_id">
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

<script>
function myFunction() {
    var satuan_id = document.getElementById("satuan_id");
    satuan_id.value = satuan_id.value.toUpperCase();
}
</script>


@endsection