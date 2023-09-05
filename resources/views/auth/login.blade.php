<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Pace-->
    <link rel="stylesheet" href="{{asset('../../external/pace/themes/green/pace-theme-flash.css')}}">
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <!-- Pace -->
    <script src="{{asset('../../external/pace/pace.js')}}"></script>

    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #B0BEC5;
            background-repeat: no-repeat
        }

        .card2 {
            margin: 0px 40px
        }

        .logo {
            width: 170px;
            margin-top: 20px;
            margin-left: 35px
        }

        .image {
            width: 400px;
            height: 280px;
        }

        .text-sm {
            font-size: 14px !important
        }

        .text-xs {
            font-size: 12px !important
        }

        .nav-tabs .nav-link.active {
            background: #007bff;
            color: #fff;
            border: 0;
            border-radius: 0;
        }

        .nav-tabs .nav-link {
            background: #001f3f;
            color: #fff;
            border: 0;
            border-radius: 0;

        }

        ::placeholder {
            font-size: 12px;
        }

        .btn-blue {
            background-color: #001f3f;
            width: 150px;
            color: #fff;
            border-radius: 2px;
        }

        .btn-green {
            background-color: #0f9e3e;
            width: 150px;
            color: #fff;
            border-radius: 2px;
        }

        .btn-yellow {
            background-color: #ffc107;
            width: 150px;
            color: #000;
            border-radius: 2px;
        }

        .btn-blue:hover {
            background-color: #000;
            cursor: pointer
        }

        .bg-blue {
            color: #fff;
            background-color: #001f3f
        }

        .required {
            color: red;
        }

        .select2-selection__rendered {
            font-size: 12px;
            margin-top: 2px;
        }

        input,
        textarea {
            font-size: 12px !important;
        }

        .g-recaptcha {
            transform: scale(0.77);
            -webkit-transform: scale(0.77);
        }
    </style>
</head>

