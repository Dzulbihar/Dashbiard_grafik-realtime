<figure class="highcharts-figure">
    <div id="grafik_market_share_box_domestik"></div>
</figure>

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
Highcharts.chart('grafik_market_share_box_domestik', {
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
              "SELECT AGENT, JML_BOX_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL
                FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER 
                WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' 
                GROUP BY LOKASI,TAHUN,AGENT) ORDER BY JML_BOX_TOTAL DESC) WHERE rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $agent = $row['AGENT'];
              $box = $row['JML_BOX_TOTAL'];

              $query1 = oci_parse($koneksi,"SELECT JML_BOX_TOTAL FROM (SELECT * FROM (SELECT  AGENT,SUM(JML_BOX_EXPORT+JML_BOX_IMPORT) AS JML_BOX_TOTAL FROM DASHBOARDGRAFIK.V_PRODUKSI_PENDAPATAN_CUSTOMER WHERE TAHUN=$tahun_ini AND BULAN<=$bulan AND LOKASI='DOM' GROUP BY LOKASI,TAHUN,AGENT ) ORDER BY JML_BOX_TOTAL DESC ) WHERE rownum <=10 AND AGENT='$agent'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data['JML_BOX_TOTAL'];
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