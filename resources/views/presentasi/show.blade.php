@extends('layouts.home')
@section('title', 'Presentasi Company Profile')
@section('header', 'Presentasi Company Profile')
@section('action7','active')
@section('action73','active')
@section('menuopen3','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('presentasi.index')}}">Presentasi Company Profile</a></li>
    <li class="breadcrumb-item active">Detail Pengajuan Presentasi</li>
</ol>
@endsection
@section('content')
<div class="row">
    @include('alert')
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Detail Pengajuan Presentasi</h3>
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
                <ul class="nav nav-tabs kembali mb-4" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item" style="width: 33.3%;">
                        <a class="nav-link active text-center" id="custom-content-below-home-tab" data-toggle="pill" href="#detail" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="font-weight: bolder;">DETAIL PENGAJUAN PRESENTASI</a>
                    </li>
                    <li class="nav-item" style="width: 33.3%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#acc" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">PERSETUJUAN</a>
                    </li>
                    <li class="nav-item" style="width: 33.3%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#log" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">LOG HISTORY</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tipe_perusahaan">Tipe perusahaan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->tipe_perusahaan}}" name="tipe_perusahaan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="nama_vendor">Nama Vendor<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->nama_vendor}}" name="nama_vendor" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="email_vendor">Email Perusahaan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->email_vendor}}" name="email_vendor" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="website_vendor">Website Perusahaan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->website_vendor}}" name="website_vendor" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="bidang Usaha">Bidang Usaha<span class=" required">*</span></label>
                                    <div class="col-md-10">
                                        <textarea id="bidang_usaha" class="form-control" name="bidang_usaha" rows="4" cols="50" style="font-size: 14px;" readonly>{{$presentasi->bidang_usaha}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="merk">Merk/Brand</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->merk}}" name="merk" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="company_profile">Company Profile<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$presentasi->company_profile}}" name="company_profile" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#cp">Lihat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="katalog">Katalog<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$presentasi->katalog}}" name="katalog" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#k">Lihat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="surat_permohonan">Surat Permohonan<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$presentasi->surat_permohonan}}" name="surat_permohonan" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#sp">Lihat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="pengalaman_kerja">Pengalaman Kerja<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$presentasi->pengalaman_kerja}}" name="pengalaman_kerja" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#pk">Lihat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="nama_pic">Nama PIC<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->nama_pic}}" name="nama_pic" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="email_pic">Email PIC<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->email_pic}}" name="email_pic" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="no_hp_pic">No HP PIC<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->no_hp_pic}}" name="no_hp_pic" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_diajukan">Tanggal Pengajuan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->tanggal_diajukan}}" name="tanggal_diajukan" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_disetujui">Tanggal Persetujuan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->tanggal_disetujui ?? ''}}" name="tanggal_disetujui" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="created_by">Disetujui Oleh</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$presentasi->created_by ?? ''}}" name="created_by" readonly>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger float-right hapus" data-toggle="modal" data-id='{{$presentasi->id}}' data-target="#hapus"><span style="font-weight:bolder">Hapus</span></button>
                                <a href="{{route('presentasi.edit', ['presentasi' => $presentasi->id])}}" class="btn btn-warning btn-sm float-right mr-1"><span style="font-weight:bolder">Edit</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="log" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                        <div class="table-responsive" style="width: 100%;">
                            <table class="table table-hover datatable table-bordered table-sm" style="width: 100%">
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
                    <div class="tab-pane fade" id="acc" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                        <div class="row">
                            <div class="col-12">
                                <form id="form-acc" action="{{route('presentasi.acc', ['presentasi' => $presentasi->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group row clearfix">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="status">Status<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="status" id="status1" value="Terima" {{ old('status', $presentasi->status) == 'Terima' ? 'checked' : '' }}>
                                                <label for="status1">
                                                    Terima
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline ml-3">
                                                <input type="radio" name="status" id="status2" value="Tolak" {{ old('status', $presentasi->status) == 'Tolak' ? 'checked' : '' }}>
                                                <label for="status2">
                                                    Tolak
                                                </label>
                                            </div>
                                            @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control form-control-sm datetimepicker-input @error('tanggal_pelaksanaan') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_pelaksanaan') ?? $presentasi->tanggal_pelaksanaan}}" data-target="#reservationdate" placeholder="Tanggal Pelaksanaan" name="tanggal_pelaksanaan">
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('tanggal_pelaksanaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tempat">Tempat</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control form-control-sm @error('tempat') is-invalid @enderror" value="{{old('tempat') ?? $presentasi->tempat}}" id="tempat" placeholder="Tempat" name="tempat">
                                            @error('tempat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="waktu_pelaksanaan">Waktu Pelaksanaan</label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('waktu_pelaksanaan') is-invalid @enderror" id="waktu_pelaksanaan" placeholder="Waktu Pelaksanaan" name="waktu_pelaksanaan" value="{{old('waktu_pelaksanaan') ?? $presentasi->waktu_pelaksanaan}}" data-target="#timepicker" />
                                                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                            @error('waktu_pelaksanaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="user">User</label>
                                        <div class="col-md-10">
                                            <select id="user" name="user" class="form-control form-control-sm select2bs4 @error('user') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                @foreach($unit as $un)
                                                <option value='{{$un->unit}}' {{ old('user', $presentasi->user) == $un->unit ? 'selected' : '' }}>{{$un->unit}}</option>
                                                @endforeach
                                            </select>
                                            @error('user')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="keterangan">Keterangan<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <textarea id="keterangan" class="form-control form-control-sm @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" cols="50" placeholder="Keterangan">{{ old('keterangan') ?? $presentasi->keterangan}}</textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#confirm-acc" class="btn btn-success btn-sm float-right"><span style="font-weight:bolder">Submit</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Company Profile -->
<div class="modal fade" id="cp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Company Profile</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body py-2" style="background-color: #f4f6f9;">
                <iframe src="/file_upload/{{$presentasi->company_profile}}" frameborder=0 width="100%" height="500px">
                </iframe>
            </div>
        </div>
    </div>
</div>
<!-- Katalog -->
<div class="modal fade" id="k" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Katalog</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body py-2" style="background-color: #f4f6f9;">
                <iframe src="/file_upload/{{$presentasi->katalog}}" frameborder=0 width="100%" height="500px">
                </iframe>
            </div>
        </div>
    </div>
</div>
<!-- Surat Permohonan -->
<div class="modal fade" id="sp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Surat Permohonan</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body py-2" style="background-color: #f4f6f9;">
                <iframe src="/file_upload/{{$presentasi->surat_permohonan}}" frameborder=0 width="100%" height="500px">
                </iframe>
            </div>
        </div>
    </div>
</div>
<!-- Pengalaman Kerja -->
<div class="modal fade" id="pk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Pengalaman Kerja</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body py-2" style="background-color: #f4f6f9;">
                <iframe src="/file_upload/{{$presentasi->pengalaman_kerja}}" frameborder=0 width="100%" height="500px">
                </iframe>
            </div>
        </div>
    </div>
</div>
<!-- ACC -->
<div class="modal fade" id="confirm-acc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #28a745; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Konfirmasi Persetujuan</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Melakukan Persetujuan Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <a href="#" id="submit-acc" class="btn btn-success btn-sm"><span style="font-weight:bolder">Submit</span></a>
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
                <form action="{{route('presentasi.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_hapus" name="id">
                    Apakah Anda Yakin Ingin Menghapus Pengajuan Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Hapus<span></button>
                </form>
            </div>
        </div>
    </div>
</div>v
@endsection

@push('scripts')
@if(count($errors) > 0)
<script type="text/javascript">
    $('.kembali li:eq(1) a').tab('show')
</script>
@endif
<script>
    $('.custom-file-input').on('change', function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
<script>
    $(document).on('click', '.hapus', function() {
        let id = $(this).attr('data-id');
        $('#id_hapus').val(id);
    });
</script>

<script>
    $('#submit-acc').click(function() {
        $('#form-acc').submit();
    });
</script>
@endpush