@extends('layouts.home')
@section('title', 'Daftar Pelayanan Rekanan')
@section('header', 'Daftar Pelayanan Rekanan')
@section('action7','active')
@section('action75','active')
@section('menuopen3','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('keluhan.index')}}">Daftar Pelayanan Rekanan</a></li>
    <li class="breadcrumb-item active">Detail Pelayanan Rekanan</li>
</ol>
@endsection
@section('content')
<style>
    input:disabled {
        background-color: red;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Detail Pelayanan Rekanan</h3>
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
                        <a class="nav-link active text-center" id="custom-content-below-home-tab" data-toggle="pill" href="#detail" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="font-weight: bolder;">DETAIL PELAYANAN REKANAN</a>
                    </li>
                    <li class="nav-item" style="width: 33.3%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#edit" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">EDIT PELAYANAN REKANAN</a>
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
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_pelaporan">Tanggal Pelaporan<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{$keluhan->tanggal_pelaporan}}" name="tanggal_pelaporan" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="nama_rekanan">Nama Rekanan<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$keluhan->nama_rekanan}}" name="nama_rekanan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="deskripsi">Deskripsi<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <textarea id="deskripsi" class="form-control" name="deskripsi" rows="3" cols="50" style="font-size: 14px" readonly>{{$keluhan->deskripsi}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="media_penyampaian_keluhan">Media Penyampaian Keluhan<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$keluhan->media_penyampaian_keluhan}}" name="media_penyampaian_keluhan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="evidence">Evidence<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$keluhan->evidence}}" name="evidence" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_close">Tanggal Close</label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{$keluhan->tanggal_close}}" name="tanggal_close" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="keterangan">Keterangan</label>
                                    <div class="col-md-10">
                                        <textarea id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" cols="50" style="font-size: 14px" readonly>{{$keluhan->keterangan}}</textarea>
                                        @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="kategori">Kategori</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$keluhan->kategori}}" name="kategori" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="pelayanan_keluhan">Pelayanan/Keluhan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$keluhan->pelayanan_keluhan}}" name="pelayanan_keluhan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="last_updated_by">Last Updated By</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$keluhan->last_updated_by}}" name="last_updated_by" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="created_at">Tanggal Dibuat</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$keluhan->created_at}}" name="created_at" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="updated_at">Tanggal Diubah</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$keluhan->updated_at}}" name="updated_at" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger float-right hapus" data-toggle="modal" data-id='{{$keluhan->id}}' data-target="#hapus"><span style="font-weight:bolder"> Hapus</span></button>
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
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                        <form id="form-update" action="{{route('keluhan.update', ['keluhan' => $keluhan->id])}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_pelaporan">Tanggal Pelaporan<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('tanggal_pelaporan') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_pelaporan') ?? $keluhan->tanggal_pelaporan}}" data-target="#reservationdate" placeholder="Tanggal Pelaporan" name="tanggal_pelaporan">
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('tanggal_pelaporan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="nama_rekanan">Nama Rekanan<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <select id="nama_rekanan" name="nama_rekanan" class="form-control select2bs4 @error('nama_rekanan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                @foreach($rekanan as $rekan)
                                                <option value='{{$rekan->nama_rekanan}}' {{ old('nama_rekanan', $keluhan->nama_rekanan) == $rekan->nama_rekanan ? 'selected' : '' }}>{{$rekan->nama_rekanan}}</option>
                                                @endforeach
                                            </select>
                                            @error('nama_rekanan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="deskripsi">Deskripsi<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" cols="50" style="font-size: 14px" placeholder="Deskripsi">{{old('deskripsi') ?? $keluhan->deskripsi}}</textarea>
                                            @error('deskripsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="media_penyampaian_keluhan">Media Penyampaian Keluhan<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <select id="media_penyampaian_keluhan" name="media_penyampaian_keluhan" class="form-control select2bs4 @error('media_penyampaian_keluhan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Email' {{ old('media_penyampaian_keluhan', $keluhan->media_penyampaian_keluhan) == 'Email' ? 'selected' : '' }}>Email</option>
                                                <option value='Telepon' {{ old('media_penyampaian_keluhan', $keluhan->media_penyampaian_keluhan) == 'Telepon' ? 'selected' : '' }}>Telepon</option>
                                                <option value='WhatsApp' {{ old('media_penyampaian_keluhan', $keluhan->media_penyampaian_keluhan) == 'WhatsApp' ? 'selected' : '' }}>WhatsApp</option>
                                                <option value='Langsung' {{ old('media_penyampaian_keluhan', $keluhan->media_penyampaian_keluhan) == 'Langsung' ? 'selected' : '' }}>Langsung</option>
                                            </select>
                                            @error('media_penyampaian_keluhan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="evidence">Evidence<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <select id="evidence" name="evidence" class="form-control select2bs4 @error('evidence') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Ada' {{ old('evidence', $keluhan->evidence) == 'Ada' ? 'selected' : '' }}>Ada</option>
                                                <option value='Tidak' {{ old('evidence', $keluhan->evidence) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('evidence')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_close">Tanggal Close</label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('tanggal_close') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_close') ?? $keluhan->tanggal_close}}" data-target="#reservationdate2" placeholder="Tanggal Close" name="tanggal_close">
                                                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('tanggal_close')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="keterangan">Keterangan</label>
                                        <div class="col-md-10">
                                            <textarea id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" cols="50" style="font-size: 14px" placeholder="Keterangan">{{old('keterangan') ?? $keluhan->keterangan}}</textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="kategori">Kategori</label>
                                        <div class="col-md-10">
                                            <select id="kategori" name="kategori" class="form-control select2bs4 @error('kategori') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Eproc Error' {{ old('kategori', $keluhan->kategori) == 'Eproc Error' ? 'selected' : '' }}>Eproc Error</option>
                                                <option value='Extend Rekanan' {{ old('kategori', $keluhan->kategori) == 'Extend Rekanan' ? 'selected' : '' }}>Extend Rekanan</option>
                                                <option value='Migrasi Data' {{ old('kategori', $keluhan->kategori) == 'Migrasi Data' ? 'selected' : '' }}>Migrasi Data</option>
                                                <option value='Pendaftaran Rekanan' {{ old('kategori', $keluhan->kategori) == 'Pendaftaran Rekanan' ? 'selected' : '' }}>Pendaftaran Rekanan</option>
                                                <option value='PO Outstanding' {{ old('kategori', $keluhan->kategori) == 'PO Outstanding' ? 'selected' : '' }}>PO Outstanding</option>
                                                <option value='Proses Tender' {{ old('kategori', $keluhan->kategori) == 'Proses Tender' ? 'selected' : '' }}>Proses Tender</option>
                                                <option value='Reset Password' {{ old('kategori', $keluhan->kategori) == 'Reset Password' ? 'selected' : '' }}>Reset Password</option>
                                                <option value='Trial' {{ old('kategori', $keluhan->kategori) == 'Trial' ? 'selected' : '' }}>Trial</option>
                                                <option value='Update Data Rekanan' {{ old('kategori', $keluhan->kategori) == 'Update Data Rekanan' ? 'selected' : '' }}>Update Data Rekanan</option>
                                            </select>
                                            @error('kategori')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="pelayanan_keluhan">Pelayanan/Keluhan</label>
                                        <div class="col-md-10">
                                            <select id="pelayanan_keluhan" name="pelayanan_keluhan" class="form-control select2bs4 @error('pelayanan_keluhan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Pelayanan' {{ old('pelayanan_keluhan', $keluhan->pelayanan_keluhan) == 'Pelayanan' ? 'selected' : '' }}>Pelayanan</option>
                                                <option value='Keluhan' {{ old('pelayanan_keluhan', $keluhan->pelayanan_keluhan) == 'Keluhan' ? 'selected' : '' }}>Keluhan</option>
                                            </select>
                                            @error('pelayanan_keluhan')
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
                <form action="{{route('keluhan.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_hapus" name="id">
                    Apakah Anda Yakin Ingin Menghapus Pelayanan Rekanan Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Hapus<span></button>
                </form>
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
@if(count($errors) > 0)
<script type="text/javascript">
    $('.kembali li:eq(1) a').tab('show')
</script>
@endif

<script>
    $(document).on('click', '.hapus', function() {
        let id = $(this).attr('data-id');
        $('#id_hapus').val(id);
    });
</script>

<script>
    $('#submit-update').click(function() {
        $('#form-update').submit();
    });
</script>
@endpush