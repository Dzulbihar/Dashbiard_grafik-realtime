<figure class="highcharts-figure">
  <div id="grafik_arus_petikemas_box_domestik"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
Highcharts.chart('grafik_arus_petikemas_box_domestik', {
    chart: {
        type: 'column'
    },
    title: {
        text: 
        'Arus Petikemas Domestik (Box)' 
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
               // lineColor: '#2ad3bf',
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
        color: '#adcdea',
        data:<?php echo json_encode($grafik_arus_petikemas_domestik_box_tahun_lalu)?>
    }, {
        name: '<?php echo $tahun_ini ?>',
        color: '#ffc836',
        data:<?php echo json_encode($grafik_arus_petikemas_domestik_box_tahun_ini)?>
    }, {
        name: 'RKAP',
        color: '#c2aded',
        data:<?php echo json_encode($grafik_arus_petikemas_domestik_box_rkap)?>
    }
    ]

});
</script>