<figure class="highcharts-figure">
  <div id="grafik_arus_petikemas_pendapatan_international"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script type="text/javascript">
Highcharts.chart('grafik_arus_petikemas_pendapatan_international', {
    chart: {
      type: 'column',
      /*options3d: {
        enabled: true,
        alpha: 15,
        beta: 0,
        depth: 50,
        viewDistance: 25
      }*/
    },
    title: {
        text: 
        'Pendapatan Petikemas International (IDR)' 
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
      min: 0,
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
        data:<?php echo json_encode($grafik_arus_petikemas_international_pendapatan_tahun_lalu)?>
    }, {
        name: '<?php echo $tahun_ini ?>',
        color: '#ff9566',
        data:<?php echo json_encode($grafik_arus_petikemas_international_pendapatan_tahun_ini)?>
    }
    , {
        name: 'RKAP',
        color: '#ff0a18',
        data:<?php echo json_encode($grafik_arus_petikemas_international_pendapatan_rkap)?>
    }
    ]
  });
</script>