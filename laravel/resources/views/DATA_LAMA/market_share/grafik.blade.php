@section('header', 'Grafik Market Share')

@extends('layouts.app')

@section('content')

<?php 
  $koneksi=oci_connect ('DASHBOARDGRAFIK','123456','LOCALHOST/orcl'); 
?>

<br>

<!-- Cari Tahun-->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <form action="{{url('/cari_grafik_market_share')}}" method="GET">
              <p class="card-title"> 
                <b>Tahun</b> 
                <select name="cari_tahun" id="cari_tahun" class="btn btn-default btn-sm">
                  @foreach($tahun_grafik_market_share as $tahun)
                  <option value="{{$tahun->tahun}}">
                    {{$tahun->tahun}}
                  </option>
                  @endforeach
                </select>
                <b>Bulan</b> 
                <select name="cari_bulan" id="cari_bulan" class="btn btn-default btn-sm">
                  <option value="01"> Januari </option>
                  <option value="02"> Februari </option>
                  <option value="03"> Maret </option>
                  <option value="04"> April </option>
                  <option value="05"> Mei </option>
                  <option value="06"> Juni </option>
                  <option value="07"> Juli </option>
                  <option value="08"> Agustus </option>
                  <option value="09"> September </option>
                  <option value="10"> Oktober </option>
                  <option value="11"> November </option>
                  <option value="12"> Desember </option>
                </select>
                <input type="submit" value="Cari" class="btn btn-default btn-sm">
                <?php 
                if(isset($_GET['cari_tahun'],$_GET['cari_bulan'],$_GET['pilih_grafik'])){
                  $cari_tahun = $_GET['cari_tahun'];
                  $cari_bulan = $_GET['cari_bulan'];
                  $pilih_grafik = $_GET['pilih_grafik'];
                }
                ?>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->


<!-- Grafik Box Market Share -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_market_share_box_domestik"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_market_share_box_international"></div>
            </figure>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Tabel Box -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Market Share Box Domestik
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Jumlah</th>
                  <th>Agent</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_market_share_box_domestik as $data)
                <tr>
                  <td> {{ $data->jml_box_total}} </td>
                  <td> {{ $data->agent}} </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Market Share Box International
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Jumlah</th>
                  <th>Agent</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_market_share_box_international as $data)
                <tr>
                  <td> {{ $data->jml_box_total}} </td>
                  <td> {{ $data->agent}} </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<!-- Grafik Teus Market Share -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_market_share_teus_domestik"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_market_share_teus_international"></div>
            </figure>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Tabel Teus -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Market Share Teus Domestik
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel3" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Jumlah</th>
                  <th>Agent</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_market_share_teus_domestik as $data)
                <tr>
                  <td> {{ $data->jml_teus_total}} </td>
                  <td> {{ $data->agent}} </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Market Share Teus International
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel4" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Jumlah</th>
                  <th>Agent</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_market_share_teus_international as $data)
                <tr>
                  <td> {{ $data->jml_teus_total}} </td>
                  <td> {{ $data->agent}} </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<!-- Grafik Pendapatan Market Share -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_market_share_pendapatan_domestik"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_market_share_pendapatan_international"></div>
            </figure>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Tabel Pendapatan -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Market Share Pendapatan Domestik
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel5" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Jumlah</th>
                  <th>Agent</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_market_share_pendapatan_domestik as $data)
                <tr>
                  <td> {{ $data->total_pendapatan}} </td>
                  <td> {{ $data->agent}} </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Market Share Pendapatan International
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="tabel6" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Agent</th>
                  <th>Jumlah</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_market_share_pendapatan_international as $data)
                <tr>
                  <td> {{ $data->agent}} </td>
                  <td> {{ $data->total_pendapatan}} </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});
