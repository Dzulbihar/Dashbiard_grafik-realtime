<?php 
$koneksi=oci_connect ('DASHBOARDGRAFIK','123456','LOCALHOST/orcl'); 
?>

<figure class="highcharts-figure">
  <div id="grafik_arus_petikemas_pendapatan_domestik"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
  const chart = new Highcharts.Chart({
    chart: {
      renderTo: 'grafik_arus_petikemas_pendapatan_domestik',
      type: 'column',
      // options3d: {
      //   enabled: true,
      //   alpha: 15,
      //   beta: 0,
      //   depth: 50,
      //   viewDistance: 25
      // }
    },
    title: {
        text: 
        'Pendapatan Petikemas Domestik (IDR)' 
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_lalu ?> - <?php echo $tahun_ini ?>'
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

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#93c47d',
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
        color: '#ff9566',
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
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.V_TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='DOM' AND SATUAN='PENDAPATAN' ORDER BY BULAN ASC
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