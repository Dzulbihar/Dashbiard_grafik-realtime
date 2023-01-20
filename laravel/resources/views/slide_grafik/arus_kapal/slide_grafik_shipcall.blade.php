@empty ($grafik)
  <!-- Grafik Shipcall -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('slide_grafik.arus_kapal.grafik_shipcall_full')
        </div>
      </div>        
    </div>
  </section>
    <!-- /.content -->
@else
  @if ($grafik == 'Grafik Batang')
  <!-- Grafik Shipcall -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('slide_grafik.arus_kapal.grafik_shipcall_full')
        </div>
      </div>        
    </div>
  </section>
    <!-- /.content -->
  @endif
  @if ($grafik == 'Grafik Line')
  <!-- Grafik Shipcall -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('slide_grafik.arus_kapal.grafik_line.grafik_shipcall_full')
        </div>
      </div>        
    </div>
  </section>
    <!-- /.content -->
  @endif
@endempty



