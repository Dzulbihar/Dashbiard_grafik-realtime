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
              <div id="grafik_shipcall_full"></div>
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
Highcharts.chart('grafik_shipcall_full', {
    chart: {
        type: 'column',
        options3d: {
          enabled: true,
          alpha: 15,
          beta: 0,
          depth: 50,
          viewDistance: 25
        }
    },
    title: {
        text: 'Grafik Ships call'
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>'
    },
    xAxis: {
        categories: [ 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ],
        crosshair: true
    },
    yAxis: {
        title: {
            useHTML: true,
            text: 'Nilai'
        }
    },
    plotOptions: {
      column: {
        depth: 25
      },
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:,.0f}'
        }
      }
    },
    tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },
    plotOptions: {
      column: {
        depth: 25
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
        name: 'Domestik',
        color: '#0002d5',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT BULAN, (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' group by BULAN order by BULAN ASC
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SHIPCALL'] . ',';
              }
            ?>
            ]

    }, {
        name: 'International',
        color: '#0fc902',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT BULAN, (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='INT' group by BULAN order by BULAN ASC
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SHIPCALL'] . ',';
              }
            ?>
            ]

    }, {
        name: 'Domestik & International',
        color: '#ff0a18',
        data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT BULAN, (NVL(SUM(SHIPCALL),0)) AS SHIPCALL FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan group by BULAN order by BULAN ASC
                "
              );
              oci_execute($query4);
              while(($arus = oci_fetch_array($query4, OCI_BOTH)) != false)
              {
                echo $arus['SHIPCALL'] . ',';
              }
            ?>
            ]
    }]
});
</script>