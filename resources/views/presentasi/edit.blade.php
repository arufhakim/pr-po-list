@extends('layouts.home')
@section('title', 'Presentasi Company Profile')
@section('header', 'Presentasi Company Profile')
@section('action9','active')
@section('action91','active')
@section('menuopen4','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Presentasi Company Profile</li>
    <li class="breadcrumb-item"><a href="{{route('presentasi.show', ['presentasi' => $presentasi->id])}}">Detail Pengajuan Presentasi</a></li>
    <li class="breadcrumb-item active">Edit Berkas</li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Edit Berkas</h3>
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
                <form id="form-update" action="{{route('presentasi.update', ['presentasi' => $presentasi->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="tipe_perusahaan">Tipe perusahaan<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{$presentasi->tipe_perusahaan}}" name="nama_vendor" readonly>
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
                                <label class="col-md-2 col-form-label col-form-label-sm" for="bidang_usaha">Bidang Usaha<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="bidang_usaha" rows="3" cols="50" style="font-size: 14px;" readonly>{{$presentasi->bidang_usaha}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="merk">Merk/Brand</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{$presentasi->merk}}" readonly name="merk">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="nama_pic">Nama PIC<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{$presentasi->nama_pic}}" readonly name="nama_pic">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="email_pic">Email PIC<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{$presentasi->email_pic}}" readonly name="email_pic">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="no_hp_pic">No HP PIC<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{$presentasi->no_hp_pic}}" readonly name="no_hp_pic">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="company_profile">Company Profile<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <div class="custom-file">
                                        <input type="file" name="company_profile" class="custom-file-input @error('company_profile') is-invalid @enderror" placeholder="Company Profile" value="{{old('company_profile')}}" id="company_profile">
                                        <label class="custom-file-label" for="company_profile">Choose file</label>
                                    </div>
                                    <small class="text-muted" data-toggle="modal" data-target="#cp">Recent File: {{$presentasi->company_profile}}</small>
                                    @error('company_profile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="katalog">Katalog<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <div class="custom-file">
                                        <input type="file" name="katalog" class="custom-file-input @error('katalog') is-invalid @enderror" placeholder="Katalog" value="{{old('katalog')}}" id="katalog">
                                        <label class="custom-file-label" for="katalog">Choose file</label>
                                    </div>
                                    <small class="text-muted" data-toggle="modal" data-target="#k">Recent File: {{$presentasi->katalog}}</small>
                                    @error('katalog')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="surat_permohonan">Surat Permohonan<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <div class="custom-file">
                                        <input type="file" name="surat_permohonan" class="custom-file-input @error('surat_permohonan') is-invalid @enderror" placeholder="Surat Permohonan" value="{{old('surat_permohonan')}}" id="surat_permohonan">
                                        <label class="custom-file-label" for="surat_permohonan">Choose file</label>
                                    </div>
                                    <small class="text-muted" data-toggle="modal" data-target="#sp">Recent File: {{$presentasi->surat_permohonan}}</small>
                                    @error('surat_permohonan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="pengalaman_kerja">Pengalaman Kerja<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <div class="custom-file">
                                        <input type="file" name="pengalaman_kerja" class="custom-file-input @error('pengalaman_kerja') is-invalid @enderror" placeholder="Pengalaman Kerja" value="{{old('pengalaman_kerja')}}" id="pengalaman_kerja">
                                        <label class="custom-file-label" for="pengalaman_kerja">Choose file</label>
                                    </div>
                                    <small class="text-muted" data-toggle="modal" data-target="#pk">Recent File: {{$presentasi->pengalaman_kerja}}</small>
                                    @error('pengalaman_kerja')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#confirm-update" class="btn btn-success btn-sm float-right"><span style="font-weight:bolder">Simpan</span></button>
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
<!-- EDIT -->
<div class="modal fade" id="confirm-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ffc107; color: black;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Konfirmasi Update</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Mengubah Data Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <a href="#" id="submit-update" class="btn btn-success btn-sm"><span style="font-weight:bolder">Submit</span></a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('.custom-file-input').on('change', function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
<script>
    $('#submit-update').click(function() {
        $('#form-update').submit();
    });
</script>
@endpush