<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../external/main.css">
</head>
<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #001f3f;
        /* Safari */
        position: sticky;
        top: 0;
        z-index: 1;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #111;
    }

    .active {
        background-color: #4CAF50;
    }

    .jumbotron {
        background-image: url("../img/login-9.jpg");
        background-size: cover;
        background-position: bottom;
        height: 100px;
        border-radius: 0;
    }
</style>

<body class="hold-transition layout-top-nav layout-footer-fixed text-sm">
    <div class="wrapper">
        <div class="header">
            <div class="jumbotron mb-0">
            </div>
        </div>
        <ul>
            <li><a href="{{route('login')}}">Login</a></li>
            <li><a class="active" href="{{route('presentasi.create')}}">Presentasi Vendor</a></li>
            <li style="float:right"><a href="#contact">Kontak</a></li>
        </ul>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                    </div>
                </div>
            </div>
            <div class="content mx-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-navy">
                            <div class="card-header" style="line-height: 10px;">
                                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Ajukan Presentasi</h3>
                                <!-- tool -->
                                <div class="card-tools" style="margin-top: 2px;">
                                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                                    </button>
                                </div>
                                <!-- /tool -->
                            </div>
                            <div class="card-body">
                                <form action="{{route('presentasi.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="tipe_perusahaan">Tipe perusahaan<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <select id="tipe_perusahaan" name="tipe_perusahaan" class="form-control select2bs4 @error('tipe_perusahaan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                        <option value=''></option>
                                                        <option value='CV' @if(old('tipe_perusahaan')=='CV' ) selected @endif>CV</option>
                                                        <option value='PT' @if(old('tipe_perusahaan')=='PT' ) selected @endif>PT</option>
                                                        <option value='UD' @if(old('tipe_perusahaan')=='UD' ) selected @endif>UD</option>
                                                        <option value='PO' @if(old('tipe_perusahaan')=='PO' ) selected @endif>PO</option>
                                                        <option value='KOPERASI' @if(old('tipe_perusahaan')=='KOPERASI' ) selected @endif>KOPERASI</option>
                                                        <option value='KUD' @if(old('tipe_perusahaan')=='KUD' ) selected @endif>KUD</option>
                                                        <option value='YAYASAN' @if(old('tipe_perusahaan')=='YAYASAN' ) selected @endif>YAYASAN</option>
                                                        <option value='DINAS' @if(old('tipe_perusahaan')=='DINAS' ) selected @endif>DINAS</option>
                                                        <option value='PUSKUD' @if(old('tipe_perusahaan')=='PUSKUD' ) selected @endif>PUSKUD</option>
                                                        <option value='BAPAK' @if(old('tipe_perusahaan')=='BAPAK' ) selected @endif>BAPAK</option>
                                                        <option value='IBU' @if(old('tipe_perusahaan')=='IBU' ) selected @endif>IBU</option>
                                                        <option value='PD' @if(old('tipe_perusahaan')=='PD' ) selected @endif>PD</option>
                                                        <option value='TOKO' @if(old('tipe_perusahaan')=='TOKO' ) selected @endif>TOKO</option>
                                                        <option value='KIOS' @if(old('tipe_perusahaan')=='KIOS' ) selected @endif>KIOS</option>
                                                        <option value='GAPOKTAN' @if(old('tipe_perusahaan')=='GAPOKTAN' ) selected @endif>GAPOKTAN</option>
                                                        <option value='COMPANY' @if(old('tipe_perusahaan')=='COMPANY' ) selected @endif>COMPANY</option>
                                                    </select>
                                                    @error('tipe_perusahaan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="nama_vendor">Nama Vendor<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control @error('nama_vendor') is-invalid @enderror" value="{{old('nama_vendor')}}" id="nama_vendor" placeholder="Nama Vendor" name="nama_vendor">
                                                    @error('nama_vendor')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="email_vendor">Email Perusahaan</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control @error('email_vendor') is-invalid @enderror" value="{{old('email_vendor')}}" id="email_vendor" placeholder="Email Perusahaan" name="email_vendor">
                                                    @error('email_vendor')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="website_vendor">Website Perusahaan</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control @error('website_vendor') is-invalid @enderror" value="{{old('website_vendor')}}" id="website_vendor" placeholder="http://www.example.com/" name="website_vendor">
                                                    @error('website_vendor')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="bidang_usaha">Bidang Usaha<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <textarea id="bidang_usaha" class="form-control @error('bidang_usaha') is-invalid @enderror" name="bidang_usaha" rows="2" cols="50">{{old('bidang_usaha')}}</textarea>
                                                    @error('bidang_usaha')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="merk">Merk/Brand</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control @error('merk') is-invalid @enderror" value="{{old('merk')}}" id="merk" placeholder="Merk/Brand" name="merk">
                                                    @error('merk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="nama_pic">Nama PIC<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control @error('nama_pic') is-invalid @enderror" value="{{old('nama_pic')}}" id="nama_pic" placeholder="Nama PIC" name="nama_pic">
                                                    @error('nama_pic')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="email_pic">Email PIC<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control @error('email_pic') is-invalid @enderror" value="{{old('email_pic')}}" id="email_pic" placeholder="Email PIC" name="email_pic">
                                                    @error('email_pic')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="no_hp_pic">No HP PIC<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control @error('no_hp_pic') is-invalid @enderror" value="{{old('no_hp_pic')}}" id="no_hp_pic" placeholder="081xxx" name="no_hp_pic">
                                                    @error('no_hp_pic')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="company_profile">Company Profile<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <div class="custom-file">
                                                        <input type="file" name="company_profile" class="custom-file-input @error('company_profile') is-invalid @enderror" placeholder="Company Profile" value="{{old('company_profile')}}" id="company_profile">
                                                        <label class="custom-file-label" for="company_profile">Choose file</label>
                                                        @error('company_profile')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="katalog">Katalog<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <div class="custom-file">
                                                        <input type="file" name="katalog" class="custom-file-input @error('katalog') is-invalid @enderror" placeholder="Katalog" value="{{old('katalog')}}" id="katalog">
                                                        <label class="custom-file-label" for="katalog">Choose file</label>
                                                        @error('katalog')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="surat_permohonan">Surat Permohonan<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <div class="custom-file">
                                                        <input type="file" name="surat_permohonan" class="custom-file-input @error('surat_permohonan') is-invalid @enderror" placeholder="Surat Permohonan" value="{{old('surat_permohonan')}}" id="surat_permohonan">
                                                        <label class="custom-file-label" for="surat_permohonan">Choose file</label>
                                                        @error('surat_permohonan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label col-form-label-sm" for="pengalaman_kerja">Pengalaman Kerja<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <div class="custom-file">
                                                        <input type="file" name="pengalaman_kerja" class="custom-file-input @error('pengalaman_kerja') is-invalid @enderror" placeholder="Pengalaman Kerja" value="{{old('pengalaman_kerja')}}" id="pengalaman_kerja">
                                                        <label class="custom-file-label" for="pengalaman_kerja">Choose file</label>
                                                        @error('pengalaman_kerja')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success float-right"><span style="font-weight:bolder">Submit</span></button>
                                    <a href="{{route('login')}}" class="btn btn-warning float-right mr-2"><span style="font-weight:bolder">Batal</span></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @push('scripts')
                <script>
                    $('.custom-file-input').on('change', function() {
                        //get the file name
                        var fileName = $(this).val();
                        //replace the "Choose a file" label
                        $(this).next('.custom-file-label').html(fileName);
                    })
                </script>
                @endpush
                <!-- jQuery -->
                <script src="../../plugins/jquery/jquery.min.js"></script>
                <!-- Bootstrap 4 -->
                <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- AdminLTE App -->
                <script src="../../dist/js/adminlte.min.js"></script>

            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer" style="background-color: #001f3f">
            <strong>Copyright &copy; 2021 <a href="{{route('home')}}">Pengadaan Jasa | PT Petrokimia Gresik</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script>
        var images = new Array(
            '../img/login-1.jpg',
            '../img/login-2.jpg',
            '../img/login-3.jpg',
            '../img/login-4.jpg',
            '../img/login-5.jpg',
            '../img/login-6.jpg',
            '../img/login-7.jpg',
            '../img/login-8.jpg',
            '../img/login-0.jpg',
        );

        var slider = setInterval(function() {
            document.getElementsByClassName('bg-img')[0].setAttribute('style', 'background-image: url("' + images[0] + '")');
            images.splice(images.length, 2, images[0]);
            images.splice(0, 1);
        }, 5000);
    </script>
</body>

</html>