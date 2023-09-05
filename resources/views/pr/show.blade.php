@extends('layouts.home')
@section('title', 'Purchase Requisition')
@section('header', 'Purchase Requisition')
@section('menuopen5','menu-open')
@section('action21','active')
@section('action2','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('pr.index')}}">Purchase Requisition</a></li>
    <li class="breadcrumb-item active">Detail Purchase Requisition</li>
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
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Detail Purchase Requisition</h3>
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
                    <li class="nav-item" style="width: 25%;">
                        <a class="nav-link active text-center" id="custom-content-below-home-tab" data-toggle="pill" href="#pr" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="font-weight: bolder;">PURCHASE REQUISITION</a>
                    </li>
                    <li class="nav-item" style="width: 25%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#po" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">PROSES TENDER</a>
                    </li>
                    <li class="nav-item" style="width: 25%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#edit" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">EDIT PURCHASE REQUISITION</a>
                    </li>
                    <li class="nav-item" style="width: 25%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#log" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">LOG HISTORY</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="pr" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_sr">Tanggal SR<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{$purchase_requisition->tanggal_sr}}" name="tanggal_sr" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_sr_verif">Tanggal SR Verifikasi</label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{$purchase_requisition->tanggal_sr_verif}}" name="tanggal_sr_verif" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tim">Tim</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->tim}}" name="tim" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="unit">User</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->unit}}" name="unit" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="nomor_sr">Nomor SR<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->nomor_sr}}" name="nomor_sr" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="gl_account">GL Account</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->gl_account}}" name="gl_account" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="cost_center">Cost Center</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->cost_center}}" name="cost_center" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="uraian_pekerjaan">Uraian Pekerjaan<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <textarea id="uraian_pekerjaan" class="form-control" name="uraian_pekerjaan" rows="3" cols="50" style="font-size: 14px" readonly>{{$purchase_requisition->uraian_pekerjaan}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="pipg">PI/PG</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->pipg}}" name="pipg" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="prioritas">Prioritas</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->prioritas}}" name="prioritas" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="nomor_pr">Nomor PR</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->nomor_pr}}" name="nomor_pr" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="line_pr">Line PR</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->line_pr}}" name="line_pr" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="oe_pr">OE PR</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="@currency($purchase_requisition->oe_pr)" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="kontrak">Kontrak</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->kontrak}}" name="kontrak" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="status">Status</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->status}}" name="status" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_deliv">Tanggal Delivered</label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{$purchase_requisition->tanggal_deliv}}" name="tanggal_deliv" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="last_update_by">Last Updated By</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->last_update_by}}" name="last_update_by" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="created_at">Tanggal Dibuat</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->created_at}}" name="created_at" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="updated_at">Tanggal Diubah</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->updated_at}}" name="updated_at" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger float-right hapus" data-toggle="modal" data-id='{{$purchase_requisition->id}}' data-target="#hapus"><span style="font-weight:bolder"> Hapus</span></button>
                    </div>
                    <div class="tab-pane fade" id="po" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_terima_pr">Tanggal Terima PR<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{$purchase_requisition->po->tanggal_terima_pr}}" name="tanggal_terima_pr" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="eprocsap">EPROC/SAP</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->eprocsap}}" name="eprocsap" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="progress">Progress</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->progress}}" name="progress" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="no_po_sp">No. PO/Agreement/SP</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->no_po_sp}}" name="no_po_sp" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="nilai_po">Nilai PO</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="@currency($purchase_requisition->po->nilai_po)" name="nilai_po" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_po">Tanggal PO</label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{$purchase_requisition->po->tanggal_po}}" name="tanggal_po" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="vendor">Vendor</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->vendor}}" name="vendor" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="due_date_po">Due Date PO</label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{$purchase_requisition->po->due_date_po}}" name="due_date_po" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="sinergi">Sinergi</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->sinergi}}" name="sinergi" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="padi">Pembelian Melalui PaDi UMKM</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->padi}}" name="padi" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="invoicing">Invoicing PaDi</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="@currency($purchase_requisition->po->invoicing)" name="invoicing" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="delivered">Delivered</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->delivered}}" name="delivered" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="stb_delivered">Still To Be Delivered</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->stb_delivered}}" name="stb_delivered" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="invoiced">Invoiced</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->invoiced}}" name="invoiced" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="keterangan">Keterangan</label>
                                    <div class="col-md-10">
                                        <textarea id="keterangan" class="form-control" name="keterangan" rows="3" cols="50" style="font-size: 14px" readonly>{{$purchase_requisition->po->keterangan}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="last_update_by">Last Updated By</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->last_update_by}}" name="last_update_by" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="created_at">Tanggal Dibuat</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->created_at}}" name="created_at" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="updated_at">Tanggal Diubah</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$purchase_requisition->po->updated_at}}" name="updated_at" readonly>
                                    </div>
                                </div>
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
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                        <form id="form-update" action="{{route('pr.update', ['pr' => $purchase_requisition->id])}}" method="POST">
                            @method ('patch')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_sr">Tanggal SR<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('tanggal_sr') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_sr') ?? $purchase_requisition->tanggal_sr }}" data-target="#reservationdate" placeholder="Tanggal SR" name="tanggal_sr">
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
                                                <input type="text" class="form-control datetimepicker-input @error('tanggal_sr_verif') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_sr_verif') ?? $purchase_requisition->tanggal_sr_verif}}" data-target="#reservationdate3" placeholder="Tanggal SR Verifikasi" name="tanggal_sr_verif">
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
                                            <select id="tim" name="tim" class="form-control select2bs4 @error('tim') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Non Pabrik' {{ old('tim', $purchase_requisition->tim) == 'Non Pabrik' ? 'selected' : '' }}>Non Pabrik</option>
                                                <option value='Pabrik' {{ old('tim', $purchase_requisition->tim) == 'Pabrik' ? 'selected' : '' }}>Pabrik</option>
                                                <option value='Umum' {{ old('tim', $purchase_requisition->tim) == 'Umum' ? 'selected' : '' }}>Umum</option>
                                            </select>
                                            @error('tim')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="unit">User</label>
                                        <div class="col-md-10">
                                            <select id="unit" name="unit" class="form-control select2bs4 @error('unit') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                @foreach($unit as $un)
                                                <option value='{{$un->unit}}' {{ old('unit', $purchase_requisition->unit) == $un->unit ? 'selected' : '' }}>{{$un->unit}}</option>
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
                                            <input type="text" class="form-control @error('nomor_sr') is-invalid @enderror" value="{{old('nomor_sr') ?? $purchase_requisition->nomor_sr}}" id="nomor_sr" placeholder="Nomor SR" name="nomor_sr">
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
                                            <input type="text" class="form-control @error('gl_account') is-invalid @enderror" value="{{old('gl_account') ?? $purchase_requisition->gl_account}}" id="gl_account" placeholder="GL Account" name="gl_account">
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
                                            <input type="text" class="form-control @error('cost_center') is-invalid @enderror" value="{{old('cost_center') ?? $purchase_requisition->cost_center}}" id="cost_center" placeholder="Cost Center" name="cost_center">
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
                                            <textarea id="uraian_pekerjaan" class="form-control @error('uraian_pekerjaan') is-invalid @enderror" name="uraian_pekerjaan" rows="3" cols="50" style="font-size: 14px" placeholder="Uraian Pekerjaan">{{old('uraian_pekerjaan') ?? $purchase_requisition->uraian_pekerjaan}}</textarea>
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
                                            <select id="pipg" name="pipg" class="form-control select2bs4 @error('pipg') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='PI' {{ old('pipg', $purchase_requisition->pipg) == 'PI' ? 'selected' : '' }}>PI</option>
                                                <option value='PG' {{ old('pipg', $purchase_requisition->pipg) == 'PG' ? 'selected' : '' }}>PG</option>
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
                                            <select id="prioritas" name="prioritas" class="form-control select2bs4 @error('prioritas') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Normal - Backdate' {{ old('prioritas', $purchase_requisition->prioritas) == 'Normal - Backdate' ? 'selected' : '' }}>Normal - Backdate</option>
                                                <option value='Normal - On Time' {{ old('prioritas', $purchase_requisition->prioritas) == 'Normal - On Time' ? 'selected' : '' }}>Normal - On Time</option>
                                                <option value='Investasi' {{ old('prioritas', $purchase_requisition->prioritas) == 'Investasi' ? 'selected' : '' }}>Investasi</option>
                                                <option value='Emergency' {{ old('prioritas', $purchase_requisition->prioritas) == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                                                <option value='Urgent' {{ old('prioritas', $purchase_requisition->prioritas) == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                                <option value='TA' {{ old('prioritas', $purchase_requisition->prioritas) == 'TA' ? 'selected' : '' }}>TA</option>
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
                                            <input type="text" class="form-control @error('nomor_pr') is-invalid @enderror" value="{{old('nomor_pr') ?? $purchase_requisition->nomor_pr}}" id="nomor_pr" placeholder="Nomor PR" name="nomor_pr">
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
                                            <input type="text" class="form-control @error('line_pr') is-invalid @enderror" value="{{old('line_pr') ?? $purchase_requisition->line_pr}}" id="line_pr" placeholder="Line PR" name="line_pr">
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
                                            <input type="text" class="form-control @error('oe_pr') is-invalid @enderror" value="{{old('oe_pr') ?? $purchase_requisition->oe_pr}}" id="oe_pr" placeholder="OE PR" name="oe_pr">
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
                                            <select id="kontrak" name="kontrak" class="form-control select2bs4 @error('kontrak') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Non Kontrak (Induk)' {{ old('kontrak', $purchase_requisition->kontrak) == 'Non Kontrak (Induk)' ? 'selected' : '' }}>Non Kontrak (Induk)</option>
                                                <option value='Non Kontrak (Spot)' {{ old('kontrak', $purchase_requisition->kontrak) == 'Non Kontrak (Spot)' ? 'selected' : '' }}>Non Kontrak (Spot)</option>
                                                <option value='Kontrak' {{ old('kontrak', $purchase_requisition->kontrak) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                                <option value='SPMK' {{ old('kontrak', $purchase_requisition->kontrak) == 'SPMK' ? 'selected' : '' }}>SPMK</option>
                                            </select>
                                            @error('kontrak')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="status">Status</label>
                                        <div class="col-md-10">
                                            <select id="status" name="status" class="form-control select2bs4 @error('status') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                @foreach($status as $stat)
                                                <option value='{{$stat->status}}' {{ old('status', $purchase_requisition->status) == $stat->status ? 'selected' : '' }}>{{$stat->status}}</option>
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
                                                <input type="text" class="form-control datetimepicker-input @error('tanggal_deliv') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_deliv') ?? $purchase_requisition->tanggal_deliv}}" data-target="#reservationdate2" placeholder="Tanggal Delivered" name="tanggal_deliv">
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
                <form action="{{route('pr.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_hapus" name="id">
                    Apakah Anda Yakin Ingin Menghapus PR Berikut?
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
    $('.kembali li:eq(2) a').tab('show')
</script>
@endif

<script>
    $(document).on('click', '.hapus', function() {
        let id = $(this).attr('data-id');
        $('#id_hapus').val(id);
    });
</script>

<script type="text/javascript">
    var rupiah = document.getElementById('oe_pr');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

<script>
    $('#submit-update').click(function() {
        $('#form-update').submit();
    });
</script>
@endpush