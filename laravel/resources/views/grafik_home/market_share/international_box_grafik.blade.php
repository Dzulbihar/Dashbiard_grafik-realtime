<figure class="highcharts-figure">
    <div id="grafik_market_share_box_international"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    function get_chart_market_box_int() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_market_share_international_box')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_market_box_int.update({
                    series :[
                        {
                            name: "BOX International",
                            data: data.grafik_market_box_int
                        }
                      ]
                })
            },
            cache: false
        });
    }
    setInterval(() => {
        chart_market_box_int.hideLoading();
        get_chart_market_box_int();
    }, 30000);
</script>


<script type="text/javascript">
    chart_market_box_int = new Highcharts.chart('grafik_market_share_box_international', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_market_box_int
            }
        },
        title: {
            text: 'Persentase Market Share Box International'
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
        series: [
          {
              name:'',
              data:[]
          }
        ]
});
</script>