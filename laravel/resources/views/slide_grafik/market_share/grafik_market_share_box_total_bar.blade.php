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
              <div id="grafik_market_share_box_total_bar"></div>
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
Highcharts.chart('grafik_market_share_box_total_bar', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'center',
        text: 'Grafik Market Share Box Domestik & International'
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

    series: [
        {
            name: "BOX Domestik & International",
            colorByPoint: true,
            data: [
                

            <?php 
              $query = oci_parse($koneksi,     
                " 
                SELECT AGENT,JML_BOX from 
                (SELECT * from 
                (SELECT  AGENT,sum(JML_BOX) AS JML_BOX
                from DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER
                where TAHUN=$tahun_ini AND BULAN<=$bulan
                GROUP BY LOKASI,TAHUN,AGENT
                ) order by JML_BOX desc
                ) where rownum <=10
                "
              );
              oci_execute($query);
              while(($arus = oci_fetch_array($query, OCI_BOTH)) != false)
              {
                echo '{name:"' . $arus['AGENT'] . '",';
                echo 'y:' . $arus['JML_BOX'] . ',';
                echo 'drilldown:"' . $arus['AGENT'] . '"},';
              }
            ?>
                    // name: "Chrome",
                    // y: 63.06,
                    // drilldown: "Chrome"
                
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        }
    }
});
</script>