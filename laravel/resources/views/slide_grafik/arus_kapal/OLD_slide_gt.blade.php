@empty ($grafik)
  <!-- Grafik GT -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          @include('slide_grafik.arus_kapal.grafik_gt')
        </div>
        <div class="col-md-4">
          @include('slide_grafik.arus_kapal.grafik_gt_dom')
        </div>
        <div class="col-md-4">
          @include('slide_grafik.arus_kapal.grafik_gt_int')
        </div>
      </div>        
    </div>
  </section>
    <!-- /.content -->
@else
  @if ($grafik == 'Grafik Batang')
  <!-- Grafik GT -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          @include('slide_grafik.arus_kapal.grafik_gt')
        </div>
        <div class="col-md-4">
          @include('slide_grafik.arus_kapal.grafik_gt_dom')
        </div>
        <div class="col-md-4">
          @include('slide_grafik.arus_kapal.grafik_gt_int')
        </div>
      </div>        
    </div>
  </section>
    <!-- /.content -->
  @endif
  @if ($grafik == 'Grafik Line')
  <!-- Grafik GT -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          @include('slide_grafik.arus_kapal.grafik_line.grafik_gt')
        </div>
        <div class="col-md-4">
          @include('slide_grafik.arus_kapal.grafik_line.grafik_gt_dom')
        </div>
        <div class="col-md-4">
          @include('slide_grafik.arus_kapal.grafik_line.grafik_gt_int')
        </div>
      </div>        
    </div>
  </section>
    <!-- /.content -->
  @endif
@endempty