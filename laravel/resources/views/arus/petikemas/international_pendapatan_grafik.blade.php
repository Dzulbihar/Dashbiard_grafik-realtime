<figure class="highcharts-figure">
  <div id="grafik_petikemas_pendapatan_international"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    function get_chart_pendapatan_int() {
        $.ajax({
            url: "{{url('/grafik_ajax/arus_petikemas_international_pendapatan')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_pendapatan_int.update({
                    series :[
                        {
                            name: data.tahun_lalu,
                            color: '#93c47d',
                            data: data.grafik_petikemas_international_pendapatan_tahun_lalu
                        },
                        {
                            name: data.tahun_ini,
                            color: '#ff9566',
                            data: data.grafik_petikemas_international_pendapatan_tahun_ini
                        },
                        {
                            name: "RKAP",
                            color: '#ff0a18',
                            data: data.grafik_petikemas_international_pendapatan_rkap
                        }
                      ]
                })
            },
            cache: false
        });
    }
    setInterval(() => {
        chart_pendapatan_int.hideLoading();
        get_chart_pendapatan_int();
    }, 10000);
</script>

<script type="text/javascript"> 
    chart_pendapatan_int = new Highcharts.chart('grafik_petikemas_pendapatan_international', {
        chart: {
            type: 'column',
            events: {
                load: get_chart_pendapatan_int
            }
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

        series: [
          {
              name:'',
              data:[]
          },
          {
              name:'',
              data:[]
          }, 
          {
              name: '',
              data:[]
          }
        ]
  });
</script>