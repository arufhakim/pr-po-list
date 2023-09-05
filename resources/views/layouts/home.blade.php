<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- summernote -->
    <!-- <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}"> -->
    <!-- DataTable CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <!--DataTable Fixed Column-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.0.0/css/fixedColumns.dataTables.min.css">
    <!-- DataTable Date Time-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
    <!-- DataTable Fixed Header-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css">
    <!-- DataTable Button-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.bootstrap4.min.css">
    <!-- DataTable Select -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    <!-- Pace-->
    <link rel="stylesheet" href="{{asset('../../external/pace/themes/green/pace-theme-flash.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('../../external/main.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.5/css/scroller.dataTables.min.css">
    <!-- summernote css/js -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @stack('cs')
</head>

<body class="pac-success hold-transitin sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    @include('alert')
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('/home')}}" class="nav-link">Home</a>
                </li>


                <li class="nav-item d-none d-sm-inline-block">

                </li>
            </ul>

            <!-- ROLE ERROR -->
            @if (session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
            @endif

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" style="font-weight: bold;">{{Auth::user()->username}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_password" data-id="{{Auth::user()->id}}" data-name="{{Auth::user()->name}}" data-username="{{Auth::user()->username}}" data-bagian="{{Auth::user()->roles->first()->name}}">Ubah Password</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link ml-1"><i class="fas fa-sign-out-alt"></i> Keluar</button>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-xs fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="warna-dark-green main-sidebar sidebar-dark-primary elevation-4" style="color: white; overflow-x: hidden;">
            <!-- Brand Logo -->
            <div class="row" style="background-color: white; height: 56px">
                <a href="{{route('home')}}">
                    <img src="../../img/petro-logo.png" alt="Petrokimia Logo" width="140px" class="center" style="margin-left: 55px;">
                </a>
            </div>

            <!-- Sidebar -->
            <div class="sidebar" style="margin-top: 10px">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        @role('Admin|PPBJ')
                        <li class="nav-header">DEPARTEMEN PPBJ</li>
                        <li class="nav-item @yield('menuopen5')">
                            <a href="#" class="nav-link @yield('action2')">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Purchase Requisition
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-danger right">
                                        {{$po ?? 0}}
                                    </span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('pr.index')}}" class="nav-link @yield('action21')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Purchase Requisition</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('import_pr_history')}}" class="nav-link @yield('action22')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Import Purchase Requisition</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('menuopen')">
                            <a href="#" class="nav-link @yield('action3')">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Master Data
                                    <i class="fas fa-angle-left right"></i>
                                    <!-- <span class="badge badge-info right">6</span> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('unit.index')}}" class="nav-link @yield('action30')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Daftar User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('status.index')}}" class="nav-link @yield('action33')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Daftar Item Status</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endrole
                        @role('Admin|Jasa Pabrik|Jasa Non Pabrik|Jasa Distribusi & Pemasaran|Jasa Investasi EPC')
                        <li class="nav-header">DEPARTEMEN PENGADAAN JASA</li>
                        <li class="nav-item @yield('menuopen0')">
                            <a href="{{route('home')}}" class="nav-link @yield('action1')">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Laporan Departemen
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('laporan.jasa')}}" class="nav-link @yield('action11')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Pengadaan Jasa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('laporan.distribusi')}}" class="nav-link @yield('action12')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Jasa Distribusi & Pemasaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('laporan.nonpabrik')}}" class="nav-link @yield('action13')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Jasa Non Pabrik</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('laporan.pabrik')}}" class="nav-link @yield('action14')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Jasa Pabrik</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('laporan.investasi')}}" class="nav-link @yield('action15')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Jasa Investasi EPC</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('rekanan.dashboard')}}" class="nav-link @yield('action16')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Dashboard Rekanan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('rekanan.pelayanan')}}" class="nav-link @yield('action17')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Pelayanan Rekanan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('menuopen6')">
                            <a href="#" class="nav-link @yield('action4')">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Proses Tender
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-danger right">
                                        {{$po ?? 0}}
                                    </span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('po.index')}}" class="nav-link @yield('action41')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Proses Tender</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('import_po_history')}}" class="nav-link @yield('action42')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Import Proses Tender</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('menuopen3')">
                            <a class="nav-link @yield('action7')">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Manajemen Vendor
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-danger right">
                                        {{$presentasi ?? 0}}
                                    </span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('rekanan.index')}}" class="nav-link @yield('action71')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Daftar Rekanan</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('import_vendor_history')}}" class="nav-link @yield('action74')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Import Rekanan</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('keluhan.index')}}" class="nav-link @yield('action75')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Daftar Pelayanan Rekanan</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('punishment.index')}}" class="nav-link @yield('action72')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Daftar Punishment Rekanan</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('presentasi.index')}}" class="nav-link @yield('action73')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        Presentasi Company Profile
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('menuopen2')">
                            <a href="#" class="nav-link @yield('action5')">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Master Data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('progress.index')}}" class="nav-link @yield('action51')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Daftar Item Progress</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('sos.index')}}" class="nav-link @yield('action52')">
                                        <i class="nav-icon fas fa-angle-right"></i>
                                        <p>Daftar SoS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('migrasi_list_history')}}" class="nav-link @yield('action8')">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>
                                    Migrasi PR-PO List
                                </p>
                            </a>
                        </li>
                        @endrole
                        @role('Admin')
                        <li class="nav-header">ADMIN</li>
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link @yield('action6')">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Pengguna Sistem
                                </p>
                            </a>
                        </li>
                        @endrole
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 mt-3">
                        <div class="col-sm-6">
                            <h1 style="font-weight: bolder; font-size: 28px;">@yield('header')</h1>
                        </div>
                        <div class="col-sm-6">
                            @yield('address')
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="{{route('home')}}">Pengadaan Jasa | PT Petrokimia Gresik</a>.</strong>
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- EDIT -->
    <div class="modal fade" id="edit_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #001f3f; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Ubah Password</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body mt-2 py-2 px-0">
                    <ul class="nav nav-tabs mb-3 mx-3" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item" style="width: 50%;">
                            <a class="nav-link active text-center" id="custom-content-below-home-tab" data-toggle="pill" href="#detail_ubah" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="font-weight: bolder;">UBAH PASSWORD</a>
                        </li>
                        <li class="nav-item" style="width: 50%;">
                            <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#edit_ubah" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">PANDUAN PENGISIAN PASSWORD</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active" id="detail_ubah" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                            <form action="{{route('user.update', ['user' => Auth::user()->id])}}" method="POST">
                                <div class="row mx-2">
                                    <div class="col-12">
                                        @csrf
                                        @method('patch')
                                        <div class="form-group">
                                            <label class="col-form-label col-form-label-sm" for="name">Nama Lengkap</label>
                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{Auth::user()->name}}" readonly autocomplete="name" placeholder="Nama Lengkap">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label col-form-label-sm" for="username">Username</label>
                                            <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{Auth::user()->username}}" readonly autocomplete="username" placeholder="Username">
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label col-form-label-sm" for="role">Bagian</label>
                                            <input name="role" type="text" class="form-control @error('role') is-invalid @enderror" value="{{Auth::user()->roles->first()->name}}" readonly autocomplete="role" placeholder="role">
                                            @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label col-form-label-sm" for="password_lama">Password Lama<span class="required">*</span></label>
                                            <input type="password" class="form-control @error('password_lama') is-invalid @enderror" name="password_lama" value="{{ old('password_lama') }}" autofocus placeholder="Password Lama">
                                            @error('password_lama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label col-form-label-sm" for="password_baru">Password Baru<span class="required">*</span></label>
                                                <input type="password" class="form-control @error('password_baru') is-invalid @enderror" id="password_baru" name="password_baru" value="{{ old('password_baru') }}" placeholder="Password Baru">
                                                @error('password_baru')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label col-form-label-sm" for="password_konfirmasi">Konfirmasi Password Baru<span class="required">*</span></label>
                                                <input type="password" class="form-control @error('password_konfirmasi') is-invalid @enderror" id="konfirmasi_password" name="password_konfirmasi" value="{{ old('password_konfirmasi') }}" placeholder="Konfirmasi Password Baru">
                                                @error('password_konfirmasi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="tab-pane fade" id="edit_ubah" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                            <div class="col-12 align-self-center">
                                <div class="row mx-3">
                                    <p style="text-align: justify;"><span style="font-weight: bold; font-size: large;"> PANDUAN PENGISIAN PASSWORD </span> <br>
                                        <span style="font-size: small;"> 1. Password terdiri dari minimal 8 karakter. <br>
                                            2. Password setidaknya memiliki 1 huruf besar dan 1 huruf kecil. <br>
                                            3. Password merupakan kombinasi huruf dan angka. <br> </span>
                                    </p>
                                    <p style="font-size: small; text-align: justify;"> <i class="fas fa-info-circle" style="color: blue;"></i> Pengguna dapat mengganti password sesuai dengan keinginannya, dan menjaganya agar selalu bersifat rahasia. <br></br>
                                        <i class="fas fa-info-circle" style="color: blue;"></i> Setiap penyalahgunaan hak akses oleh pihak lain menjadi tanggung jawab pemilik User ID dan password.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Update Password?');"><span style="font-weight:bolder">Simpan</span></button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{asset('dist/js/demo.js')}}"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="{{asset('dist/js/pages/dashboard.js')}}"></script> -->
    <!-- DataTable JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <!-- Moment JS  -->
    <!-- <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/sorting/datetime-moment.js"></script> -->
    <!-- Mask -->
    <!-- InputMask -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- Fixed Column -->
    <script src="https://cdn.datatables.net/fixedcolumns/4.0.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
    <!-- Pace -->
    <script src="{{asset('../../external/pace/pace.js')}}"></script>
    <!-- DataTable Date Time -->
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
    <!-- DataTable Button -->
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.colVis.min.js"></script>
    <!-- DataTable Select -->
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <!-- HighChart -->
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.5/js/dataTables.scroller.min.js"></script>

    <script>
        //DOM Client Side
        $(document).ready(function() {
            $('.datatable tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control" placeholder="" />');
            });
            $('.datatable').DataTable({
                pageLength: 10,
                scrollCollapse: true,
                initComplete: function() {
                    // Apply the search
                    this.api().columns([1, 2, 3]).every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });
                },
            });
        });

        function ClearFilters() {

            $('.form-control').val('');

            var table = $('.datatable').DataTable();
            table
                .search('')
                .columns().search('')
                .draw();
        }



        $('.datatable2').dataTable({
            pageLength: 50,
            scrollY: 360,
            scrollX: true,
            scrollCollapse: true,
        });

        $('.datatable3').dataTable({
            pageLength: 50,
            scrollY: 360,
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: {
                left: 0,
                right: 1,
            },
        });


        //Date picker
        $('#reservationdate, #reservationdate2, #reservationdate3, #reservationdate4,#reservationdate5, #from_date, #to_date').datetimepicker({
            format: 'yy-MM-DD'
        });

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'HH:mm:ss'
        });

        //Searchable Dropdown
        $(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                allowClear: true,
            })
        });


        $('#datemask').inputmask('yyyy-mm-dd', {
            'placeholder': 'yyyy-mm-dd'
        })
        $('[data-mask]').inputmask()
    </script>
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 300,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontname', 'fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['view', ['undo', 'redo', 'fullscreen', 'help']],
            ]
        });
    </script>

    @if($errors->has('password_lama') || $errors->has('password_baru') || $errors->has('password_konfirmasi'))
    <script type="text/javascript">
        $('#edit_password').modal('show');
    </script>
    @endif

    @stack('scripts')
</body>

</html>