<figure class="highcharts-figure">
  <div id="grafik_petikemas_box_domestik"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    function get_chart_box_dom() {
        $.ajax({
            url: "{{url('/grafik_ajax/arus_petikemas_domestik_box')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_box_dom.update({
                    series :[
                        {
                            name: data.tahun_lalu,
                            color: '#adcdea',
                            data: data.grafik_petikemas_domestik_box_tahun_lalu
                        },
                        {
                            name: data.tahun_ini,
                            color: '#ffc836',
                            data: data.grafik_petikemas_domestik_box_tahun_ini
                        },
                        {
                            name: "RKAP",
                            color: '#c2aded',
                            data: data.grafik_petikemas_domestik_box_rkap
                        }
                      ]
                })
            },
            cache: false
        });
    }
    setInterval(() => {
        chart_box_dom.hideLoading();
        get_chart_box_dom();
    }, 30000);
</script>

<script type="text/javascript"> 
    chart_box_dom = new Highcharts.chart('grafik_petikemas_box_domestik', {
        chart: {
            type: 'column',
            events: {
                load: get_chart_box_dom
            }
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