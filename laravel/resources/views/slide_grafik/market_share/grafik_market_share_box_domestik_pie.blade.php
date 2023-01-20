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
              <div id="grafik_market_share_box_domestik_pie"></div>
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
Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});

// Build the chart
Highcharts.chart('grafik_market_share_box_domestik_pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Box Domestik'
    },
    subtitle: {
        align: 'center',
        text: 'Tahun <?php echo $tahun_ini ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:,.2f} %</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:,.2f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'BOX Domestik',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT from (SELECT * from (SELECT  AGENT,sum(JML_BOX) AS JML_BOX from DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) order by JML_BOX desc) where rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $browsername = $row['AGENT'];

              $query1 = oci_parse($koneksi,"SELECT JML_BOX from (SELECT * from (SELECT  AGENT,sum(JML_BOX) AS JML_BOX from DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT ) order by JML_BOX desc ) where rownum <=10 and AGENT='$browsername'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['JML_BOX'];
              }

          ?>
              [ 
              '<?php echo $browsername ?>',
              <?php echo $jumlah; ?>
              ],
          <?php
            }
          ?>

          ]
    }]
});
</script>