@extends('layouts.home')
@section('title', 'Pengguna Sistem')
@section('header', 'Pengguna Sistem')
@section('action6','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Pengguna Sistem</li>
</ol>
@endsection
@section('content')
<style>
    table tfoot th {
        background-color: #f1f1f1;
    }
</style>
<div class="row">
    @include('alert')
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight:bolder;">Pengguna Sistem</h3>
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
                <div class="row">
                    <div class="col-md-8 text-left">
                        <a href="#" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#add"><span style="font-weight:bolder"> Tambah Pengguna Sistem <span></a>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#log"><span style="font-weight:bolder"> Log History <span></a>
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder"> Clear Filters <span></a>
                    </div>
                </div>
                <div class="table-responsive" style="width: 100%;">
                    <table class="table table-hover user table-bordered table-sm table-hide-overflow" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="center" style="width: 5%;">No.</th>
                                <th class="center" style="width: 15%;">Nama Pengguna</th>
                                <th class="center" style="width: 15%;">Username</th>
                                <th class="center" style="width: 20%;">Bagian</th>
                                <th class="center" style="width: 10%;">Status</th>
                                <th class="center" style="width: 15%;">Aktivasi Akun</th>
                                <th class="center" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                @foreach($user->roles as $role)
                                <td>{{$role->name}}</td>
                                @endforeach
                                @if($user->status == 1)
                                <td align="center"><span class="badge badge-success">Aktif</span></td>
                                @else
                                <td align="center"><span class="badge badge-danger">Non Aktif</span></td>
                                @endif
                                <td>
                                    <div class="row justify-content-center">
                                        @foreach($user->roles as $role)
                                        @if($role->name == 'Admin')
                                        <a class="btn btn-dark btn-xs"><span style="font-size:smaller; font-weight:bolder"> No Action</span></a>
                                        @else
                                        @if($user->status == 0)
                                        <form action="{{route('user.approved', ['user' => $user->id])}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-primary"><span style="font-size:smaller; font-weight:bolder"> Aktifkan</span></button>
                                        </form>
                                        @elseif($user->status == 1)
                                        <button type="button" class="btn btn-xs btn-warning nonaktif" data-toggle="modal" data-id='{{$user->id}}' data-target="#aktivasi"><span style="font-size:smaller; font-weight:bolder"> Nonaktifkan</span></button>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="row justify-content-center">
                                        @foreach($user->roles as $role)
                                        @if($role->name == 'Admin')
                                        @else
                                        <button type="button" class="btn btn-xs btn-danger mr-1 hapus" data-toggle="modal" data-id='{{$user->id}}' data-target="#hapus"><span style="font-size:smaller; font-weight:bolder"> Hapus</span></button>
                                        @endif
                                        @endforeach
                                        <button type="button" class="btn btn-xs btn-info reset" data-toggle="modal" data-id='{{$user->id}}' data-target="#reset"><span style="font-size:smaller; font-weight:bolder"> Reset Password</span></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pengguna</th>
                                <th>Username</th>
                                <th>Bagian</th>
                                <th>Status</th>
                                <th>Aktivasi Akun</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah Pengguna Sistem</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body mt-2 py-2 px-0">
                <ul class="nav nav-tabs mb-3 mx-3" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item" style="width: 50%;">
                        <a class="nav-link active text-center" id="custom-content-below-home-tab" data-toggle="pill" href="#detail" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="font-weight: bolder;">TAMBAH PENGGUNA SISTEM</a>
                    </li>
                    <li class="nav-item" style="width: 50%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#edit" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">PANDUAN PENGISIAN PASSWORD</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                        <form action="{{route('user.store')}}" method="POST">
                            <div class="row mx-2">
                                <div class="col-12">
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="name">Nama Lengkap<span class="required">*</span></label>
                                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" autofocus placeholder="Nama Lengkap">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="username">Username<span class="required">*</span></label>
                                        <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}" placeholder="Username">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="role">Bagian<span class="required">*</span></label>
                                        <select id="role" name="role" class="form-control select2bs4 @error('role') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih Bagian --">
                                            <option value=''></option>
                                            <option value='Admin' @if(old('role')=='Admin' ) selected @endif>Admin</option>
                                            <option value='PPBJ' @if(old('role')=='PPBJ' ) selected @endif>PPBJ</option>
                                            <option value='Jasa Distribusi & Pemasaran' @if(old('role')=='Jasa Distribusi & Pemasaran' ) selected @endif>Jasa Distribusi & Pemasaran</option>
                                            <option value='Jasa Pabrik' @if(old('role')=='Jasa Pabrik' ) selected @endif>Jasa Pabrik</option>
                                            <option value='Jasa Non Pabrik' @if(old('role')=='Jasa Non Pabrik' ) selected @endif>Jasa Non Pabrik</option>
                                            <option value='Jasa Investasi EPC' @if(old('role')=='Jasa Investasi EPC' ) selected @endif>Jasa Investasi EPC</option>
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="password">Password<span class="required">*</span></label>
                                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{'User1234'}}" placeholder="Kata Sandi">
                                        <span style="font-size: smaller;">Default Password: <span style=" font-weight: lighter;">User1234</span></span>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                        <div class="col-12">
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
                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Simpan</span></button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- LOG -->
<div class="modal fade" id="log" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Log History</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="table-responsive" style="width: 100%;">
                    <table class="table table-hover user table-bordered table-sm table-hide-overflow" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="center" style="width: 5%;">Diproses Oleh</th>
                                <th class="center" style="width: 70%;">Keterangan Aktivitas</th>
                                <th class="center" style="width: 15%;">Tanggal</th>
                                <th class="center" style="width: 10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users_log as $log)
                            <tr>
                                <td>{{$log->user->name}}</td>
                                <td>{{$log->description}}</td>
                                <td align="center">{{\Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i:s')}}</td>
                                <td align="center">{{Carbon\Carbon::parse($log->created_at)->diffForHumans()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Diproses Oleh</th>
                                <th>Keterangan Aktivitas</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- NON AKTIF -->
<div class="modal fade" id="aktivasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ffc107; color: black;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Konfirmasi Aktivasi</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{route('user.unapproved')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    Apakah Anda Yakin Ingin Menonaktifkan Pengguna Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Nonaktifkan<span></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- HAPUS -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Konfirmasi Hapus</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{route('user.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_hapus" name="id">
                    Apakah Anda Yakin Ingin Menghapus Pengguna Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Hapus<span></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- RESET -->
<div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17a2b8; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Konfirmasi Reset Password</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{route('user.reset')}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" id="id_reset" name="id">
                    Apakah Anda Yakin Ingin Reset Password Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Reset<span></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).on('click', '.nonaktif', function() {
        let id = $(this).attr('data-id');
        $('#id').val(id);
    });
</script>

<script>
    $(document).on('click', '.hapus', function() {
        let id = $(this).attr('data-id');
        $('#id_hapus').val(id);
    });
</script>

<script>
    $(document).on('click', '.reset', function() {
        let id = $(this).attr('data-id');
        $('#id_reset').val(id);
    });
</script>

@if(count($errors) > 0)
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif
<script>
    $(document).ready(function() {
        $('.user tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="" />');
        });
        $('.user').DataTable({
            pageLength: 10,
            scrollCollapse: true,
            initComplete: function() {
                // Apply the search
                this.api().columns().every(function() {
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

        var table = $('.user').DataTable();
        table
            .search('')
            .columns().search('')
            .draw();
    }
</script>
@endpush