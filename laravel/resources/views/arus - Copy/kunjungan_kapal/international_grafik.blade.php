<figure class="highcharts-figure">
  <div id="grafik_kunjungan_kapal_international"></div>
</figure>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
Highcharts.chart('grafik_kunjungan_kapal_international', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Kunjungan Kapal International'
    },
    subtitle: {
      text: 'Tahun <?php echo $tahun_ini ?>, sampai dengan bulan <?php echo $bulan ?>'
    },
    xAxis: {
        categories: [ 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
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
             //   lineColor: '#666666',
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
    series: [
      {
          name: '<?php echo $tahun_lalu; ?>',
         // color: '#0002d5',
          data:<?php echo json_encode($grafik_arus_kunjungan_kapal_international_tahun_lalu)?>
      },
      {
          name: '<?php echo $tahun_ini; ?>',
      //    color: '#0fc902',
          data:<?php echo json_encode($grafik_arus_kunjungan_kapal_international_tahun_ini)?>
      }, 
      {
          name: 'RKAP',
       //   color: '#ff0a18',
          data:<?php echo json_encode($grafik_arus_kunjungan_kapal_international_rkap)?>
      }
    ]
});
</script>

