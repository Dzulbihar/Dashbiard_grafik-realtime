<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
                <div id="grafik_carrier"></div>
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
Highcharts.chart('grafik_carrier', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
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
    series: [{
        name: 'Carrier',
        data: <?php echo json_encode($grafik_carrier)?>
    }]
});
</script>