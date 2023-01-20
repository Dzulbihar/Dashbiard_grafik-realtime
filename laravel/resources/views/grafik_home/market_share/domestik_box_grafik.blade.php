<figure class="highcharts-figure">
    <div id="grafik_market_share_box_domestik"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    function get_chart_market_box_dom() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_market_share_domestik_box')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_market_box_dom.update({
                    series :[
                        {
                            name: "BOX Domestik",
                            data: data.grafik_market_box_dom
                        }
                      ]
                })
            },
            cache: false
        });
    }
    setInterval(() => {
        chart_market_box_dom.hideLoading();
        get_chart_market_box_dom();
    }, 30000);
</script>

<script type="text/javascript">
    chart_market_box_dom = new Highcharts.chart('grafik_market_share_box_domestik', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_market_box_dom
            }
        },
        title: {
            text: 'Persentase Market Share Box Domestik'
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