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
              <div id="grafik_market_share_pendapatan_international_pie"></div>
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
// Build the chart
Highcharts.chart('grafik_market_share_pendapatan_international_pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Pendapatan International'
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
        name: 'Pendapatan International',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN desc) where rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $browsername = $row['AGENT'];

              $query1 = oci_parse($koneksi,"SELECT TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='INT' GROUP BY LOKASI,TAHUN,AGENT ) order by TOTAL_PENDAPATAN desc ) where rownum <=10 and AGENT='$browsername'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['TOTAL_PENDAPATAN'];
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