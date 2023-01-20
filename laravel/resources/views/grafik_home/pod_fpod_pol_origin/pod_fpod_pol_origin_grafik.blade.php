<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
                <div id="grafik_pod"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
                <div id="grafik_fpod"></div>
            </figure>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
                <div id="grafik_pol"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
                <div id="grafik_origin"></div>
            </figure>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<!-- grafik ajax pod -->
<script type="text/javascript">
    function get_chart_pod() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_pod')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_pod.update({
                    series :[
                        {
                            name: "Port Of Destination (POD)",
                            data: data.grafik_pod
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_pod.hideLoading();
        get_chart_pod();
    }, 30000);
</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_pod = new Highcharts.chart('grafik_pod', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_pod
            }
        },

        title: {
            text: '<b>Persentase Port Of Destination (POD)</b>'
        },

        subtitle: {
            align: 'center',
            text: '<?php echo 'Tahun '. $tahun_ini. ' sampai dengan bulan ' .$bulan; ?>'
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


<!-- grafik ajax fpod -->
<script type="text/javascript">
    function get_chart_fpod() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_fpod')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_fpod.update({
                    series :[
                        {
                            name: "Final Port Of Destination (FPOD)",
                            data: data.grafik_fpod
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_fpod.hideLoading();
        get_chart_fpod();
    }, 30000);
</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_fpod = new Highcharts.chart('grafik_fpod', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_fpod
            }
        },

        title: {
            text: '<b>Persentase FPOD</b>'
        },

        subtitle: {
            align: 'center',
            text: '<?php echo 'Tahun '. $tahun_ini. ' sampai dengan bulan ' .$bulan; ?>'
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


<!-- grafik ajax pol -->
<script type="text/javascript">
    function get_chart_pol() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_pol')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_pol.update({
                    series :[
                        {
                            name: "Port Of Loading (POL)",
                            data: data.grafik_pol
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_pol.hideLoading();
        get_chart_pol();
    }, 30000);
</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_pol = new Highcharts.chart('grafik_pol', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_pol
            }
        },

        title: {
            text: '<b>Persentase Port Of Loading (POL)</b>'
        },

        subtitle: {
            align: 'center',
            text: '<?php echo 'Tahun '. $tahun_ini. ' sampai dengan bulan ' .$bulan; ?>'
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


<!-- grafik ajax origin -->
<script type="text/javascript">
    function get_chart_origin() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_origin')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_origin.update({
                    series :[
                        {
                            name: "Origin Port",
                            data: data.grafik_origin
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_origin.hideLoading();
        get_chart_origin();
    }, 30000);
</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_origin = new Highcharts.chart('grafik_origin', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_origin
            }
        },

        title: {
            text: '<b>Persentase Origin Port</b>'
        },

        subtitle: {
            align: 'center',
            text: '<?php echo 'Tahun '. $tahun_ini. ' sampai dengan bulan ' .$bulan; ?>'
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