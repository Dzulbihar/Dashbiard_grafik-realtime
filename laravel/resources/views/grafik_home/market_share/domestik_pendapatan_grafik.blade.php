<figure class="highcharts-figure">
  <div id="grafik_market_share_pendapatan_domestik"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    function get_chart_market_pendapatan_dom() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_market_share_domestik_pendapatan')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_market_pendapatan_dom.update({
                    series :[
                        {
                            name: "Pendapatan Domestik",
                            data: data.grafik_market_pendapatan_dom
                        }
                      ]
                })
            },
            cache: false
        });
    }
    setInterval(() => {
        chart_market_pendapatan_dom.hideLoading();
        get_chart_market_pendapatan_dom();
    }, 30000);
</script>

<script type="text/javascript">
    chart_market_pendapatan_dom = new Highcharts.chart('grafik_market_share_pendapatan_domestik', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_market_pendapatan_dom
            }
        },
        title: {
            text: 'Persentase Market Share Pendapatan Domestik'
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