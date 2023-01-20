<figure class="highcharts-figure">
  <div id="grafik_petikemas_teus_international"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>



<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    function get_chart_teus_int() {
        $.ajax({
            url: "{{url('/grafik_ajax/arus_petikemas_international_teus')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_teus_int.update({
                    series :[
                        {
                            name: data.tahun_lalu,
                            color: '#fc543a',
                            data: data.grafik_petikemas_international_teus_tahun_lalu
                        },
                        {
                            name: data.tahun_ini,
                            color: '#ffd966',
                            data: data.grafik_petikemas_international_teus_tahun_ini
                        },
                        {
                            name: "RKAP",
                            color: '#93c47d',
                            data: data.grafik_petikemas_international_teus_rkap
                        }
                      ]
                })
            },
            cache: false
        });
    }
    setInterval(() => {
        chart_teus_int.hideLoading();
        get_chart_teus_int();
    }, 10000);
</script>

<script type="text/javascript"> 
    chart_teus_int = new Highcharts.chart('grafik_petikemas_teus_international', {
        chart: {
            type: 'column',
            events: {
                load: get_chart_teus_int
            }
        },
        title: {
            text: 
            'Arus Petikemas International (Teus)' 
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