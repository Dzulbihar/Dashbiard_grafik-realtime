@section('header', 'Grafik Arus Domestik')

@extends('layouts.app')

@section('content')

<?php 
$koneksi=oci_connect ('DASHBOARDGRAFIK','123456','LOCALHOST/orcl'); 
?>

<br>

<!-- Cari -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <form action="{{url('/cari_grafik_arus_petikemas')}}" method="GET">
              <p class="card-title"> 
                <b>Tahun</b> 
                <select name="cari_tahun" id="cari_tahun" class="btn btn-default btn-sm">
                  @foreach($tahun_grafik_arus_petikemas as $tahun)
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
                if(isset($_GET['cari_tahun'],$_GET['cari_bulan'])){
                  $cari_tahun = $_GET['cari_tahun'];
                  $cari_bulan = $_GET['cari_bulan'];
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


<!-- Grafik Box -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_arus_petikemas_box_domestik"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_arus_petikemas_box_international"></div>
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
              Data Arus Petikemas Box Domestik
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
                  <th>Box Domestik Import <?php echo $tahun_ini; ?> </th>
                  <th>Box Domestik Export <?php echo $tahun_ini; ?> </th>
                  <th>Box Domestik Total <?php echo $tahun_ini; ?> </th>
                  <th>RKAP</th>
                  <th>Selisih</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_arus_petikemas_box_domestik as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> {{ $data->jml_box_import}} </td>
                  <td> {{ $data->jml_box_export}} </td>
                  <td> {{ $data->jml_box}} </td>
                  <td> {{ $data->target_rkap}} </td>
                  <td>  
                    <?php  
                      $jml_box = $data->jml_box;
                      $target_rkap = $data->target_rkap;
                      $hasil= $jml_box-$target_rkap;
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
          <div class="card-header">
            <h3 class="card-title"> 
              Data Arus Petikemas Box International
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
                  <th>Box International Import <?php echo $tahun_ini; ?> </th>
                  <th>Box International Export <?php echo $tahun_ini; ?> </th>
                  <th>Box International Total <?php echo $tahun_ini; ?> </th>
                  <th>RKAP</th>
                  <th>Selisih</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_arus_petikemas_box_international as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> {{ $data->jml_box_import}} </td>
                  <td> {{ $data->jml_box_export}} </td>
                  <td> {{ $data->jml_box}} </td>
                  <td> {{ $data->target_rkap}} </td>
                  <td>  
                    <?php  
                      $jml_box = $data->jml_box;
                      $target_rkap = $data->target_rkap;
                      $hasil= $jml_box-$target_rkap;
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

<!-- Grafik Teus -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_arus_petikemas_teus_domestik"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_arus_petikemas_teus_international"></div>
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
              Data Arus Petikemas Teus Domestik
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
                  <th>Bulan</th>
                  <th>Teus Domestik Import <?php echo $tahun_ini; ?> </th>
                  <th>Teus Domestik Export <?php echo $tahun_ini; ?> </th>
                  <th>Teus Domestik Total <?php echo $tahun_ini; ?> </th>
                  <th>RKAP</th>
                  <th>Selisih</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_arus_petikemas_teus_domestik as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> {{ $data->jml_teus_import}} </td>
                  <td> {{ $data->jml_teus_export}} </td>
                  <td> {{ $data->jml_teus}} </td>
                  <td> {{ $data->target_rkap}} </td>
                  <td>  
                    <?php  
                      $jml_teus = $data->jml_teus;
                      $target_rkap = $data->target_rkap;
                      $hasil= $jml_teus-$target_rkap;
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
          <div class="card-header">
            <h3 class="card-title"> 
              Data Arus Petikemas Teus International
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
                  <th>Bulan</th>
                  <th>Teus International Import <?php echo $tahun_ini; ?> </th>
                  <th>Teus International Export <?php echo $tahun_ini; ?> </th>
                  <th>Teus International Total <?php echo $tahun_ini; ?> </th>
                  <th>RKAP</th>
                  <th>Selisih</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_arus_petikemas_teus_international as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> {{ $data->jml_teus_import}} </td>
                  <td> {{ $data->jml_teus_export}} </td>
                  <td> {{ $data->jml_teus}} </td>
                  <td> {{ $data->target_rkap}} </td>
                  <td>  
                    <?php  
                      $jml_teus = $data->jml_teus;
                      $target_rkap = $data->target_rkap;
                      $hasil= $jml_teus-$target_rkap;
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

<!-- Grafik Pendapatan -->
<section class="content">
  <div class="container-fluid">
    <div class="row">      
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_arus_petikemas_pendapatan_domestik"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_arus_petikemas_pendapatan_international"></div>
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
              Data Arus Petikemas Pendapatan Domestik
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
                  <th>Bulan</th>
                  <th>Total Pendapatan Domestik <?php echo $tahun_ini; ?> </th>
                  <th>RKAP</th>
                  <th>Selisih</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_arus_petikemas_pendapatan_domestik as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> {{ $data->total_pendapatan}} </td>
                  <td> {{ $data->target_rkap}} </td>
                  <td>  
                    <?php  
                      $total_pendapatan = $data->total_pendapatan;
                      $target_rkap = $data->target_rkap;
                      $hasil= $total_pendapatan-$target_rkap;
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
          <div class="card-header">
            <h3 class="card-title"> 
              Data Arus Petikemas Pendapatan International
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
                  <th>Bulan</th>
                  <th>Total Pendapatan International <?php echo $tahun_ini; ?> </th>
                  <th>RKAP</th>
                  <th>Selisih</th>
                </tr>
              </thead>

              <tbody>
                <?php $nomer = 1; ?>
                @foreach($data_arus_petikemas_pendapatan_international as $data)
                <tr>
                  <td> {{ $data->bulan}} </td>
                  <td> {{ $data->total_pendapatan}} </td>
                  <td> {{ $data->target_rkap}} </td>
                  <td>  
                    <?php  
                      $total_pendapatan = $data->total_pendapatan;
                      $target_rkap = $data->target_rkap;
                      $hasil= $total_pendapatan-$target_rkap;
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
Highcharts.chart('grafik_arus_petikemas_box_domestik', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 
        'Grafik Arus Petikemas Box Domestik' 
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
    },
    xAxis: {
        categories: [ 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
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

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#0002d5',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_BOX_IMPORT+JML_BOX_EXPORT) AS JML_BOX, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_BOX'] . ',';
              }
            ?>
            ]
    }, {
        name: '<?php echo $tahun_ini ?>',
        color: '#0fc902',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_BOX_IMPORT+JML_BOX_EXPORT) AS JML_BOX, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_BOX'] . ',';
              }
            ?>
            ]
    }
    , {
        name: 'RKAP',
        color: '#ff0a18',
        data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='BOX' ORDER BY BULAN ASC
                "
              );
              oci_execute($query4);
              while(($arus = oci_fetch_array($query4, OCI_BOTH)) != false)
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
Highcharts.chart('grafik_arus_petikemas_box_international', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 
        'Grafik Arus Petikemas Box International' 
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
    },
    xAxis: {
        categories: [ 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
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

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#0002d5',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_BOX_IMPORT+JML_BOX_EXPORT) AS JML_BOX, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_BOX'] . ',';
              }
            ?>
            ]
    }, {
        name: '<?php echo $tahun_ini ?>',
        color: '#0fc902',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_BOX_IMPORT+JML_BOX_EXPORT) AS JML_BOX, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_BOX'] . ',';
              }
            ?>
            ]
    }
    , {
        name: 'RKAP',
        color: '#ff0a18',
        data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='BOX' ORDER BY BULAN ASC
                "
              );
              oci_execute($query4);
              while(($arus = oci_fetch_array($query4, OCI_BOTH)) != false)
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
Highcharts.chart('grafik_arus_petikemas_teus_domestik', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 
        'Grafik Arus Petikemas Teus Domestik' 
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
    },
    xAxis: {
        categories: [ 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
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

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#0002d5',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_TEUS'] . ',';
              }
            ?>
            ]
    }, {
        name: '<?php echo $tahun_ini ?>',
        color: '#0fc902',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_TEUS'] . ',';
              }
            ?>
            ]
    }
    , {
        name: 'RKAP',
        color: '#ff0a18',
        data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='TEUS' ORDER BY BULAN ASC
                "
              );
              oci_execute($query4);
              while(($arus = oci_fetch_array($query4, OCI_BOTH)) != false)
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
Highcharts.chart('grafik_arus_petikemas_teus_international', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 
        'Grafik Arus Petikemas Teus International' 
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
    },
    xAxis: {
        categories: [ 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
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

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#0002d5',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_TEUS'] . ',';
              }
            ?>
            ]
    }, {
        name: '<?php echo $tahun_ini ?>',
        color: '#0fc902',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_TEUS_IMPORT+JML_TEUS_EXPORT) AS JML_TEUS, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_TEUS'] . ',';
              }
            ?>
            ]
    }
    , {
        name: 'RKAP',
        color: '#ff0a18',
        data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='TEUS' ORDER BY BULAN ASC
                "
              );
              oci_execute($query4);
              while(($arus = oci_fetch_array($query4, OCI_BOTH)) != false)
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
Highcharts.chart('grafik_arus_petikemas_pendapatan_domestik', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 
        'Grafik Arus Petikemas Pendapatan Domestik' 
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
    },
    xAxis: {
        categories: [ 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
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

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#0002d5',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['TOTAL_PENDAPATAN'] . ',';
              }
            ?>
            ]
    }, {
        name: '<?php echo $tahun_ini ?>',
        color: '#0fc902',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['TOTAL_PENDAPATAN'] . ',';
              }
            ?>
            ]
    }
    , {
        name: 'RKAP',
        color: '#ff0a18',
        data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='PENDAPATAN' ORDER BY BULAN ASC
                "
              );
              oci_execute($query4);
              while(($arus = oci_fetch_array($query4, OCI_BOTH)) != false)
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
Highcharts.chart('grafik_arus_petikemas_pendapatan_international', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 
        'Grafik Arus Petikemas Pendapatan International' 
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
    },
    xAxis: {
        categories: [ 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
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

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#0002d5',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='INT' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['TOTAL_PENDAPATAN'] . ',';
              }
            ?>
            ]
    }, {
        name: '<?php echo $tahun_ini ?>',
        color: '#0fc902',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN, BULAN FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['TOTAL_PENDAPATAN'] . ',';
              }
            ?>
            ]
    }
    , {
        name: 'RKAP',
        color: '#ff0a18',
        data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='INT' AND SATUAN='PENDAPATAN' ORDER BY BULAN ASC
                "
              );
              oci_execute($query4);
              while(($arus = oci_fetch_array($query4, OCI_BOTH)) != false)
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

