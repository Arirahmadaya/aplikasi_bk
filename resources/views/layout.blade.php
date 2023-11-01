<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Bimbingan Konseling</title>
    <link rel="icon" href="../../dist/img/logosekolah.png" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../css/sb-admin.css">
    <link rel="stylesheet" href="../../css/sb-admin.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">

    <style>

        p, h3{
            color: rgb(1, 44, 8);
          
        }
        
        /* .sidebar-dark-primary {
            background: linear-gradient(to bottom right, #0bfc02, #0bfc02, #ffffff, #ffffff, #ffffff, #ffffff, #ffffff);
                   
            
        } */
        .sidebar-dark-primary {
  background-image: radial-gradient(circle at top left, #ffffff, transparent),
                    linear-gradient(to bottom right,   #eafdea, #eafdea, #d0fce6, #dbffe4);
  background-size: 100% 100%, auto;
  background-repeat: no-repeat;
  background-position: top left;
}
  
                    
           .main-header, .navbar, .navbar-expand
        {
                    background: linear-gradient(to bottom right, #ffffff, #ffffff, #ffffff, #fdfffd,  #f8fcf8, #f4faf4, #015f10);
                    
        }
        
                a.brand-link {
        color: rgb(1, 44, 8);
 
        }


      
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars" style="color: rgb(1, 44, 8);"></i>
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <li class="nav-item d-none d-sm-inline-block">
                  <ul class="nav-link"></ul>
                </li>
                </li>
                <li class="nav-item">
                <li class="nav-item d-none d-sm-inline-block">
                
                    <ul class="nav-link" style="color: rgb(1, 44, 8);"><strong style="font-size: 20px;"> Aplikasi Bimbingan Konseling</strong></ul>
                </li>
                </li>
              </ul>
       
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <li class="nav-item d-none d-sm-inline-block">
                  <ul class="nav-link" id="jam"></ul>
                </li>
                </li>
                <li class="nav-item">
                <li class="nav-item d-none d-sm-inline-block">
                  <?php
                  $tgl = date('d-m-Y');
                  ?>
                  <ul class="nav-link"><?= $tgl ?></ul>
                </li>
                </li>
              </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
           


            <!-- Sidebar -->
            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/logo_user.jpg" class="img-md elevation-2" alt="User Image"  style="width: 50px; height: 50px;">
                    </div>
                    <div class="info">
                        @if (Auth::user()->role == 'operator')
                        <a href="{{ url('') }}/admin/operator/profile"   class="d-block">
                        @endif
                        @if (Auth::user()->role == 'guru_bk')
                        <a href="{{ url('') }}/admin/guru_bk/profile"   class="d-block">
                        @endif
                        @if (Auth::user()->role == 'wali_kelas')
                        <a href="{{ url('') }}/admin/wali_kelas/profile"   class="d-block">
                        @endif
                        @if (Auth::user()->role == 'siswa')
                        <a href="{{ url('') }}/admin/siswa/profile"   class="d-block">
                        @endif
                            <span class="brand-text font-weight-light" style="color: rgb(1, 44, 8);">
                                <strong>{{ Auth::user()->nama }}</strong>
                            </span>
                        </a>
                    </div>
                </div>
                

                {{-- <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::user()->role == 'operator')
                            <li class="nav-item">
                                <a href="{{ url('') }}/admin/operator" class="nav-link">
                                    <i class="nav-icon fas fa-home" style="color:#015f10"></i>
                                    <p>
                                        Home
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-database" style="color: #015f10"></i>
                                    <p>
                                        Data Master
                                        <i class="right fas fa-angle-left" style="color: #015f10"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('') }}/admin/operator/user" class="nav-link">
                                            <i class="fas fa-users nav-icon" style="color: rgb(1, 44, 8);" ></i>
                                            <p>Data User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('') }}/admin/operator/siswa" class="nav-link">
                                            <i class="fas fa-user-graduate nav-icon" style="color: rgb(1, 44, 8);"></i>
                                            <p>Data Siswa</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('') }}/admin/operator/kelas" class="nav-link">
                                            <i class="fas fa-building nav-icon" style="color: rgb(1, 44, 8);"></i>
                                            <p>Data Kelas</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('') }}/admin/operator/walikelas" class="nav-link">
                                            <i class="fas fa-user-tie nav-icon" style="color: rgb(1, 44, 8);"></i>
                                            <p>Data Wali Kelas</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url('') }}/admin/operator/operator" class="nav-link">
                                            <i class="fas fa-user-tie nav-icon" style="color: rgb(1, 44, 8);"></i>
                                            <p>Data Operator</p>
                                        </a>
                                    </li>

                                    
                                    <li class="nav-item">
                                        <a href="{{ url('') }}/admin/operator/gurubk" class="nav-link">
                                            <i class="fas fa-user-tie nav-icon" style="color: rgb(1, 44, 8);"></i>
                                            <p>Data Guru BK</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'wali_kelas')
                            <li class="nav-item">
                                <a href="{{ url('') }}/admin/wali_kelas" class="nav-link">
                                    <i class="nav-icon fas fa-home" style="color: #015f10"></i>
                                    <p>
                                        Home
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('') }}/admin/wali_kelas/siswa" class="nav-link">
                                    <i class="fas fa-user-graduate nav-icon" style="color: rgb(1, 44, 8);"></i>
                                    <p>
                                        Data Siswa
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                              <a href="{{ url('') }}/admin/wali_kelas/pelanggaran" class="nav-link">
                                  <i class="fa fa-exclamation-circle nav-icon" style="color: #a70d21"></i>
                                  <p>
                                      Data Pelanggaran
                                  </p>
                              </a>
                          </li>

                          <li class="nav-item">
                            <a href="{{ url('') }}/admin/wali_kelas/riwayat" class="nav-link">
                                <i class="fas fa-list nav-icon" style="color: rgb(1, 44, 8);"></i>
                                <p>Data Riwayat Konseling</p>
                            </a>
                        </li>

                        @endif

                        @if (Auth::user()->role == 'guru_bk')
                        <li class="nav-item">
                            <a href="{{ url('') }}/admin/guru_bk" class="nav-link">
                                <i class="nav-icon fas fa-home" style="color: #015f10"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database" style="color: #015f10"></i>
                                <p>
                                    Data Master
                                    <i class="right fas fa-angle-left" style="color: rgb(1, 44, 8);"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ url('') }}/admin/guru_bk/siswa" class="nav-link">
                                        <i class="fas fa-user-graduate nav-icon" style="color: rgb(1, 44, 8);"></i>
                                        <p>Data Siswa</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('') }}/admin/guru_bk/kelas" class="nav-link">
                                        <i class="fas fa-school nav-icon" style="color: rgb(1, 44, 8);"></i>
                                        <p>Data Kelas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('') }}/admin/guru_bk/pelanggaran" class="nav-link">
                                        <i class="fa fa-exclamation-circle nav-icon" style="color:#a70d21"></i>
                                        <p>Data Pelanggaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('') }}/admin/guru_bk/konseling" class="nav-link">
                                        <i class="fas fa-clock nav-icon" style="color: rgb(1, 44, 8);"></i>
                                        <p>Data Konseling</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('') }}/admin/guru_bk/hasil" class="nav-link">
                                        <i class="fas fa-file nav-icon" style="color: rgb(1, 44, 8);"></i>
                                        <p>Data Hasil Konseling</p>
                                    </a>
                                </li>
                                


                            </ul>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'siswa')
                            <li class="nav-item">
                                <a href="{{ url('') }}/admin/siswa" class="nav-link">
                                    <i class="nav-icon fas fa-home " style="color: #015f10"></i>
                                    <p>
                                        Home
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('') }}/admin/siswa/pelanggaran" class="nav-link">
                                    <i class="fas fa-exclamation-circle nav-icon" style="color: #a70d21"></i>
                                    <p>
                                        Pelanggaran Saya
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('') }}/admin/siswa/konseling" class="nav-link">
                                    <i class="fas fa-clock nav-icon" style="color: #f5bb3e"></i>
                                    <p>
                                        Jadwal Konseling
                                    </p>
                                </a>
                            </li>
                           
                        @endif
                        <li class="nav-item">
                            <a href="/logout" class="nav-link">
                                <i class="fas nav-icon fa-sign-out-alt" style="color: #015f10"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->


            @yield('content')
        </div>
        <div></div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="background: linear-gradient(to bottom right,  #015f10,  #015f10, #ffffff, #ffffff, #ffffff, #ffffff, #015f10,  #015f10">
            <div class="float-right d-none d-sm-block">
            </div>
            <div style="text-align: center;">
                <img src="../../dist/img/logosekolah.png" alt="logo sekolah" class="brand-image img-circle " style="opacity: .8; width: 0.8cm; height: 0.8cm;">
                <strong style="color: rgb(1, 44, 8); font-size: 14px;">Madrasah Aliyah Al-Fatah Palembang</strong> 
                <a href="https://maps.google.com/maps?q=Jl.%20Profesor%20KH%20No.672,%20Pahlawan,%20Kec.%20Kemuning,%20Kota%20Palembang,%20Sumatera%20Selatan%2030151" target="_blank" style="color: rgb(1, 44, 8); font-size: 12px;">
                    <br>Alamat: Jl. Profesor KH No.672, Pahlawan, Kec. Kemuning, Kota Palembang, Sumatera Selatan 30151
                </a>
            </div>
        </footer>

        
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-white">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <script>
        function updateJam() {
            var now = new Date();
            var jam = now.getHours();
            var menit = now.getMinutes();
            var detik = now.getSeconds();
      
            // Tambahkan angka 0 di depan jam, menit, dan detik jika kurang dari 10
            jam = (jam < 10 ? "0" : "") + jam;
            menit = (menit < 10 ? "0" : "") + menit;
            detik = (detik < 10 ? "0" : "") + detik;
      
            var waktu = jam + ":" + menit + ":" + detik;
            document.getElementById("jam").innerHTML = waktu;
      
            // Panggil fungsi ini setiap 1 detik (1000 milidetik)
            setTimeout(updateJam, 1000);
        }
      
        // Panggil fungsi updateJam() untuk pertama kali
        updateJam();
      </script>


</body>

</html>
