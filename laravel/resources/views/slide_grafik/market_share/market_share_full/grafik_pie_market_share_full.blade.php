<?php 
  $koneksi=oci_connect ('DASHBOARDGRAFIK','123456','LOCALHOST/orcl'); 
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <figure class="highcharts-figure">
              <div id="grafik_pie_market_share_full"></div>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
Highcharts.chart('grafik_pie_market_share_full', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 
        'Persentase Market Share (<?php
          if ($satuan == "JML_BOX") {
            echo 'BOX ';
          }
          if ($satuan == "JML_TEUS") {
            echo 'TEUS ';
          }
          if ($satuan == "TOTAL_PENDAPATAN") {
            echo 'Total Pendapatan ';
          }

          if ($lokasi == "DOM") {
            echo 'Domestik';
          }
          elseif ($lokasi == "INT") {
            echo 'International';
          }
          else {
            echo 'Domestik & International';
          }
        ?>)' 
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

    <?php 
      if ($lokasi == "DOM" || $lokasi == "INT") {
    ?>

    series: [{
            name: "<?php 
                      if ($satuan=='JML_BOX') {
                          echo 'BOX ';
                      }elseif ($satuan=='JML_TEUS') {
                            echo 'TEUS ';
                      }else{
                           echo 'Total Pendapatan ';
                      } 

                      if ($lokasi=='DOM') {
                          echo 'Domestik, ';
                      }elseif ($lokasi=='INT') {
                            echo 'International,';
                      }else{
                           echo 'Domestik & International, ';
                      }
            ?>",
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT FROM (SELECT * FROM (SELECT  AGENT,sum($satuan) AS $satuan FROM DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='$lokasi' GROUP BY LOKASI,TAHUN,AGENT) order by $satuan desc) where rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $browsername = $row['AGENT'];

              $query1 = oci_parse($koneksi,"SELECT $satuan FROM (SELECT * FROM (SELECT  AGENT,sum($satuan) AS $satuan FROM DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan and LOKASI='$lokasi' GROUP BY LOKASI,TAHUN,AGENT ) order by $satuan desc ) where rownum <=10 and AGENT='$browsername'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data[$satuan];
              }

          ?>
              [ 
              '<?php echo $browsername ?>',
              <?php echo $jumlah; ?>
              ],
          <?php
            }
          ?>

          ]
    }]

    <?php }else{ ?>

    series: [{
            name: "<?php 
                      if ($satuan=='JML_BOX') {
                          echo 'BOX ';
                      }elseif ($satuan=='JML_TEUS') {
                            echo 'TEUS ';
                      }else{
                           echo 'Total Pendapatan ';
                      } 

                      if ($lokasi=='DOM') {
                          echo 'Domestik, ';
                      }elseif ($lokasi=='INT') {
                            echo 'International,';
                      }else{
                           echo 'Domestik & International, ';
                      }
            ?>",
          data: [

          <?php
            $query = oci_parse($koneksi,
              "SELECT AGENT FROM (SELECT * FROM (SELECT  AGENT,sum($satuan) AS $satuan FROM DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan GROUP BY LOKASI,TAHUN,AGENT) order by $satuan desc) where rownum <=10");
            oci_execute($query);

            while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
            {
              $browsername = $row['AGENT'];

              $query1 = oci_parse($koneksi,"SELECT $satuan FROM (SELECT * FROM (SELECT  AGENT,sum($satuan) AS $satuan FROM DASHBOARDGRAFIK.PROD_PEND_PERCUSTOMER where TAHUN=$tahun_ini AND BULAN<=$bulan GROUP BY LOKASI,TAHUN,AGENT ) order by $satuan desc ) where rownum <=10 and AGENT='$browsername'");
              oci_execute($query1);
              while(($data = oci_fetch_array($query1, OCI_BOTH)) != false)
              {
                $jumlah = $data[$satuan];
              }

          ?>
              [ 
              '<?php echo $browsername ?>',
              <?php echo $jumlah; ?>
              ],
          <?php
            }
          ?>

          ]
    }]

    <?php } ?>

});
</script>