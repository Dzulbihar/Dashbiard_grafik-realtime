<figure class="highcharts-figure">
  <div id="grafik_market_share_pendapatan_domestik"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script type="text/javascript">
Highcharts.chart('grafik_market_share_pendapatan_domestik', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Pendapatan Domestik'
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
        name: 'Pendapatan Domestik',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT, TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) order by TOTAL_PENDAPATAN desc) where rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $agent = $row['AGENT'];
              $box = $row['TOTAL_PENDAPATAN'];

              $query1 = oci_parse($koneksi,"SELECT TOTAL_PENDAPATAN from (SELECT * from (SELECT  AGENT,sum(TOTAL_PENDAPATAN) AS TOTAL_PENDAPATAN from DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT ) order by TOTAL_PENDAPATAN desc ) where rownum <=10 and AGENT='$agent'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['TOTAL_PENDAPATAN'];
              }

          ?>
              [ 
              '<?php echo $agent,'[', $box, '] '  ?>', 
              <?php echo $jumlah; ?>,
              ],
          <?php
            }
          ?>

          ]
    }]
});
</script>