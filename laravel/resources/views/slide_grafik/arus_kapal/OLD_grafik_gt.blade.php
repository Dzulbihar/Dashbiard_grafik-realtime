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
              <div id="grafik_gt"></div>
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
Highcharts.chart('grafik_gt', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'center',
        text: 'Grafik GT (Domestik & International)'
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
            name: "GT",
            colorByPoint: true,
            data: [
                

            <?php 
              $query = oci_parse($koneksi,     
                " 
                SELECT BULAN, (NVL(SUM(GT),0)) AS GT FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE TAHUN='$tahun_ini' group by BULAN order by BULAN ASC
                "
              );
              oci_execute($query);
              while(($arus = oci_fetch_array($query, OCI_BOTH)) != false)
              {
                echo '{name:"' . $arus['BULAN'] . '",';
                echo 'y:' . $arus['GT'] . ',';
                echo 'drilldown:"' . $arus['BULAN'] . '"},';
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