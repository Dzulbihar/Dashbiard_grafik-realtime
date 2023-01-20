<figure class="highcharts-figure">
  <div id="grafik_kunjungan_kapal_domestik"></div>
</figure>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    function get_chart_shipcall_dom() {
        $.ajax({
            url: "{{url('/grafik_ajax/arus_kunjungan_kapal_domestik')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_shipcall_dom.update({
                    series :[
                        {
                            name: data.tahun_lalu,
                            data: data.grafik_kunjungan_kapal_domestik_tahun_lalu
                        },
                        {
                            name: data.tahun_ini,
                            data: data.grafik_kunjungan_kapal_domestik_tahun_ini
                        },
                        {
                            name: "RKAP",
                            data: data.grafik_kunjungan_kapal_domestik_rkap
                        }
                      ]
                })
            },
            cache: false
        });
    }
    setInterval(() => {
        chart_shipcall_dom.hideLoading();
        get_chart_shipcall_dom();
    }, 10000);
</script>

<script type="text/javascript"> 
    chart_shipcall_dom = new Highcharts.chart('grafik_kunjungan_kapal_domestik', {
        chart: {
            type: 'spline',
            events: {
                load: get_chart_shipcall_dom
            }
        },
        title: {
            text: 'Kunjungan Kapal Domestik'
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

