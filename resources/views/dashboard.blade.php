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

$pelanggaran_ringan = [];
    $pelanggaran_sedang = [];
    $pelanggaran_berat = [];

    $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];

    for ($i = 1; $i <= 12; $i++) {
        $pelanggaran_ringan[] = Pelanggaran::where('tingkat_pelanggaran', 'ringan')
            ->whereMonth('tgl_pelanggaran', $i)
            ->count();

        $pelanggaran_sedang[] = Pelanggaran::where('tingkat_pelanggaran', 'sedang')
            ->whereMonth('tgl_pelanggaran', $i)
            ->count();

        $pelanggaran_berat[] = Pelanggaran::where('tingkat_pelanggaran', 'berat')
            ->whereMonth('tgl_pelanggaran', $i)
            ->count();
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

    <title>Dashboard</title>

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
									<p class="card-category">Hasil Konseling</p> 


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
.highcharts-credits {
display: none !important;
}

		</style>
		
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/series-label.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		
		<figure class="highcharts-figure">
			<div id="container"></div>
			<p class="highcharts-description" style="color: #ffffff">
				---------------------------------------------------------------------
		</figure>
		<script>

			Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik Pelanggaran'
    },

    xAxis: {
        categories: ['Ringan', 'Sedang', 'Berat'],
        accessibility: {
            description: 'Tingkat Pelanggaran'
        }
    },
	xAxis: {
            categories: {!! json_encode($bulan) !!},
            accessibility: {
                description: 'Bulan'
            }
        },
    yAxis: {
        title: {
            text: 'Jumlah Pelanggaran'
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
	series: [{
            name: 'Ringan',
            data: {!! json_encode($pelanggaran_ringan) !!}
        }, {
            name: 'Sedang',
            data: {!! json_encode($pelanggaran_sedang) !!}
        }, {
            name: 'Berat',
            data: {!! json_encode($pelanggaran_berat) !!}
        }]

		});

		</script>
		@endif
		
</section>
@endsection