@extends('layouts.home')
@section('title', 'Daftar Purchase Request (PR)')
@section('header', 'Daftar Purchase Request (PR)')
@section('menuopen5','menu-open')
@section('action21','active')
@section('action2','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('pr.index')}}">Daftar Purchase Request (PR)</a></li>
    <li class="breadcrumb-item"><a href="{{route('pr.show', ['pr' => $purchase_request->id])}}">Detail PR & PO</a></li>
    <li class="breadcrumb-item active">Edit Purchase Request (PR)</li>
</ol>
@endsection
@section('content')
<div class="row">
    @include('alert')
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Edit Purchase Request (PR)</h3>
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
                <form action="{{route('pr.update', ['pr' => $purchase_request->id])}}" method="POST">
                    @method ('patch')
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_sr">Tanggal SR<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datetimepicker-input @error('tanggal_sr') is-invalid @enderror" value="{{old('tanggal_sr') ?? $purchase_request->tanggal_sr }}" data-target="#reservationdate" placeholder="Tanggal SR" name="tanggal_sr">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('tanggal_sr')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_sr_verif">Tanggal SR Verifikasi</label>
                                <div class="col-md-10">
                                    <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datetimepicker-input @error('tanggal_sr_verif') is-invalid @enderror" value="{{old('tanggal_sr_verif') ?? $purchase_request->tanggal_sr_verif}}" data-target="#reservationdate3" placeholder="Tanggal SR Verifikasi" name="tanggal_sr_verif">
                                        <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('tanggal_sr_verif')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="tim">Tim</label>
                                <div class="col-md-10">
                                    <select id="tim" name="tim" class="form-control form-control-sm select2bs4 @error('tim') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=''></option>
                                        <option value='Non Pabrik' {{ old('tim', $purchase_request->tim) == 'Non Pabrik' ? 'selected' : '' }}>Non Pabrik</option>
                                        <option value='Pabrik' {{ old('tim', $purchase_request->tim) == 'Pabrik' ? 'selected' : '' }}>Pabrik</option>
                                        <option value='Umum' {{ old('tim', $purchase_request->tim) == 'Umum' ? 'selected' : '' }}>Umum</option>
                                    </select>
                                    @error('tim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="unit">User <a href="" data-toggle="modal" data-target="#exampleModal4"><i class="fas fa-plus fa-xs"></i></a></label>
                                <div class="col-md-10">
                                    <select id="unit" name="unit" class="form-control form-control-sm select2bs4 @error('unit') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=''></option>
                                        @foreach($unit as $un)
                                        <option value='{{$un->unit}}' {{ old('unit', $purchase_request->unit) == $un->unit ? 'selected' : '' }}>{{$un->unit}}</option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="nomor_sr">Nomor SR<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('nomor_sr') is-invalid @enderror" value="{{old('nomor_sr') ?? $purchase_request->nomor_sr}}" id="nomor_sr" placeholder="Nomor SR" name="nomor_sr">
                                    @error('nomor_sr')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="gl_account">GL Account</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('gl_account') is-invalid @enderror" value="{{old('gl_account') ?? $purchase_request->gl_account}}" id="gl_account" placeholder="GL Account" name="gl_account">
                                    @error('gl_account')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="cost_center">Cost Center</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('cost_center') is-invalid @enderror" value="{{old('cost_center') ?? $purchase_request->cost_center}}" id="cost_center" placeholder="Cost Center" name="cost_center">
                                    @error('cost_center')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="uraian_pekerjaan">Uraian Pekerjaan<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('uraian_pekerjaan') is-invalid @enderror" value="{{old('uraian_pekerjaan') ?? $purchase_request->uraian_pekerjaan}}" id="uraian_pekerjaan" placeholder="Uraian Pekerjaan" name="uraian_pekerjaan">
                                    @error('uraian_pekerjaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="pipg">PI/PG</label>
                                <div class="col-md-10">
                                    <select id="pipg" name="pipg" class="form-control form-control-sm select2bs4 @error('pipg') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=''></option>
                                        <option value='PI' {{ old('pipg', $purchase_request->pipg) == 'PI' ? 'selected' : '' }}>PI</option>
                                        <option value='PG' {{ old('pipg', $purchase_request->pipg) == 'PG' ? 'selected' : '' }}>PG</option>
                                    </select>
                                    @error('pipg')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="prioritas">Prioritas</label>
                                <div class="col-md-10">
                                    <select id="prioritas" name="prioritas" class="form-control form-control-sm select2bs4 @error('prioritas') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=''></option>
                                        <option value='Normal - Backdate' {{ old('prioritas', $purchase_request->prioritas) == 'Normal - Backdate' ? 'selected' : '' }}>Normal - Backdate</option>
                                        <option value='Normal - On Time' {{ old('prioritas', $purchase_request->prioritas) == 'Normal - On Time' ? 'selected' : '' }}>Normal - On Time</option>
                                        <option value='Investasi' {{ old('prioritas', $purchase_request->prioritas) == 'Investasi' ? 'selected' : '' }}>Investasi</option>
                                        <option value='Emergency' {{ old('prioritas', $purchase_request->prioritas) == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                                        <option value='Urgent' {{ old('prioritas', $purchase_request->prioritas) == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                        <option value='TA' {{ old('prioritas', $purchase_request->prioritas) == 'TA' ? 'selected' : '' }}>TA</option>
                                    </select>
                                    @error('prioritas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="nomor_pr">Nomor PR</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('nomor_pr') is-invalid @enderror" value="{{old('nomor_pr') ?? $purchase_request->nomor_pr}}" id="nomor_pr" placeholder="Nomor PR" name="nomor_pr">
                                    @error('nomor_pr')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="line_pr">Line PR</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('line_pr') is-invalid @enderror" value="{{old('line_pr') ?? $purchase_request->line_pr}}" id="line_pr" placeholder="Line PR" name="line_pr">
                                    @error('line_pr')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="oe_pr">OE PR</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('oe_pr') is-invalid @enderror" value="{{old('oe_pr') ?? $purchase_request->oe_pr}}" id="oe_pr" placeholder="OE PR" name="oe_pr">
                                    @error('oe_pr')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="kontrak">Kontrak</label>
                                <div class="col-md-10">
                                    <select id="kontrak" name="kontrak" class="form-control form-control-sm select2bs4 @error('kontrak') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=''></option>
                                        <option value='Non Kontrak (Induk)' {{ old('kontrak', $purchase_request->kontrak) == 'Non Kontrak (Induk)' ? 'selected' : '' }}>Non Kontrak (Induk)</option>
                                        <option value='Non Kontrak (Spot)' {{ old('kontrak', $purchase_request->kontrak) == 'Non Kontrak (Spot)' ? 'selected' : '' }}>Non Kontrak (Spot)</option>
                                        <option value='Kontrak' {{ old('kontrak', $purchase_request->kontrak) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                        <option value='SPMK' {{ old('kontrak', $purchase_request->kontrak) == 'SPMK' ? 'selected' : '' }}>SPMK</option>
                                    </select>
                                    @error('kontrak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="status">Status <a href="" data-toggle="modal" data-target="#exampleModal2"><i class="fas fa-plus fa-xs"></i></a></label>
                                <div class="col-md-10">
                                    <select id="status" name="status" class="form-control form-control-sm select2bs4 @error('status') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=''></option>
                                        @foreach($status as $stat)
                                        <option value='{{$stat->status}}' {{ old('status', $purchase_request->status) == $stat->status ? 'selected' : '' }}>{{$stat->status}}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_deliv">Tanggal Delivered</label>
                                <div class="col-md-10">
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datetimepicker-input @error('tanggal_deliv') is-invalid @enderror" value="{{old('tanggal_deliv') ?? $purchase_request->tanggal_deliv}}" data-target="#reservationdate2" placeholder="Tanggal Delivered" name="tanggal_deliv">
                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('tanggal_deliv')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" style="width: 100%;" onclick="return confirm('Update PR?');"><span style="font-weight:bolder">Simpan</span></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Unit -->
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah User</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('unit.store2')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="unit">User<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('unit') is-invalid @enderror" value="{{old('unit')}}" placeholder="User" name="unit">
                        @error('unit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                    <button type="submit" class="btn btn-primary btn-sm"><span style="font-weight:bolder">Simpan</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Status -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah Item Status</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('status.store2')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="status">Status<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('status') is-invalid @enderror" value="{{old('status')}}" placeholder="Status" name="status">
                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                    <button type="submit" class="btn btn-primary btn-sm"><span style="font-weight:bolder">Simpan</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection