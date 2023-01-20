
            <figure class="highcharts-figure">
                <div id="grafik_carrier_binpel"></div>
            </figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<!-- grafik ajax -->
<script type="text/javascript">
    function get_chart_carier() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_carier')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_carier.update({
                    series :[
                        {
                            name: "Carrier",
                            data: data.grafik_carrier
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_carier.hideLoading();
        get_chart_carier();
    }, 30000);
    

</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_carier = new Highcharts.chart('grafik_carrier_binpel', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_carier
            }
        },

        title: {
            text: '<b>Persentase Carrier <?php 
                    if(empty($cari_lokasi)){
                        echo '';
                    }
                    if(!empty($cari_lokasi)){
                        if ($cari_lokasi == "DOM") {
                            echo "Domestik";
                        }if ($cari_lokasi == "INT") {
                            echo "International";
                        }     
                    }
                ?></b>'
        },

        subtitle: {
            align: 'center',
            text: '<?php 
                        if(empty($start_date)){
                            echo 'Tahun '. $tahun_ini. ' sampai dengan bulan ' .$bulan;
                        }
                        if(!empty($start_date)){

                            echo 'Antara tanggal ' .$start_date . ' sampai tanggal ' .$end_date;
                        }
                    ?>'
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
