@section('header', 'Syscode')

@extends('layouts.app')

@section('content')


<br>
<!-- Main Tabel -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Master Tahun 
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="target_tahun" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tahun</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomer = 1; ?>
                @foreach($syscodes as $syscode)
                @if ($syscode->kode == 'TAHUN')
                <tr>
                  <th>{{ $nomer++}}</th>
                  <td> {{ $syscode->value_number}} </td>
                  <td>
                    <a href="{{url('syscode')}}/{{$syscode->id}}/{{('edit_tahun')}}" class="btn btn-warning text-white btn-sm">
                      <i class="fas fa-pencil-alt"></i>
                      Edit
                    </a>
                    <a href="#" class="btn btn-danger btn-sm delete_tahun_syscode" data-syscode-id="{{ $syscode->id}}" data-syscode-value_number="{{ $syscode->value_number}}">
                      <i class="fas fa-trash"></i>
                      Hapus
                    </a>
                  </td>
                </tr>
                @endif
                @endforeach 
              </tbody>
            </table>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tahun">
              Tambah Data
            </button>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Master Waktu 
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="target_waktu" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Sekon</th>
                  <th>Waktu</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomer = 1; ?>
                @foreach($syscodes as $syscode)
                @if ($syscode->kode == 'WAKTU')
                <tr>
                  <th>{{ $nomer++}}</th>
                  <td> {{ $syscode->value_number}} </td>
                  <td> {{ $syscode->ket_number}} </td>
                  <td>
                    <a href="{{url('syscode')}}/{{$syscode->id}}/{{('edit_waktu')}}" class="btn btn-warning text-white btn-sm">
                      <i class="fas fa-pencil-alt"></i>
                      Edit
                    </a>
                    <a href="#" class="btn btn-danger btn-sm delete_waktu_syscode" data-syscode-id="{{ $syscode->id}}" data-syscode-ket_number="{{ $syscode->ket_number}}">
                      <i class="fas fa-trash"></i>
                      Hapus
                    </a>
                  </td>
                </tr>
                @endif
                @endforeach 
              </tbody>
            </table>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".waktu">
              Tambah Data
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Master Type 
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="target_type" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Type</th>
                  <th>Type</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomer = 1; ?>
                @foreach($syscodes as $syscode)
                @if ($syscode->kode == 'TYPE')
                <tr>
                  <th>{{ $nomer++}}</th>
                  <td> {{ $syscode->value_char}} </td>
                  <td> {{ $syscode->ket_char}} </td>
                  <td>
                    <a href="{{url('syscode')}}/{{$syscode->id}}/{{('edit_type')}}" class="btn btn-warning text-white btn-sm">
                      <i class="fas fa-pencil-alt"></i>
                      Edit
                    </a>
                    <a href="#" class="btn btn-danger btn-sm delete_type_syscode" data-syscode-id="{{ $syscode->id}}" data-syscode-ket_char="{{ $syscode->ket_char}}">
                      <i class="fas fa-trash"></i>
                      Hapus
                    </a>
                  </td>
                </tr>
                @endif
                @endforeach 
              </tbody>
            </table>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".type">
              Tambah Data
            </button>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Master Satuan
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="target_satuan" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Satuan</th>
                  <th>Satuan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomer = 1; ?>
                @foreach($syscodes as $syscode)
                @if ($syscode->kode == 'SATUAN')
                <tr>
                  <th>{{ $nomer++}}</th>
                  <td> {{ $syscode->value_char}} </td>
                  <td> {{ $syscode->ket_char}} </td>
                  <td>
                    <a href="{{url('syscode')}}/{{$syscode->id}}/{{('edit_satuan')}}" class="btn btn-warning text-white btn-sm">
                      <i class="fas fa-pencil-alt"></i>
                      Edit
                    </a>
                    <a href="#" class="btn btn-danger btn-sm delete_satuan_syscode" data-syscode-id="{{ $syscode->id}}" data-syscode-ket_char="{{ $syscode->ket_char}}">
                      <i class="fas fa-trash"></i>
                      Hapus
                    </a>
                  </td>
                </tr>
                @endif
                @endforeach 
              </tbody>
            </table>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".satuan">
              Tambah Data
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<!-- Modal Tahun ------------------------------------------------- -->
<div class="modal fade tahun" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b> Tambah Data Tahun </b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('syscode')}}/{{('tambah_tahun')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" name="kode" value="TAHUN">
          <div class="form-group row">
            <div class="col-md-12">
              <label> Tahun </label>
              <input type="number" name="value_number" class="form-control" placeholder="Tahun" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group row">
            <!-- Tombol -->    
            <div class="col-md-12">
              <br>
              <button type="submit" class="btn btn-primary btn-sm">
                Simpan   
              </button>
              <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">Tutup</button>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- EndModal ------------------------------------------------- -->

<!-- Modal Waktu ------------------------------------------------- -->
<div class="modal fade waktu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b> Tambah Data Waktu </b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('syscode')}}/{{('tambah_waktu')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" name="kode" value="WAKTU">
          <div class="form-group row">
            <div class="col-md-12">
              <label>  Sekon  </label>
              <input type="number" name="value_number" class="form-control" placeholder="Sekon" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <label>  Waktu  </label>
              <input type="text" name="ket_number" class="form-control" placeholder="Waktu" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group row">
            <!-- Tombol -->    
            <div class="col-md-12">
              <br>
              <button type="submit" class="btn btn-primary btn-sm">
                Simpan   
              </button>
              <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">Tutup</button>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- EndModal ------------------------------------------------- -->

<!-- Modal Type ------------------------------------------------- -->
<div class="modal fade type" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b> Tambah Data Type </b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('syscode')}}/{{('tambah_type')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" name="kode" value="TYPE">
          <div class="form-group row">
            <div class="col-md-12">
              <label>  Type (char)  </label>
              <input type="text" name="value_char" class="form-control" placeholder="Type (char)" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <label>  Type (keterangan)  </label>
              <input type="text" name="ket_char" class="form-control" placeholder="Type (keterangan)" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group row">
            <!-- Tombol -->    
            <div class="col-md-12">
              <br>
              <button type="submit" class="btn btn-primary btn-sm">
                Simpan   
              </button>
              <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">Tutup</button>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- EndModal ------------------------------------------------- -->

<!-- Modal Satuan ------------------------------------------------- -->
<div class="modal fade satuan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b> Tambah Data Satuan </b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('syscode')}}/{{('tambah_satuan')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" name="kode" value="SATUAN">
          <div class="form-group row">
            <div class="col-md-12">
              <label>  Satuan (char)  </label>
              <input type="text" name="value_char" class="form-control" placeholder="Satuan (char)" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <label>  Satuan (keterangan)  </label>
              <input type="text" name="ket_char" class="form-control" placeholder="Satuan (keterangan)" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group row">
            <!-- Tombol -->    
            <div class="col-md-12">
              <br>
              <button type="submit" class="btn btn-primary btn-sm">
                Simpan   
              </button>
              <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">Tutup</button>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- EndModal ------------------------------------------------- -->



@endsection
