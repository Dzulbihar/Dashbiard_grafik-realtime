@section('header', 'Grafik Kunjungan Kapal')

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
            <form action="{{url('/cari_grafik_kunjungan_kapal')}}" method="GET">
              <p class="card-title"> 
                <b>Tahun</b> 
                <select name="cari_tahun" id="cari_tahun" class="btn btn-default btn-sm">
                  @foreach($tahun_grafik_kunjungan_kapal as $tahun)
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


<!-- Grafik Shipcall -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_kunjungan_kapal_domestik"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_kunjungan_kapal_international"></div>
            </figure>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->

<!-- Tabel -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Kunjungan Kapal Domestik
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
                  <th>Bulan</th>
                  <th>Domestik <?php echo $tahun_ini; ?></th>
                  <th>RKAP</th>
                  <th>Selisih</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_kunjungan_kapal_domestik as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> {{ $data->shipcall}} </td>
                  <td> {{ $data->target_rkap}} </td>
                  <td>  
                    <?php  
                      $shipcall = $data->shipcall;
                      $target_rkap = $data->target_rkap;
                      $hasil= $shipcall-$target_rkap;
                      echo $hasil;
                    ?> 
                  </td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
              Data Kunjungan Kapal International
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
                  <th>Bulan</th>
                  <th>International <?php echo $tahun_ini; ?></th>
                  <th>RKAP</th>
                  <th>Selisih</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_kunjungan_kapal_international as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> {{ $data->shipcall}} </td>
                  <td> {{ $data->target_rkap}} </td>
                  <td>  
                    <?php  
                      $shipcall = $data->shipcall;
                      $target_rkap = $data->target_rkap;
                      $hasil= $shipcall-$target_rkap;
                      echo $hasil;
                    ?> 
                  </td>
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
Highcharts.chart('grafik_kunjungan_kapal_domestik', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Grafik Kunjungan Kapal Domestik'
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
    },
    xAxis: {
        categories: [ 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ],
        accessibility: {
            description: 'Months of the year'
        }
    },
    yAxis: {
        title: {
            text: 'Nilai'
        },
        labels: {
            formatter: function () {
                return this.value + '';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        },
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:,.0f}'
        }
      }
    },
    series: [
      {
          name: '<?php echo $tahun_lalu; ?>',
          color: '#0002d5',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT BULAN, (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM' group by BULAN order by BULAN ASC
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SHIPCALL'] . ',';
              }
            ?>
            ]

      },
      {
          name: '<?php echo $tahun_ini; ?>',
          color: '#0fc902',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT BULAN, (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' group by BULAN order by BULAN ASC
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SHIPCALL'] . ',';
              }
            ?>
            ]

      }, 
      {
          name: 'RKAP',
          color: '#ff0a18',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE Tahun=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='SHIPCALL' ORDER BY BULAN ASC
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['TARGET_RKAP'] . ',';
              }
            ?>
            ]
      }
    ]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafik_kunjungan_kapal_international', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Grafik Kunjungan Kapal International'
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
    },
    xAxis: {
        categories: [ 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ],
        accessibility: {
            description: 'Months of the year'
        }
    },
    yAxis: {
        title: {
            text: 'Nilai'
        },
        labels: {
            formatter: function () {
                return this.value + '';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        },
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:,.0f}'
        }
      }
    },
    series: [
      {
          name: '<?php echo $tahun_lalu; ?>',
          color: '#0002d5',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT BULAN, (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT' group by BULAN order by BULAN ASC
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SHIPCALL'] . ',';
              }
            ?>
            ]
      },
      {
          name: '<?php echo $tahun_ini; ?>',
          color: '#0fc902',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT BULAN, (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' group by BULAN order by BULAN ASC
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SHIPCALL'] . ',';
              }
            ?>
            ]
      }, 
      {
          name: 'RKAP',
          color: '#ff0a18',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE Tahun=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='SHIPCALL' ORDER BY BULAN ASC
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['TARGET_RKAP'] . ',';
              }
            ?>
            ]
      }
    ]
});
</script>

@endsection