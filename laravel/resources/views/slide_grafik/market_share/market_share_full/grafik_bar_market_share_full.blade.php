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
              <div id="grafik_bar_market_share_full"></div>
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
Highcharts.chart('grafik_bar_market_share_full', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'center',
        text: 
        'Grafik Market Share (<?php
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
        align: 'center',
        text: 'Tahun <?php echo $tahun_ini ?>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Nilai'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:,.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:,.0f}</b> of total<br/>'
    },

    <?php 
      if ($lokasi == "DOM" || $lokasi == "INT") {
    ?>

    series: [
        {
            name: "<?php 
                      if ($satuan=='JML_BOX') {
                          echo 'BOX ';
                      }elseif ($satuan=='JML_TEUS') {
                            echo 'TEUS ';
                      }else{
                           echo 'Total Pendapatan ';
                      } 

                      if ($lokasi=='DOM') {
                          echo 'Domestik, ';
                      }elseif ($lokasi=='INT') {
                            echo 'International,';
                      }else{
                           echo 'Domestik & International, ';
                      }
            ?>",
            colorByPoint: true,
            data: [
                

            <?php 
              $query = oci_parse($koneksi,     
                " 
                SELECT AGENT,$satuan AS SATUAN from 
                (SELECT * from 
                (SELECT  AGENT,sum($satuan) AS $satuan
                from DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER
                where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='$lokasi'
                GROUP BY LOKASI,TAHUN,AGENT
                ) order by $satuan desc
                ) where rownum <=10
                "
              );
              oci_execute($query);
              while(($arus = oci_fetch_array($query, OCI_BOTH)) != false)
              {
                echo '{name:"' . $arus['AGENT'] . '",';
                echo 'y:' . $arus['SATUAN'] . ',';
                echo 'drilldown:"' . $arus['AGENT'] . '"},';
              }
            ?>
                    // name: "Chrome",
                    // y: 63.06,
                    // drilldown: "Chrome"
                
            ]
        }
    ],

    <?php }else{ ?>

    series: [
        {
            name: "<?php 
                      if ($satuan=='JML_BOX') {
                          echo 'BOX ';
                      }elseif ($satuan=='JML_TEUS') {
                            echo 'TEUS ';
                      }else{
                           echo 'Total Pendapatan ';
                      } 

                      if ($lokasi=='DOM') {
                          echo 'Domestik, ';
                      }elseif ($lokasi=='INT') {
                            echo 'International,';
                      }else{
                           echo 'Domestik & International, ';
                      }
            ?>",
            colorByPoint: true,
            data: [
                

            <?php 
              $query = oci_parse($koneksi,     
                " 
                SELECT AGENT,$satuan AS SATUAN from 
                (SELECT * from 
                (SELECT  AGENT,sum($satuan) AS $satuan
                from DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER
                where TAHUN=$tahun_ini AND BULAN<=$bulan
                GROUP BY LOKASI,TAHUN,AGENT
                ) order by $satuan desc
                ) where rownum <=10
                "
              );
              oci_execute($query);
              while(($arus = oci_fetch_array($query, OCI_BOTH)) != false)
              {
                echo '{name:"' . $arus['AGENT'] . '",';
                echo 'y:' . $arus['SATUAN'] . ',';
                echo 'drilldown:"' . $arus['AGENT'] . '"},';
              }
            ?>
                    // name: "Chrome",
                    // y: 63.06,
                    // drilldown: "Chrome"
                
            ]
        }
    ],

    <?php } ?>

    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        }
    }
});
</script>