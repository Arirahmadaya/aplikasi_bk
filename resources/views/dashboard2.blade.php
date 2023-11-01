<!-- Main content -->
@extends("layout")
@section("content")
@php
    use Illuminate\Support\Facades\Auth;

    use App\Models\User;
    $total_user = User::count();

    use App\Models\Siswa;
	if (Auth::user()->role == 'wali_kelas') {
    $id_wali_kelas = Auth::user()->wali_kelas->id;
    $total_siswa = Siswa::whereHas('kelas.wali_kelas', function ($query) use ($id_wali_kelas) {
        $query->where('id', $id_wali_kelas);
    })->count();

	}else {
		$total_siswa = Siswa::count();
	} 	

    
    use App\Models\Kelas;
    $total_kelas = Kelas::count();

    use App\Models\Riwayat;
	if (Auth::user()->role == 'wali_kelas') {
    $id_wali_kelas = Auth::user()->wali_kelas->id;
    $total_riwayat = Riwayat::whereHas('konseling.pelanggaran.siswa.kelas.wali_kelas', function ($query) use ($id_wali_kelas) {
        $query->where('id', $id_wali_kelas);
    })->count();
	}else {
	$total_riwayat = Riwayat::count();
	} 


	use App\Models\Pelanggaran;
	
    if (Auth::user()->role == 'siswa') {
    $id_siswa = Auth::user()->siswa->id; 
    $total_pelanggaran = Pelanggaran::whereHas('siswa', function ($query) use ($id_siswa) {
        $query->where('id', $id_siswa);
    })->count();
} elseif (Auth::user()->role == 'wali_kelas') {
    $id_wali_kelas = Auth::user()->wali_kelas->id;
    $total_pelanggaran = Pelanggaran::whereHas('siswa.kelas.wali_kelas', function ($query) use ($id_wali_kelas) {
        $query->where('id_wali_kelas', $id_wali_kelas);
    })->count();
} else {
    $total_pelanggaran = Pelanggaran::count();
}


	use App\Models\Konseling;
	$id_siswa = null;
	if (Auth::user()->role == 'siswa' && Auth::user()->siswa) {
    $id_siswa = Auth::user()->siswa->id;
    $total_konseling = Konseling::whereHas('pelanggaran.siswa', function ($query) use ($id_siswa) {
        $query->where('id', $id_siswa);
    })->count();
	} else {
    // Logika jika user bukan siswa
    $total_konseling = Konseling::count();
	}
    
	use App\Models\Hasil;
    $total_hasil = Hasil::count();

@endphp

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Charts</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