<body>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 pt-4 m-3 mx-auto">
        <div class="card card0 border-0">
            <ul class="nav nav-tabs kembali" id="custom-content-below-tab" role="tablist">
                <li class="nav-item" style="width: 50%;">
                    <a class="nav-link active text-center" id="custom-content-below-home-tab" data-toggle="pill" href="#detail" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="font-weight: bolder;">LOGIN</a>
                </li>
                <li class="nav-item" style="width: 50%;">
                    <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#edit" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">PRESENTASI COMPANY PROFILE</a>
                </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
                <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                    <div class="row mx-3 py-4 d-flex">
                        <div class="col-lg-6">
                            <div class="card1 pb-2">
                                <div class="row">
                                    <img src="../../img/petro-logo.png" class="logo">
                                </div>
                                <div class="row justify-content-center mt-4 mb-5 border-line">
                                    <img src="../../img/login_page.png" class="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card2 card border-0 px-4 py-5 mt-4">
                                <div class="row justify-content-center mb-4 px-3">
                                    <strong>LOGIN</strong>
                                </div>
                                <form class="form-auth-small" action="/login" method="POST">
                                    @csrf
                                    <div class="row px-3 mb-4">
                                        <label class="mb-1">
                                            <h6 class="mb-0 text-sm">Username</h6>
                                        </label>
                                        <input class="form-control @error('username') is-invalid @enderror" type="username" name="username" placeholder="Username">
                                        @error('username')
                                        <div class="invalid-feedback text-xs">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="row px-3">
                                        <label class="mb-1">
                                            <h6 class="mb-0 text-sm">Password</h6>
                                        </label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id=" signin-password" placeholder="Password">
                                        @error('password')
                                        <div class="invalid-feedback text-xs">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="row px-3 mb-4 mt-2">
                                        <div class="custom-control custom-checkbox custom-control-inline"> <input id="remember" type="checkbox" name="remember" class="custom-control-input"> <label for="remember" class="custom-control-label text-sm">Ingat Saya</label> </div>
                                    </div>
                                    <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Login</button> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                    <div class="row p-4">
                        <div class="col-md-12">
                            <form id="form-pengajuan" action="{{route('presentasi.store')}}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="tipe_perusahaan">Tipe Perusahaan<span class="required">*</span></label>
                                            <div class="col-md-8">
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
                                                <div class="invalid-feedback text-xs mt-0">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="nama_vendor">Nama Vendor<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control @error('nama_vendor') is-invalid @enderror" value="{{old('nama_vendor')}}" id="nama_vendor" name="nama_vendor">
                                                @error('nama_vendor')
                                                <div class="invalid-feedback text-xs mt-0">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="email_vendor">Email Perusahaan</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control @error('email_vendor') is-invalid @enderror" value="{{old('email_vendor')}}" id="email_vendor" name="email_vendor">
                                                @error('email_vendor')
                                                <div class="invalid-feedback text-xs mt-0">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="website_vendor">Website Perusahaan</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control @error('website_vendor') is-invalid @enderror" value="{{old('website_vendor')}}" id="website_vendor" placeholder="http://www.example.com/" name="website_vendor">
                                                @error('website_vendor')
                                                <div class="invalid-feedback text-xs mt-0">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="bidang_usaha">Bidang Usaha<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <textarea id="bidang_usaha" class="form-control @error('bidang_usaha') is-invalid @enderror" name="bidang_usaha" rows="3" cols="50">{{old('bidang_usaha')}}</textarea>
                                                @error('bidang_usaha')
                                                <div class="invalid-feedback text-xs mt-0">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="merk">Merk/Brand</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control @error('merk') is-invalid @enderror" value="{{old('merk')}}" id="merk" name="merk">
                                                @error('merk')
                                                <div class="invalid-feedback text-xs mt-0">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="nama_pic">Nama PIC<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control @error('nama_pic') is-invalid @enderror" value="{{old('nama_pic')}}" id="nama_pic" name="nama_pic">
                                                @error('nama_pic')
                                                <div class="invalid-feedback text-xs mt-0">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="email_pic">Email PIC<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control @error('email_pic') is-invalid @enderror" value="{{old('email_pic')}}" id="email_pic" name="email_pic">
                                                @error('email_pic')
                                                <div class="invalid-feedback text-xs mt-0">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="no_hp_pic">No HP PIC<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control @error('no_hp_pic') is-invalid @enderror" value="{{old('no_hp_pic')}}" id="no_hp_pic" placeholder="081xxx" name="no_hp_pic">
                                                @error('no_hp_pic')
                                                <div class="invalid-feedback text-xs mt-0">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="company_profile">Company Profile<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <div class="custom-file">
                                                    <input type="file" name="company_profile" class="custom-file-input @error('company_profile') is-invalid @enderror" placeholder="Company Profile" value="{{old('company_profile')}}" id="company_profile">
                                                    @error('company_profile')
                                                    <div class="invalid-feedback text-xs mt-0">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <label class="custom-file-label" for="company_profile" style="font-size: 12px;">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="katalog">Katalog<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <div class="custom-file py-0">
                                                    <input type="file" name="katalog" class="custom-file-input @error('katalog') is-invalid @enderror" placeholder="Katalog" value="{{old('katalog')}}" id="katalog">
                                                    @error('katalog')
                                                    <div class="invalid-feedback text-xs mt-0">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <label class="custom-file-label" for="katalog" style="font-size: 12px;">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="surat_permohonan">Surat Permohonan<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <div class="custom-file">
                                                    <input type="file" name="surat_permohonan" class="custom-file-input @error('surat_permohonan') is-invalid @enderror" placeholder="Surat Permohonan" value="{{old('surat_permohonan')}}" id="surat_permohonan">
                                                    @error('surat_permohonan')
                                                    <div class="invalid-feedback text-xs mt-0">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <label class="custom-file-label" for="surat_permohonan" style="font-size: 12px;">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-xs" for="pengalaman_kerja">Pengalaman Kerja<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <div class="custom-file">
                                                    <input type="file" name="pengalaman_kerja" class="custom-file-input @error('pengalaman_kerja') is-invalid @enderror" placeholder="Pengalaman Kerja" value="{{old('pengalaman_kerja')}}" id="pengalaman_kerja">
                                                    @error('pengalaman_kerja')
                                                    <div class="invalid-feedback text-xs mt-0">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <label class="custom-file-label" for="pengalaman_kerja" style="font-size: 12px;">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-2">
                                  
                                </div>
                                <div class="row justify-content-center">
                                    @error('g-recaptcha-response')
                                    <span class="text-danger" role="alert" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <a href="{{route('login')}}" class="btn btn-warning btn-sm mr-2"><span style="font-size:smaller; font-weight:bolder">Batal</span></a>
                                    <button type="button" data-toggle="modal" data-target="#confirm-pengajuan" class="btn btn-success btn-sm"><span style="font-size:smaller; font-weight:bolder">Submit</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue pt-2 pb-3">
                <div class="row px-3">
                    <small class="ml-4 pt-1 ml-sm-5">Copyright &copy; 2022 <a href="{{route('home')}}">Pengadaan Jasa | PT Petrokimia Gresik</a>. All rights reserved.</small>
                </div>
            </div>
        </div>
    </div>
    <!-- PERSETUJUAN -->
    <div class="modal fade" id="confirm-pengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Syarat dan Ketentuan</h5>
                </div>
                <div class="modal-body" style="font-size: 12px;">
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc. </div>
                <div class="modal-footer justify-content-center py-2">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-size:smaller; font-weight:bolder">Tolak</span></button>
                    <a href="#" id="submit-pengajuan" class="btn btn-success btn-sm"><span style="font-size:smaller; font-weight:bolder">Setuju</span></a>
                </div>
            </div>
        </div>
    </div>

    @if($errors->has('tipe_perusahaan') || $errors->has('nama_vendor') || $errors->has('bidang_usaha') || $errors->has('nama_pic') || $errors->has('email_pic') || $errors->has('no_hp_pic') || $errors->has('company_profile') || $errors->has('katalog') || $errors->has('surat_permohonan') || $errors->has('pengalaman_kerja'))
    <script type="text/javascript">
        $('.kembali a:last').tab('show')
    </script>
    @endif


    <script>
        //Searchable Dropdown
        $(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                allowClear: true,
            })
        });
    </script>
    <script>
        $('#company_profile').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $('#catalog').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $('#surat_permohonan').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $('#pengalaman_kerja').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>

    <script>
        $('#submit-pengajuan').click(function() {
            $('#form-pengajuan').submit();
        });
    </script>
</body>

</html>