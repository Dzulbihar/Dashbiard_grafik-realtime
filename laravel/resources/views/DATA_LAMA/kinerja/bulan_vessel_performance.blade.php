@section('header', 'Grafik perbulan Vessel Performance')

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
                        <form action="{{url('/bulan_vessel_performance/cari')}}" method="GET">
                            <p class="card-title"> 
                                <b>Bulan</b>
                                <select name="pilih_bulan" class="btn btn-secondary btn-sm">
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <b>Tahun</b>
                                <select name="pilih_tahun" class="btn btn-secondary btn-sm">
                                    @foreach($pilih_tahun as $pilih)
                                    <option value="{{$pilih->tahun}}">
                                        {{$pilih->tahun}}
                                    </option>
                                    @endforeach
                                </select>
                                <input type="submit" value="Cari" class="btn btn-secondary btn-sm text-white">
                                <?php 
                                    if(isset($_GET['pilih_bulan'],$_GET['pilih_tahun'])){
                                    $pilih_bulan = $_GET['pilih_bulan'];
                                    $pilih_tahun = $_GET['pilih_tahun'];
                                ?>
                                <a class="btn btn-secondary btn-sm text-white"> 
                                    Hasil pencarian, 
                                    <?php
                                      if ($pilih_bulan=='01') {
                                          echo 'Bulan: Januari, ';
                                      }elseif ($pilih_bulan=='02') {
                                            echo 'Bulan: Februari, ';
                                      }elseif ($pilih_bulan=='03') {
                                            echo 'Bulan: Maret, ';
                                      }elseif ($pilih_bulan=='04') {
                                            echo 'Bulan: April, ';
                                      }elseif ($pilih_bulan=='05') {
                                            echo 'Bulan: Mei, ';
                                      }elseif ($pilih_bulan=='06') {
                                            echo 'Bulan: Juni, ';
                                      }elseif ($pilih_bulan=='07') {
                                            echo 'Bulan: Juli, ';
                                      }elseif ($pilih_bulan=='08') {
                                            echo 'Bulan: Agustus, ';
                                      }elseif ($pilih_bulan=='09') {
                                            echo 'Bulan: September, ';
                                      }elseif ($pilih_bulan=='10') {
                                            echo 'Bulan: Oktober, ';
                                      }elseif ($pilih_bulan=='11') {
                                            echo 'Bulan: November, ';
                                      }else{
                                           echo 'Bulan: Desember, ';
                                      }

                                      echo "Tahun: $pilih_tahun, ";
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
                          <div id="perbulan_vessel"></div>
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
Highcharts.chart('perbulan_vessel', {
    chart: {
        type: 'spline'
    },
    title: {
        text: "Laporan kinerja kapal tahun <?php echo $tahun ?> sampai dengan <?php
        if ($bulan=='01') {
            echo 'Bulan Januari ';
        }elseif ($bulan=='02') {
            echo 'Bulan Februari ';
        }elseif ($bulan=='03') {
            echo 'Bulan Maret ';
        }elseif ($bulan=='04') {
            echo 'Bulan April ';
        }elseif ($bulan=='05') {
            echo 'Bulan Mei ';
        }elseif ($bulan=='06') {
            echo 'Bulan Juni ';
        }elseif ($bulan=='07') {
            echo 'Bulan Juli ';
        }elseif ($bulan=='08') {
            echo 'Bulan Agustus ';
        }elseif ($bulan=='09') {
            echo 'Bulan September ';
        }elseif ($bulan=='10') {
            echo 'Bulan Oktober ';
        }elseif ($bulan=='11') {
            echo 'Bulan November ';
        }else{
            echo 'Bulan Desember ';
        } ?>" 
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [ 
            <?php 
                    $query2 = oci_parse($koneksi,     
                        " 
                        SELECT AVG(BSH_GROSS) AS BSH_GROSS,BULAN  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
                        WHERE BULAN<=$bulan AND TAHUN=$tahun GROUP BY BULAN order by BULAN
                        "
                    );
                    oci_execute($query2);

                    while (($avg2 = oci_fetch_array($query2, OCI_BOTH)) != false)
                    { 
                        echo '"' . $avg2['BULAN'] . '",';
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
                    $query2 = oci_parse($koneksi,     
                        " 
                        SELECT AVG(BSH_GROSS) AS BSH_GROSS,BULAN  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
                        WHERE BULAN<=$bulan AND TAHUN=$tahun GROUP BY BULAN order by BULAN
                        "
                    );
                    oci_execute($query2);

                    while (($avg2 = oci_fetch_array($query2, OCI_BOTH)) != false)
                    { 
                        echo ceil($avg2['BSH_GROSS']) . ',';
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
                    $query3 = oci_parse($koneksi,     
                    	" 
                    	SELECT AVG(BSH_NET) AS BSH_NET,BULAN  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
                        WHERE BULAN<=$bulan AND TAHUN=$tahun GROUP BY BULAN order by BULAN
                    	"
                    );
                    oci_execute($query3);

                    while (($avg3 = oci_fetch_array($query3, OCI_BOTH)) != false)
                    { 
                        echo ceil($avg3['BSH_NET']) . ',';
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
                        $query4 = oci_parse($koneksi,     
                    	" 
                    	SELECT AVG(BCH_GROSS) AS BCH_GROSS,BULAN  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
                        WHERE BULAN<=$bulan AND TAHUN=$tahun GROUP BY BULAN order by BULAN
                    	"
                        );
                        oci_execute($query4);

                        while (($avg4 = oci_fetch_array($query4, OCI_BOTH)) != false)
                        { 
                            echo ceil($avg4['BCH_GROSS']) . ',';
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
                        $query5 = oci_parse($koneksi,     
                    	" 
                    	SELECT AVG(BCH_NET) AS BCH_NET,BULAN  FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE  
                        WHERE BULAN<=$bulan AND TAHUN=$tahun GROUP BY BULAN order by BULAN
                    	"
                        );
                        oci_execute($query5);

                        while (($avg5 = oci_fetch_array($query5, OCI_BOTH)) != false)
                        { 
                            echo ceil($avg5['BCH_NET']) . ',';
                        }
                ?>
            ]
      }
    ]
});
</script>


@endsection