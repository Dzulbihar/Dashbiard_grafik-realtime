<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- https://getbootstrap.com/docs/4.0/getting-started/introduction/ -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
"></script>


<!-- Table -->
<script>
  $(function () {
    $("#tabel1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#tabel1_wrapper .col-md-6:eq(0)');
    $("#tabel2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#tabel2_wrapper .col-md-6:eq(0)');
    $("#tabel3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#tabel3_wrapper .col-md-6:eq(0)');
    $("#tabel4").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#tabel4_wrapper .col-md-6:eq(0)');
    $("#tabel5").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#tabel5_wrapper .col-md-6:eq(0)');
    $("#tabel6").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#tabel6_wrapper .col-md-6:eq(0)');
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $("#target_tahun").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#target_waktu").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#target_satuan").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#target_type").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>


<!-- CDN sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- data berhasil -->
<script>    
  @if (Session::has('success'))
    swal("Berhasil!", "{{Session::get('success')}}", "success");
  @endif
</script>  

<!-- data gagal -->
<script>    
  @if (Session::has('warning'))
    swal("Gagal!", "{{Session::get('warning')}}", "warning");
  @endif
</script>

<!--  syscode_tahun -->
<script>
  $('.delete_tahun_syscode').click( function(){
    var dataid = $(this).attr('data-syscode-id');
    var datavalue_number = $(this).attr('data-syscode-value_number');
    swal({
      title: "Yakin?",
      text: "Kamu akan menghapus data "+datavalue_number+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('syscode')}}/"+dataid+"/{{('hapus_tahun')}}"
      } else {
        swal("Data "+datavalue_number+" tidak jadi dihapus!", {
          icon: "error",
        });
      }
    });
  });
</script>
<!--  syscode_waktu -->
<script>
  $('.delete_waktu_syscode').click( function(){
    var dataid = $(this).attr('data-syscode-id');
    var dataket_number = $(this).attr('data-syscode-ket_number');
    swal({
      title: "Yakin?",
      text: "Kamu akan menghapus data "+dataket_number+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('syscode')}}/"+dataid+"/{{('hapus_waktu')}}"
      } else {
        swal("Data "+dataket_number+" tidak jadi dihapus!", {
          icon: "error",
        });
      }
    });
  });
</script>
<!--  syscode_type -->
<script>
  $('.delete_type_syscode').click( function(){
    var dataid = $(this).attr('data-syscode-id');
    var dataket_char = $(this).attr('data-syscode-ket_char');
    swal({
      title: "Yakin?",
      text: "Kamu akan menghapus data "+dataket_char+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('syscode')}}/"+dataid+"/{{('hapus_type')}}"
      } else {
        swal("Data "+dataket_char+" tidak jadi dihapus!", {
          icon: "error",
        });
      }
    });
  });
</script>
<!--  syscode_satuan -->
<script>
  $('.delete_satuan_syscode').click( function(){
    var dataid = $(this).attr('data-syscode-id');
    var dataket_char = $(this).attr('data-syscode-ket_char');
    swal({
      title: "Yakin?",
      text: "Kamu akan menghapus data "+dataket_char+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('syscode')}}/"+dataid+"/{{('hapus_satuan')}}"
      } else {
        swal("Data "+dataket_char+" tidak jadi dihapus!", {
          icon: "error",
        });
      }
    });
  });
</script>

<!-- user -->
<script>
  $('.delete_user').click( function(){
    var dataid = $(this).attr('data-user-id');
    var dataname = $(this).attr('data-user-name');
    swal({
      title: "Yakin?",
      text: "Kamu akan menghapus data "+dataname+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('setting_master_user')}}/"+dataid+"/{{('hapus')}}"
      } else {
        swal("Data "+dataname+" tidak jadi dihapus!", {
          icon: "error",
        });
      }
    });
  });
</script>

<!-- menu -->
<script>
  $('.delete_menu').click( function(){
    var dataid = $(this).attr('data-setting_menu-id');
    var dataname = $(this).attr('data-setting_menu-name');
    swal({
      title: "Yakin?",
      text: "Kamu akan menghapus data "+dataname+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('setting_menu')}}/"+dataid+"/{{('hapus')}}"
      } else {
        swal("Data "+dataname+" tidak jadi dihapus!", {
          icon: "error",
        });
      }
    });
  });
</script>

<!-- target_rkap -->
<script>
  $('.delete_target_rkap').click( function(){
    var dataid = $(this).attr('data-target_rkap-id');
    var datatarget_rkap = $(this).attr('data-target_rkap-target_rkap');
    swal({
      title: "Yakin?",
      text: "Kamu akan menghapus data RKAP "+datatarget_rkap+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('setting_rkap')}}/"+dataid+"/{{('hapus')}}"
      } else {
        swal("Data RKAP "+datatarget_rkap+" tidak jadi dihapus!", {
          icon: "error",
        });
      }
    });
  });
</script>

<!-- satuan_rkap -->
<script>
  $('.delete_satuan_rkap').click( function(){
    var dataid = $(this).attr('data-satuan_rkap-id');
    var datasatuan = $(this).attr('data-satuan_rkap-satuan');
    swal({
      title: "Yakin?",
      text: "Kamu akan menghapus data RKAP "+datasatuan+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "{{url('setting_satuan_rkap')}}/"+dataid+"/{{('hapus')}}"
      } else {
        swal("Data RKAP "+datasatuan+" tidak jadi dihapus!", {
          icon: "error",
        });
      }
    });
  });
</script>


<!-- ______________________________________ -->

<!-- Select2 kapal -->
<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })  
  })
</script>


