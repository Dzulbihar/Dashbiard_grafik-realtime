@section('header', 'Grafik Vessel Performance')

@extends('layouts.app')

@section('content')


<?php 
    $koneksi=oci_connect ("DASHBOARDGRAFIK","123456","LOCALHOST/orcl");
 ?>

<br>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

                <div class="card">
                  <div class="card-header">
                    <form action="{{url('/grafik_vessel_performance/cari')}}" method="GET">
                        <!-- <h3 class="card-title"> -->
                        <div class="form-group row">
                            <div class="col-md-2">
                                Pilih Kapal
                            </div>
                            <div class="col-md-4">
                                <select type="text" name="cari" class="btn btn-default btn-sm select2" style="width: 300px; height:55px">
                                <option>  Pilih Kapal  </option>
                                    @foreach($vessel_detail as $vessel)
                                    <option value="{{$vessel->ves_id}}"> 
                                        {{$vessel->ves_name}} ({{$vessel->ves_id}})
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <input type="submit" value="CARI" class="btn btn-default btn-sm">
                                <?php 
                                    if(isset($_GET['cari'])){
                                    $cari = $_GET['cari'];
                                ?>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                    </form>
                    <br>      
                  </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <figure class="highcharts-figure">
                          <div id="performance_vessel"></div>
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
Highcharts.chart('performance_vessel', {
    chart: {
        type: 'spline'
    },
    title: {
        text: " <?php if (! empty($cari)) { echo "VES ID Kapal : $cari"; } else{echo "Silakan pilih kapal untuk melihat grafik laporan kinerja perkapal";}?>"
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [ 
            <?php 
                if (! empty($cari)) {
                    $query1 = oci_parse($koneksi,     
                    " 
                    SELECT to_char(FROM_TS,'hh24 : dd-mm-yyyy') JAM
                    FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE 
                    WHERE VES_ID='$cari' GROUP BY FROM_TS order by FROM_TS
                    "
                    );
                    oci_execute($query1);

                    while (($KPI = oci_fetch_array($query1, OCI_BOTH)) != false)
                    { 
                        echo '"(' . $KPI['JAM'] . ')",';
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
                if (! empty($cari)) {
                    $query2 = oci_parse($koneksi,     
                        " 
                        SELECT AVG(BSH_GROSS) AS BSH_GROSS
                        FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE 
                        WHERE VES_ID='$cari' GROUP BY FROM_TS,TO_TS order by FROM_TS
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
                if (! empty($cari)) {
                    $query3 = oci_parse($koneksi,     
                    " 
                    SELECT AVG(BSH_NET) AS BSH_NET
                    FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE 
                    WHERE VES_ID='$cari' GROUP BY FROM_TS,TO_TS order by FROM_TS
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
                    if (! empty($cari)) {
                        $query4 = oci_parse($koneksi,     
                        " 
                        SELECT AVG(BCH_GROSS) AS BCH_GROSS
                        FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE 
                        WHERE VES_ID='$cari' GROUP BY FROM_TS,TO_TS order by FROM_TS
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
                    if (! empty($cari)) {
                        $query5 = oci_parse($koneksi,     
                            " 
                            SELECT AVG(BCH_NET) AS BCH_NET
                            FROM DASHBOARDGRAFIK.VESSEL_PERFORMANCE 
                            WHERE VES_ID='$cari' GROUP BY FROM_TS,TO_TS order by FROM_TS
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