<style type="text/css">/* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}</style></head>
<section class="content-header bg-gradient-white">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Dashboard</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				</ol>
			</div>
		</div>
	</div> 
	<div class="row">
		@if (Auth::user()->role == 'operator')    
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-warning">
									<i class="fas fa-users fa-4x text-warning"></i>
								</div>
							</div>
						</div>
						              
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">User</p> 
                                   

									<h4 class="card-title"> {{$total_user}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="operator/user" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
					
				</div>
			</div>
		</div> 
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-success">
									<i class="fas fa-user-graduate fa-4x text-success"></i>
								</div>
							</div>
						</div> 
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Siswa</p> 
                                   

									<h4 class="card-title"> {{$total_siswa}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="operator/siswa" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
				</div>
			</div>
		</div> 
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-danger">
									<i class="fas fa-school fa-4x text-danger"></i>
								</div>
							</div>
						</div> 
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Kelas</p> 

                                    <h4 class="card-title">{{$total_kelas}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="operator/kelas" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
				</div>
			</div>
		</div> 
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-info">
									<i class="fas fa-list fa-4x text-info"></i>
								</div>
							</div>
						</div> 
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category"> <strong> Riwayat</strong></p> 


                                <h4 class="card-title">{{$total_riwayat}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="operator/riwayat" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
				</div>
			</div>
		</div>
		@endif
				
		@if (Auth::user()->role == 'guru_bk')  
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">  
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-warning">
									<i class="fas fa-exclamation-circle fa-4x text-danger"></i>
								</div>
							</div>
						</div>              
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Pelanggaran</p> 
									<h4 class="card-title"> {{$total_pelanggaran}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="guru_bk/pelanggaran" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
					
				</div>
			</div>
		</div> 
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-success">
									<i class="fas fa-user-graduate fa-4x text-success"></i>
								</div>
							</div>
						</div> 
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Siswa</p> 
                                   

									<h4 class="card-title"> {{$total_siswa}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="guru_bk/siswa" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
				</div>
			</div>
		</div> 
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-danger">
									<i class="fas fa-clock fa-4x text-warning"></i>
								</div>
							</div>
						</div> 
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Konseling</p> 

                                    <h4 class="card-title">{{$total_konseling}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="guru_bk/konseling" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
				</div>
			</div>
		</div> 
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-info">
									<i class="fas fa-file-alt fa-4x text-info"></i>
								</div>
							</div>
						</div> 
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category"> <strong>Hasil Konseling</strong></p> 


                                <h4 class="card-title">{{$total_hasil}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="guru_bk/hasil" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
				</div>
			</div>
		</div>
		@endif

		@if (Auth::user()->role == 'wali_kelas')  
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-success">
									<i class="fas fa-user-graduate fa-4x text-success"></i>
								</div>
							</div>
						</div> 
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Siswa</p> 
                                   

									<h4 class="card-title"> {{$total_siswa}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="wali_kelas/siswa" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
				</div>
			</div>
		</div> 
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">  
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-warning">
									<i class="fas fa-exclamation-circle fa-4x text-danger"></i>
								</div>
							</div>
						</div>              
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Pelanggaran</p> 
									<h4 class="card-title"> {{$total_pelanggaran}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="wali_kelas/pelanggaran" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
					
				</div>
			</div>
		</div> 
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">  
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-warning">
									<i class="fas fa-list fa-4x text-info"></i>
								</div>
							</div>
						</div>              
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Riwayat</p> 
									<h4 class="card-title"> {{$total_riwayat}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="wali_kelas/riwayat" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
					
				</div>
			</div>
		</div> 
		@endif

		@if (Auth::user()->role == 'siswa')  
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">  
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-warning">
									<i class="fas fa-exclamation-circle fa-4x text-danger"></i>
								</div>
							</div>
						</div>              
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Pelanggaran Saya</p> 
									<h4 class="card-title"> {{$total_pelanggaran}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="siswa/pelanggaran" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
					
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<div class="icon-danger">
									<i class="fas fa-clock fa-4x text-warning"></i>
								</div>
							</div>
						</div> 
						<div class="col-7">
							<div class="numbers">
								<div>
									<p class="card-category">Jadwal Konseling</p> 

                                    <h4 class="card-title">{{$total_konseling}}</h4>
								</div>
							</div>
						</div>
					</div> 
				</div> 
				<div class="card-footer">
					<hr> 
					<div class="icon">
						
					</div>
					<a href="siswa/konseling" class="small-box-footer" style="color: #000000;">
						Lihat Detail <i class="fas fa-arrow-circle-right" style="color: #015f10;"></i>
					</a>
				</div>
			</div>
		</div> 
		@endif 
		<style>
			.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/series-label.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		
		<figure class="highcharts-figure">
			<div id="container"></div>
			<p class="highcharts-description">
				This chart shows how symbols and shapes can be used in charts.
				Highcharts includes several common symbol shapes, such as squares,
				circles and triangles, but it is also possible to add your own
				custom symbols. In this chart, custom weather symbols are used on
				data points to highlight that certain temperatures are warm while
				others are cold.
			</p>
		</figure>
		<script>
	
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik Pelanggaran'
    },
    subtitle: {
        text: 'Source: ' +
            '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
            'target="_blank">Wikipedia.com</a>'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        accessibility: {
            description: 'Months of the year'
        }
    },
    yAxis: {
        title: {
            text: 'Tingkat Pelanggaran'
        },
        labels: {
            format: '{value}°'
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
        }
    },
    series: [{
        name: 'Ringan',
        marker: {
            symbol: 'square'
        },
        data: [5.2, 5.7, 8.7, 13.9, 18.2, 21.4, 25.0, {
            y: 26.4,
            marker: {
                symbol: 'url(https://www.highcharts.com/samples/graphics/sun.png)'
            },
            accessibility: {
                description: 'Sunny symbol, this is the warmest point in the chart.'
            }
        }, 22.8, 17.5, 12.1, 7.6]

    }, {
        name: 'Sedang',
        marker: {
            symbol: 'diamond'
        },
        data: [{
            y: 1.5,
            marker: {
                symbol: 'url(https://www.highcharts.com/samples/graphics/snow.png)'
            },
            accessibility: {
                description: 'Snowy symbol, this is the coldest point in the chart.'
            }
        }, 1.6, 3.3, 5.9, 10.5, 13.5, 14.5, 14.4, 11.5, 8.7, 4.7, 2.6]
    }, {
		name: 'Berat',
        marker: {
            symbol: 'diamond'
        },
        data: [{
            y: 1.5,
            marker: {
                symbol: 'url(https://www.highcharts.com/samples/graphics/snow.png)'
            },
            accessibility: {
                description: 'Snowy symbol, this is the coldest point in the chart.'
            }
        }, 1.6, 3.3, 5.9, 10.5, 13.5, 14.5, 14.4, 11.5, 8.7, 4.7, 2.6]
	}]
});

		</script>
		
</section>
@endsection