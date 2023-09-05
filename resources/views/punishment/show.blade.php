@extends('layouts.home')
@section('title', 'Daftar Punishment Rekanan')
@section('header', 'Daftar Punishment Rekanan')
@section('action7','active')
@section('action72','active')
@section('menuopen3','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('punishment.index')}}">Daftar Punishment Rekanan</a></li>
    <li class="breadcrumb-item active">Detail Punishment Rekanan</li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Detail Punishment Rekanan</h3>
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
                        <a class="nav-link active text-center" id="custom-content-below-home-tab" data-toggle="pill" href="#detail" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="font-weight: bolder;">DETAIL PUNISHMENT REKANAN</a>
                    </li>
                    <li class="nav-item" style="width: 33.3%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#edit" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">EDIT PUNISHMENT REKANAN</a>
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
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="rekanan_id">Nama Rekanan<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <select name="rekanan_id" class="form-control select2bs4" style="width: 100%; font-size: 14px;" disabled>
                                            <option value=''></option>
                                            @foreach($rekanan as $rekan)
                                            <option value='{{$rekan->id}}' {{ old('rekanan_id', $punishment->rekanan_id) == $rekan->id ? 'selected' : '' }}>{{$rekan->nama_rekanan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="kode_rekanan">Kode Rekanan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$punishment->rekanan->kode_rekanan}}" name="kode_rekanan" readonly>
                                        @error('kode_rekanan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="no_sap">No SAP</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$punishment->rekanan->no_sap}}" name="no_sap" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="jenis_hukuman">Jenis Hukuman<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$punishment->jenis_hukuman}}" name="jenis_hukuman" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="jenis_tangguhan">Jenis Tangguhan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$punishment->jenis_tangguhan}}" name="jenis_tangguhan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="catatan_hukuman">Catatan Hukuman<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <textarea id="catatan_hukuman" class="form-control" name="catatan_hukuman" rows="3" cols="50" style="font-size: 14px" readonly>{{old('catatan_hukuman') ?? $punishment->catatan_hukuman}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_mulai">Tanggal Mulai<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{old('tanggal_mulai') ?? $punishment->tanggal_mulai}}" name="tanggal_mulai" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_selesai">Tanggal Selesai<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{old('tanggal_selesai') ?? $punishment->tanggal_selesai}}" name="tanggal_selesai" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="status">Status<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$punishment->status}}" name="status" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="keterangan">Keterangan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$punishment->keterangan}}" name="keterangan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="last_updated_by">Last Updated By</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$punishment->last_updated_by}}" name="last_updated_by" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="created_at">Tanggal Dibuat</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$punishment->created_at}}" name="created_at" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="updated_at">Tanggal Diubah</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$punishment->updated_at}}" name="updated_at" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger float-right hapus" data-toggle="modal" data-id='{{$punishment->id}}' data-target="#hapus"><span style="font-weight:bolder"> Hapus</span></button>
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
                        <form id="form-update" action="{{route('punishment.update', ['punishment' => $punishment->id])}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="rekanan_id">Nama Rekanan<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <select id="rekanan_id" name="rekanan_id" class="form-control select2bs4 @error('rekanan_id') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                @foreach($rekanan as $rekan)
                                                <option value='{{$rekan->id}}' {{ old('rekanan_id', $punishment->rekanan_id) == $rekan->id ? 'selected' : '' }}>{{$rekan->nama_rekanan}}</option>
                                                @endforeach
                                            </select>
                                            @error('rekanan_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="jenis_hukuman">Jenis Hukuman<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <select id="jenis_hukuman" name="jenis_hukuman" class="form-control select2bs4 @error('jenis_hukuman') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Suspend' {{ old('jenis_hukuman', $punishment->jenis_hukuman) == 'Suspend' ? 'selected' : '' }}>Suspend</option>
                                                <option value='Blacklist' {{ old('jenis_hukuman', $punishment->jenis_hukuman) == 'Blacklist' ? 'selected' : '' }}>Blacklist</option>
                                            </select>
                                            @error('jenis_hukuman')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="jenis_tangguhan">Jenis Tangguhan</label>
                                        <div class="col-md-10">
                                            <select id="jenis_tangguhan" name="jenis_tangguhan" class="form-control select2bs4 @error('jenis_tangguhan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='PI Group' {{ old('jenis_tangguhan', $punishment->jenis_tangguhan) == 'PI Group' ? 'selected' : '' }}>PI Group</option>
                                                <option value='Lokal' {{ old('jenis_tangguhan', $punishment->jenis_tangguhan) == 'Lokal' ? 'selected' : '' }}>Lokal</option>
                                            </select>
                                            @error('jenis_tangguhan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="catatan_hukuman">Catatan Hukuman<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <textarea id="catatan_hukuman" class="form-control @error('catatan_hukuman') is-invalid @enderror" name="catatan_hukuman" rows="3" cols="50" style="font-size: 14px">{{old('catatan_hukuman') ?? $punishment->catatan_hukuman}}</textarea>
                                            @error('catatan_hukuman')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_mulai">Tanggal Mulai<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('tanggal_mulai') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_mulai') ?? $punishment->tanggal_mulai}}" data-target="#reservationdate" placeholder="Tanggal Mulai" name="tanggal_mulai">
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('tanggal_mulai')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_selesai">Tanggal Selesai<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('tanggal_selesai') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_selesai') ?? $punishment->tanggal_selesai}}" data-target="#reservationdate2" placeholder="Tanggal Selesai" name="tanggal_selesai">
                                                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('tanggal_selesai')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="status">Status<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <select id="status" name="status" class="form-control select2bs4 @error('status') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Punished' {{ old('status', $punishment->status) == 'Punished' ? 'selected' : '' }}>Punished</option>
                                                <option value='Open Punished' {{ old('status', $punishment->status) == 'Open Punished' ? 'selected' : '' }}>Open Punished</option>
                                            </select>
                                            @error('status')
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
                <form action="{{route('punishment.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_hapus" name="id">
                    Apakah Anda Yakin Ingin Menghapus Punishment Rekanan Berikut?
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