@section('header', 'Produksi')

@extends('layouts.app')

@section('content')

<br>

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

<script type="text/javascript">
Highcharts.chart('grafik_pod', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<b>Persentase Port Of Destination (POD) </b>'
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
    series: [{
        name: 'POD',
        data: <?php echo json_encode($grafik_produksi_international)?>
    }]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafik_fpod', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<b>Persentase Final Port Of Destination (FPOD) </b>'
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
    series: [{
        name: 'FPOD',
        data: <?php echo json_encode($grafik_produksi_domestik)?>
    }]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafik_pol', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<b>Persentase Final Port Of Loading (POL) </b>'
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
    series: [{
        name: 'POL',
        data: <?php echo json_encode($grafik_produksi_domestik)?>
    }]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafik_origin', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<b>Persentase Final Origin Port </b>'
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
    series: [{
        name: 'Origin',
        data: <?php echo json_encode($grafik_produksi_domestik)?>
    }]
});
</script>


@endsection