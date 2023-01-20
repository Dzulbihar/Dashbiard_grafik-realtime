<?php 
  $koneksi=oci_connect ('DASHBOARDGRAFIK','123456','LOCALHOST/orcl'); 
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="line_grafik_nota"></div>
            </figure>
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
Highcharts.chart('line_grafik_nota', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Grafik BOX Domestik'
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_lalu ?> - <?php echo $tahun_ini ?>'
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
          name: 'Domestik',
          color: '#0002d5',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_TEUS) AS JML_TEUS, BULAN FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE Tahun=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_TEUS'] . ',';
              }
            ?>
            ]
      }, 
      {
          name: 'International',
          color: '#0fc902',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_TEUS) AS JML_TEUS, BULAN FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE Tahun=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['JML_TEUS'] . ',';
              }
            ?>
            ]
      }, 
      {
          name: 'Domestik & International',
          color: '#ff0a18',
          data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT SUM(JML_TEUS) AS JML_TEUS, BULAN FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE Tahun=$tahun_ini AND BULAN<=$bulan GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query4);
              while(($arus = oci_fetch_array($query4, OCI_BOTH)) != false)
              {
                echo $arus['JML_TEUS'] . ',';
              }
            ?>
            ]
      }
    ]
});
</script>