<?php 
$koneksi=oci_connect ('DASHBOARDGRAFIK','123456','LOCALHOST/orcl'); 
?>

<figure class="highcharts-figure">
  <div id="grafik_kunjungan_kapal_domestik"></div>
</figure>


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
        text: 'Kunjungan Kapal Domestik'
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
             //   lineColor: '#666666',
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
         // color: '#0002d5',
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
        //  color: '#0fc902',
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
       //   color: '#ff0a18',
          data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE Tahun=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='SHIPCALL' ORDER BY BULAN ASC
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

