<figure class="highcharts-figure">
    <div id="grafik_market_share_teus_domestik"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
Highcharts.chart('grafik_market_share_teus_domestik', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Persentase Market Share Teus Domestik'
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
        name: 'Teus Domestik',
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT, JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_TEUS_EXPORT+JML_TEUS_IMPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_TEUS_TOTAL DESC) WHERE rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $agent = $row['AGENT'];
              $box = $row['JML_TEUS_TOTAL'];

              $query1 = oci_parse($koneksi,"SELECT JML_TEUS_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_TEUS_EXPORT+JML_TEUS_IMPORT) AS JML_TEUS_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT ) ORDER BY JML_TEUS_TOTAL DESC ) WHERE rownum <=10 AND AGENT='$agent'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['JML_TEUS_TOTAL'];
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