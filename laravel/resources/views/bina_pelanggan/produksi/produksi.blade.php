@section('header', 'Produksi')

@extends('layouts.app')

@section('content')



<br>

<!-- Judul Produksi Teus -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1 align="center"> 
              <label class="badge badge-light">
                <b> 
                  Produksi INTER dan DOM
                </b>
              </label> 
            </h1>
          </div>
        </div>
      </div>
    </div>        
  </div>
</section>
<!-- /.content -->


<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
                <div id="grafik_produksi_international_import"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
                <div id="grafik_produksi_international_eksport"></div>
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
                <div id="grafik_produksi_domestik_import"></div>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
                <div id="grafik_produksi_domestik_eksport"></div>
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

<!-- grafik ajax produksi international import -->
<script type="text/javascript">
    function get_chart_produksi_international_import() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_produksi_international_import')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_produksi_international_import.update({
                    series :[
                        {
                            name: "Produksi International Import",
                            data: data.grafik_produksi_international_import
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_produksi_international_import.hideLoading();
        get_chart_produksi_international_import();
    }, 10000);
</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_produksi_international_import = new Highcharts.chart('grafik_produksi_international_import', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_produksi_international_import
            }
        },

        title: {
            text: '<b>Persentase Produksi International Import</b>'
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

<!-- ////////////////////////////// -->

<!-- grafik ajax produksi international eksport -->
<script type="text/javascript">
    function get_chart_produksi_international_eksport() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_produksi_international_eksport')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_produksi_international_eksport.update({
                    series :[
                        {
                            name: "Produksi International Eksport",
                            data: data.grafik_produksi_international_eksport
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_produksi_international_eksport.hideLoading();
        get_chart_produksi_international_eksport();
    }, 10000);
</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_produksi_international_eksport = new Highcharts.chart('grafik_produksi_international_eksport', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_produksi_international_eksport
            }
        },

        title: {
            text: '<b>Persentase Produksi International Eksport</b>'
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



<!-- ////////////////////////////// -->



<!-- grafik ajax produksi domestik import -->
<script type="text/javascript">
    function get_chart_produksi_domestik_import() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_produksi_domestik_import')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_produksi_domestik_import.update({
                    series :[
                        {
                            name: "Produksi Domestik Import",
                            data: data.grafik_produksi_domestik_import
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_produksi_domestik_import.hideLoading();
        get_chart_produksi_domestik_import();
    }, 10000);
</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_produksi_domestik_import = new Highcharts.chart('grafik_produksi_domestik_import', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_produksi_domestik_import
            }
        },

        title: {
            text: '<b>Persentase Produksi Domestik Import</b>'
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

<!-- ////////////////////////////// -->

<!-- grafik ajax produksi domestik eksport -->
<script type="text/javascript">
    function get_chart_produksi_domestik_eksport() {
        $.ajax({
            url: "{{url('/grafik_ajax/bin_pel_produksi_domestik_eksport')}}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data)
                chart_produksi_domestik_eksport.update({
                    series :[
                        {
                            name: "Produksi Domestik Eksport",
                            data: data.grafik_produksi_domestik_eksport
                        }
                      ]
                })
            },
            cache: false
        });
    }

    setInterval(() => {
        chart_produksi_domestik_eksport.hideLoading();
        get_chart_produksi_domestik_eksport();
    }, 10000);
</script>
<script type="text/javascript">
    Highcharts.setOptions({
     colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#5e6063', '#112c80']
    });
    
    chart_produksi_domestik_eksport = new Highcharts.chart('grafik_produksi_domestik_eksport', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                load: get_chart_produksi_domestik_eksport
            }
        },

        title: {
            text: '<b>Persentase Produksi Domestik Eksport</b>'
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
















@endsection