Highcharts.chart('grafik_market_share_box_domestik', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Box Domestik'
    },
    subtitle: {
        align: 'center',
        text: 'Tahun <?php echo $tahun_ini ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:,.2f} %</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:,.2f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'BOX Domestik',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL
                FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER 
                WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' 
                GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL DESC) WHERE rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $agent = $row['AGENT'];
              $box = $row['JML_BOX_TOTAL'];

              $query1 = oci_parse($koneksi,"SELECT JML_BOX_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT ) ORDER BY JML_BOX_TOTAL DESC ) WHERE rownum <=10 AND AGENT='$agent'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['JML_BOX_TOTAL'];
              }
          ?>
              [ 
              '<?php echo $agent,'[', $box, '] '  ?>', 
              <?php echo $jumlah; ?>,
              ],
          <?php
            }
          ?>

          ]
    }]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafik_market_share_box_international', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Box International'
    },
    subtitle: {
        align: 'center',
        text: 'Tahun <?php echo $tahun_ini ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:,.2f} %</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:,.2f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'BOX International',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL
                FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER 
                WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' 
                GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL DESC) WHERE rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $agent = $row['AGENT'];
              $box = $row['JML_BOX_TOTAL'];

              $query1 = oci_parse($koneksi,"SELECT JML_BOX_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT ) ORDER BY JML_BOX_TOTAL DESC ) WHERE rownum <=10 AND AGENT='$agent'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['JML_BOX_TOTAL'];
              }
          ?>
              [ 
              '<?php echo $agent,'[', $box, '] '  ?>', 
              <?php echo $jumlah; ?>,
              ],
          <?php
            }
          ?>

          ]
    }]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafik_market_share_teus_domestik', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Teus Domestik'
    },
    subtitle: {
        align: 'center',
        text: 'Tahun <?php echo $tahun_ini ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:,.2f} %</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:,.2f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Teus Domestik',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_TEUS_EXPORT+JML_TEUS_IMPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $agent = $row['AGENT'];
              $box = $row['JML_TEUS_TOTAL'];

              $query1 = oci_parse($koneksi,"SELECT JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_TEUS_EXPORT+JML_TEUS_IMPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT ) ORDER BY JML_TEUS_TOTAL DESC ) WHERE rownum <=10 AND AGENT='$agent'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['JML_TEUS_TOTAL'];
              }
          ?>
              [ 
              '<?php echo $agent,'[', $box, '] '  ?>', 
              <?php echo $jumlah; ?>,
              ],
          <?php
            }
          ?>

          ]
    }]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafik_market_share_teus_international', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Teus International'
    },
    subtitle: {
        align: 'center',
        text: 'Tahun <?php echo $tahun_ini ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:,.2f} %</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:,.2f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'TEUS International',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_TEUS_EXPORT+JML_TEUS_IMPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $agent = $row['AGENT'];
              $box = $row['JML_TEUS_TOTAL'];

              $query1 = oci_parse($koneksi,"SELECT JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_TEUS_EXPORT+JML_TEUS_IMPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT ) ORDER BY JML_TEUS_TOTAL DESC ) WHERE rownum <=10 AND AGENT='$agent'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['JML_TEUS_TOTAL'];
              }
          ?>
              [ 
              '<?php echo $agent,'[', $box, '] '  ?>', 
              <?php echo $jumlah; ?>,
              ],
          <?php
            }
          ?>

          ]
    }]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafik_market_share_pendapatan_domestik', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Pendapatan Domestik'
    },
    subtitle: {
        align: 'center',
        text: 'Tahun <?php echo $tahun_ini ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:,.2f} %</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:,.2f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Pendapatan Domestik',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN desc) where rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $agent = $row['AGENT'];
              $box = $row['TOTAL_PENDAPATAN'];

              $query1 = oci_parse($koneksi,"SELECT TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT ) order by TOTAL_PENDAPATAN desc ) where rownum <=10 and AGENT='$agent'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['TOTAL_PENDAPATAN'];
              }

          ?>
              [ 
              '<?php echo $agent,'[', $box, '] '  ?>', 
              <?php echo $jumlah; ?>,
              ],
          <?php
            }
          ?>

          ]
    }]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafik_market_share_pendapatan_international', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Pendapatan International'
    },
    subtitle: {
        align: 'center',
        text: 'Tahun <?php echo $tahun_ini ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:,.2f} %</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:,.2f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Pendapatan International',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN desc) where rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $agent = $row['AGENT'];
              $box = $row['TOTAL_PENDAPATAN'];

              $query1 = oci_parse($koneksi,"SELECT TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT ) order by TOTAL_PENDAPATAN desc ) where rownum <=10 and AGENT='$agent'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['TOTAL_PENDAPATAN'];
              }

          ?>
              [ 
              '<?php echo $agent,'[', $box, '] '  ?>', 
              <?php echo $jumlah; ?>,
              ],
          <?php
            }
          ?>

          ]
    }]
});
</script>


@endsection