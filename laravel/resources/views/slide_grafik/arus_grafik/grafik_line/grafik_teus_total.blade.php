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
              <div id="line_grafik_teus_total"></div>
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
Highcharts.chart('line_grafik_teus_total', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Grafik TEUS Domestik & International'
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
          name: '<?php echo $tahun_lalu ?>',
          color: '#0002d5',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT sum(JML_TEUS) AS JML_TEUS from DASHBOARDGRAFIK.PROD_PEND_PERBULAN where Tahun=$tahun_lalu AND BULAN<=$bulan group by Bulan order by Bulan
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
          name: '<?php echo $tahun_ini ?>',
          color: '#0fc902',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT sum(JML_TEUS) AS JML_TEUS from DASHBOARDGRAFIK.PROD_PEND_PERBULAN where Tahun=$tahun_ini AND BULAN<=$bulan group by Bulan order by Bulan
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
          name: 'RKAP',
          color: '#ff0a18',
          data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT SUM(TARGET_RKAP) AS TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='TEUS' GROUP BY BULAN ORDER BY BULAN
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