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
              <div id="line_grafik_box_domestik"></div>
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
Highcharts.chart('line_grafik_box_domestik', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 
        'Arus Grafik (<?php
          if ($satuan == "JML_BOX") {
            echo 'BOX ';
          }
          if ($satuan == "JML_TEUS") {
            echo 'TEUS ';
          }
          if ($satuan == "TOTAL_PENDAPATAN") {
            echo 'Total Pendapatan ';
          }

          if ($lokasi == "DOM") {
            echo 'Domestik';
          }
          elseif ($lokasi == "INT") {
            echo 'International';
          }
          else {
            echo 'Domestik & International';
          }

        ?>)' 
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_lalu ?> - <?php echo $tahun_ini ?>'
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

    <?php 
      if ($lokasi == "DOM" || $lokasi == "INT") {
    ?>

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#0002d5',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM($satuan) AS SATUAN, BULAN FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan AND LOKASI='$lokasi' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SATUAN'] . ',';
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
                SELECT SUM($satuan) AS SATUAN, BULAN FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='$lokasi' GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SATUAN'] . ',';
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
                SELECT TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND TYPE='$lokasi' AND SATUAN='$satuan_rkap' ORDER BY BULAN ASC
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

    <?php }else{ ?>

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#0002d5',
        data:
            [
            <?php 
              $query2 = oci_parse($koneksi,     
                " 
                SELECT SUM($satuan) AS SATUAN, BULAN FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE TAHUN=$tahun_lalu AND BULAN<=$bulan GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SATUAN'] . ',';
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
                SELECT SUM($satuan) AS SATUAN, BULAN FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan GROUP BY BULAN ORDER BY BULAN
                "
              );
              oci_execute($query2);
              while(($arus = oci_fetch_array($query2, OCI_BOTH)) != false)
              {
                echo $arus['SATUAN'] . ',';
              }
            ?>
            ]
    }, {
        name: 'RKAP',
        color: '#ff0a18',
        data: 
            [
            <?php 
              $query4 = oci_parse($koneksi,     
                " 
                SELECT SUM(TARGET_RKAP) AS TARGET_RKAP, BULAN FROM DASHBOARDGRAFIK.TARGET_RKAP_PERBULAN WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND SATUAN='$satuan_rkap' GROUP BY BULAN ORDER BY BULAN ASC
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

    <?php } ?>

    ]

});
</script>