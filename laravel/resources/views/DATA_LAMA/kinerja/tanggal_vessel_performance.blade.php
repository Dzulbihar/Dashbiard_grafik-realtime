@section('header', 'Grafik pertanggal Vessel Performance')

@extends('layouts.app')

@section('content')

<?php 
    $koneksi=oci_connect ("DASHBOARDGRAFIK","123456","LOCALHOST/orcl");
 ?>

<br>

<!-- Cari Tahun-->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<form action="{{url('/tanggal_vessel_performance/cari')}}" method="GET">
							<p class="card-title"> 
				                <b>Tanggal</b>
				                <input type="date" name="tanggal" class="btn btn-default btn-sm">
				                <input type="submit" value="Cari" class="btn btn-secondary btn-sm">
				                <?php 
				                if(isset($_GET['tanggal'])){
				                  $tanggal = $_GET['tanggal'];
				                  ?>
				                <a class="btn btn-secondary btn-sm text-white"> 
				                    Hasil pencarian, 
				                    <?php
				                      echo "Tanggal: $tanggal, ";
				                    ?>
				                </a>
				                  <?php 
				                }
				                ?>
							</p>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

<!-- Cari Tahun-->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
                        <figure class="highcharts-figure">
                          <div id="avg"></div>
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
Highcharts.chart('avg', {
    chart: {
        type: 'spline'
    },
    title: {
        text: "<?php if (! empty($tanggal)) {  ?>Laporan kinerja kapal tanggal <?php echo $tanggal ?> <?php } ?> <?php if (empty($tanggal)) { ?> Silakan pilih tanggal untuk melihat grafik laporan kinerja semua kapal<?php } ?>" 
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [ 
            <?php 
            	if (! empty($tanggal)) { 
                    $query2 = oci_parse($koneksi,     
                        " 
                        SELECT AVG(BSH_GROSS) AS BSH_GROSS, to_char(FROM_TS,'hh24') AS FROM_TS  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
						WHERE to_char(FROM_TS,'yyyy-mm-dd')='$tanggal'   GROUP BY FROM_TS order by FROM_TS

                        "
                    );
                    oci_execute($query2);

                    while (($avg2 = oci_fetch_array($query2, OCI_BOTH)) != false)
                    { 
                        echo '"' . $avg2['FROM_TS'] . '.00",';
                    }
                }
            ?>
        ],
        accessibility: {
            description: 'Months of the year'
        }
    },
    yAxis: {
        title: {
            text: 'Nilai'
        },
        labels: {
            formatter: function () {
                return this.value + '';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        },
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:,.0f}'
        }
      }
    },
    series: [
      {
            name: 'BSH_GROSS',
            color: '#0002d5',
            data:
            [
            <?php
            	if (! empty($tanggal)) { 
                    $query2 = oci_parse($koneksi,     
                        " 
                        SELECT AVG(BSH_GROSS) AS BSH_GROSS, to_char(FROM_TS,'yyyy-mm-dd : hh24') AS FROM_TS  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
						WHERE to_char(FROM_TS,'yyyy-mm-dd')='$tanggal'   GROUP BY FROM_TS order by FROM_TS

                        "
                    );
                    oci_execute($query2);

                    while (($avg2 = oci_fetch_array($query2, OCI_BOTH)) != false)
                    { 
                        echo ceil($avg2['BSH_GROSS']) . ',';
                    }
                }
            ?>
            ]

      }, 
      {
            name: 'BSH_NET',
            color: '#0fc902',
            data:
            [
            <?php 
            	if (! empty($tanggal)) {
                    $query3 = oci_parse($koneksi,     
                    	" 
                    	SELECT AVG(BSH_NET) AS BSH_NET, to_char(FROM_TS,'yyyy-mm-dd : hh24') AS FROM_TS  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
						WHERE to_char(FROM_TS,'yyyy-mm-dd')='$tanggal'   GROUP BY FROM_TS order by FROM_TS

                    	"
                    );
                    oci_execute($query3);

                    while (($avg3 = oci_fetch_array($query3, OCI_BOTH)) != false)
                    { 
                        echo ceil($avg3['BSH_NET']) . ',';
                    }
                }
            ?>
        ]
      }, 
      {
            name: 'BCH_GROSS',
            color: '#ff0a18',
            data: 
            [
                <?php 
                	if (! empty($tanggal)) {
                        $query4 = oci_parse($koneksi,     
                    	" 
                    	SELECT AVG(BCH_GROSS) AS BCH_GROSS, to_char(FROM_TS,'yyyy-mm-dd : hh24') AS FROM_TS  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
						WHERE to_char(FROM_TS,'yyyy-mm-dd')='$tanggal'   GROUP BY FROM_TS order by FROM_TS

                    	"
                        );
                        oci_execute($query4);

                        while (($avg4 = oci_fetch_array($query4, OCI_BOTH)) != false)
                        { 
                            echo ceil($avg4['BCH_GROSS']) . ',';
                        }
                    }
                ?>
            ]
      },
      {
            name: 'BCH_NET',
            color: '#f7ff03',
            data: 
            [
                <?php 
                	if (! empty($tanggal)) {
                        $query5 = oci_parse($koneksi,     
                    	" 
                    	SELECT AVG(BCH_NET) AS BCH_NET, to_char(FROM_TS,'yyyy-mm-dd : hh24') AS FROM_TS  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
						WHERE to_char(FROM_TS,'yyyy-mm-dd')='$tanggal'   GROUP BY FROM_TS order by FROM_TS
                    	"
                        );
                        oci_execute($query5);

                        while (($avg5 = oci_fetch_array($query5, OCI_BOTH)) != false)
                        { 
                            echo ceil($avg5['BCH_NET']) . ',';
                        }
                    }
                ?>
            ]
      }
    ]
});
</script>


@endsection