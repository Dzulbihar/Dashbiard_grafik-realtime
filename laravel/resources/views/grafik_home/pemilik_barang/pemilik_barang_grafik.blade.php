
            <figure class="highcharts-figure">
                <div id="grafik_pemilik_barang_binpel"></div>
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
    function get_chart_pemilik_barang() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_pemilik_barang')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_pemilik_barang.update({
                    series :[
                        {
                            name: "Pemilik Barang",
                            data: data.grafik_pemilik_barang
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_pemilik_barang.hideLoading();
        get_chart_pemilik_barang();
    }, 30000);
    

</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_pemilik_barang = new Highcharts.chart('grafik_pemilik_barang_binpel', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_pemilik_barang
            }
        },

        title: {
            text: '<b>Persentase Pemilik Barang</b>'
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
