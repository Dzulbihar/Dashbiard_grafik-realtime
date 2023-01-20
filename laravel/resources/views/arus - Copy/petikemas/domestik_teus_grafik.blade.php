<figure class="highcharts-figure">
  <div id="grafik_arus_petikemas_teus_domestik"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
Highcharts.chart('grafik_arus_petikemas_teus_domestik', {
    chart: {
        type: 'column'
    },
    title: {
        text: 
        'Arus Petikemas Domestik (Teus)' 
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
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

    series: [{
        name: '<?php echo $tahun_lalu ?>',
        color: '#fc543a',
        data:<?php echo json_encode($grafik_arus_petikemas_domestik_teus_tahun_lalu)?>
    }, {
        name: '<?php echo $tahun_ini ?>',
        color: '#ffd966',
        data:<?php echo json_encode($grafik_arus_petikemas_domestik_teus_tahun_ini)?>
    }, {
        name: 'RKAP',
        color: '#93c47d',
        data:<?php echo json_encode($grafik_arus_petikemas_domestik_teus_rkap)?>
    }
    ]

});
</script>