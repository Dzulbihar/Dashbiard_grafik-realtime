<!-- Judul Arus -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 align="center"> 
              <b>
                Laporan Nota
                <?php 
                  if ($satuan=='JML_BOX') {
                      echo 'BOX ';
                  }elseif ($satuan=='JML_TEUS') {
                        echo 'TEUS ';
                  }else{
                       echo 'Pendapatan ';
                  } 
                ?>
              </b>
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->


@empty ($grafik)
  <!-- Grafik BOX -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('slide_grafik.nota.grafik_nota')
        </div>
      </div>        
    </div>
  </section>
  <!-- /.content -->
@else
  @if ($grafik == 'Grafik Batang')
  <!-- Grafik BOX -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('slide_grafik.nota.grafik_nota')
        </div>
      </div>        
    </div>
  </section>
  <!-- /.content -->
  @endif
  @if ($grafik == 'Grafik Line')
  <!-- Grafik BOX -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('slide_grafik.nota.grafik_line.grafik_nota')
        </div>
      </div>        
    </div>
  </section>
  <!-- /.content -->
  @endif
@endempty