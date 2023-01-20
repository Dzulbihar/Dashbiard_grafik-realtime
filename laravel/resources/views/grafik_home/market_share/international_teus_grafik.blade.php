<figure class="highcharts-figure">
    <div id="grafik_market_share_teus_international"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    function get_chart_market_teus_int() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_market_share_international_teus')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_market_teus_int.update({
                    series :[
                        {
                            name: "TEUS International",
                            data: data.grafik_market_teus_int
                        }
                      ]
                })
            },
            cache: false
        });
    }
    setInterval(() => {
        chart_market_teus_int.hideLoading();
        get_chart_market_teus_int();
    }, 30000);
</script>

<script type="text/javascript">
    chart_market_teus_int = new Highcharts.chart('grafik_market_share_teus_international', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_market_teus_int
            }
        },
        title: {
            text: 'Persentase Market Share Teus International'
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