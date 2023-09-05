@extends('layouts.home')
@section('title', 'Proses Tender')
@section('header', 'Proses Tender')
@section('menuopen6','menu-open')
@section('action41','active')
@section('action4','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('po.index')}}">Proses Tender</a></li>
    <li class="breadcrumb-item active">Detail Proses Tender</li>
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
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Detail Proses Tender</h3>
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
                        <a class="nav-link text-center" id="custom-content-below-home-tab" data-toggle="pill" href="#pr" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="font-weight: bolder;">PURCHASE REQUISITION</a>
                    </li>
                    <li class="nav-item" style="width: 25%;">
                        <a class="nav-link active text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#po" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">PROSES TENDER</a>
                    </li>
                    <li class="nav-item" style="width: 25%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#edit" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">UPDATE PROSES TENDER</a>
                    </li>
                    <li class="nav-item" style="width: 25%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#log" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">LOG HISTORY</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade" id="pr" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
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
                                        <input type="text" class="form-control" value="@currency($purchase_requisition->oe_pr)" name="oe_pr" readonly>
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
                    </div>
                    <div class="tab-pane fade show active" id="po" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
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
                        <form id="form-update" action="{{route('po.update', ['po' => $po->id])}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_terima_pr">Tanggal Terima PR<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('tanggal_terima_pr') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_terima_pr') ?? $po->tanggal_terima_pr}}" data-target="#reservationdate" placeholder="Tanggal Terima PR" name="tanggal_terima_pr">
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('tanggal_terima_pr')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="eprocsap">EPROC/SAP</label>
                                        <div class="col-md-10">
                                            <select id="eprocsap" name="eprocsap" class="form-control select2bs4 @error('eprocsap') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='EPROC' {{ old('eprocsap', $po->eprocsap) == 'EPROC' ? 'selected' : '' }}>EPROC</option>
                                                <option value='SAP' {{ old('eprocsap', $po->eprocsap) == 'SAP' ? 'selected' : '' }}>SAP</option>
                                            </select>
                                            @error('eprocsap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="progress">Progress</label>
                                        <div class="col-md-10">
                                            <select id="progress" name="progress" class="form-control  select2bs4 @error('progress') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                @foreach($progress as $prog)
                                                <option value='{{$prog->progress}}' {{ old('progress', $po->progress) == $prog->progress ? 'selected' : '' }}>{{$prog->progress}}</option>
                                                @endforeach
                                            </select>
                                            @error('progress')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="no_po_sp">No. PO/Agreement/SP</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('no_po_sp') is-invalid @enderror" value="{{old('no_po_sp') ??  $po->no_po_sp}}" id="no_po_sp" placeholder="No. PO/Agreement/SP" name="no_po_sp">
                                            @error('no_po_sp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="nilai_po">Nilai PO</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('nilai_po') is-invalid @enderror" value="{{old('nilai_po') ?? $po->nilai_po}}" id="nilai_po" placeholder="Nilai PO" name="nilai_po">
                                            @error('nilai_po')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_po">Tanggal PO</label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('tanggal_po') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_po') ?? $po->tanggal_po}}" data-target="#reservationdate2" placeholder="Tanggal PO" name="tanggal_po">
                                                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('tanggal_po')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="vendor">Vendor</label>
                                        <div class="col-md-10">
                                            <select id="vendor" name="vendor" class="form-control  select2bs4 @error('vendor') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                @foreach($rekanan as $vendor)
                                                <option value='{{$vendor->nama_rekanan}}' {{ old('vendor', $po->vendor) == $vendor->nama_rekanan ? 'selected' : '' }}>{{$vendor->nama_rekanan}}</option>
                                                @endforeach
                                            </select>
                                            @error('vendor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="due_date_po">Due Date PO</label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('due_date_po') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('due_date_po') ?? $po->due_date_po}}" data-target="#reservationdate3" placeholder="Tanggal Due Date" name="due_date_po">
                                                <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('due_date_po')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="sinergi">Sinergi</label>
                                        <div class="col-md-10">
                                            <select id="sinergi" name="sinergi" class="form-control select2bs4 @error('sinergi') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=""></option>
                                                <option value='BUMN' {{ old('sinergi', $po->sinergi) == 'BUMN' ? 'selected' : '' }}>BUMN</option>
                                                <option value='PI GROUP' {{ old('sinergi', $po->sinergi) == 'PI GROUP' ? 'selected' : '' }}>PI GROUP</option>
                                                <option value='PG GROUP' {{ old('sinergi', $po->sinergi) == 'PG GROUP' ? 'selected' : '' }}>PG GROUP</option>
                                            </select>
                                            @error('sinergi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="padi">Pembelian Melalui PaDi UMKM</label>
                                        <div class="col-md-10">
                                            <select id="padi" name="padi" class="form-control select2bs4 @error('padi') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=""></option>
                                                <option value='Pengadaan Internal UMKM' {{ old('padi', $po->padi) == 'Pengadaan Internal UMKM' ? 'selected' : '' }}>Pengadaan Internal UMKM</option>
                                                <option value='Pengadaan B2B PaDi UMKM' {{ old('padi', $po->padi) == 'Pengadaan B2B PaDi UMKM' ? 'selected' : '' }}>Pengadaan B2B PaDi UMKM</option>
                                            </select>
                                            @error('padi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="invoicing">Invoicing PaDi</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('invoicing') is-invalid @enderror" value="{{old('invoicing') ?? $po->invoicing}}" id="invoicing" placeholder="Invoicing PaDi" name="invoicing">
                                            @error('invoicing')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="delivered">Delivered</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('delivered') is-invalid @enderror" value="{{old('delivered') ?? $po->delivered}}" id="delivered" placeholder="Delivered" name="delivered">
                                            @error('delivered')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="stb_delivered">Still To Be Delivered</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('stb_delivered') is-invalid @enderror" value="{{old('stb_delivered') ?? $po->stb_delivered}}" id="stb_delivered" placeholder="Still To Be Delivered" name="stb_delivered">
                                            @error('stb_delivered')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="invoiced">Invoiced</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('invoiced') is-invalid @enderror" value="{{old('invoiced') ?? $po->invoiced}}" id="invoiced" placeholder="Invoiced" name="invoiced">
                                            @error('invoiced')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="keterangan">Keterangan</label>
                                        <div class="col-md-10">
                                            <textarea id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" cols="50" style="font-size: 14px" placeholder="Keterangan">{{old('keterangan') ?? $po->keterangan}}</textarea>
                                            @error('keterangan')
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
                Apakah Anda Yakin Ingin Memproses PR Berikut?
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

<script type="text/javascript">
    var rupiah = document.getElementById('nilai_po');
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

<script type="text/javascript">
    var rupiah2 = document.getElementById('invoicing');
    rupiah2.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah2() untuk mengubah angka yang di ketik menjadi format angka
        rupiah2.value = formatRupiah2(this.value);
    });

    /* Fungsi formatRupiah2 */
    function formatRupiah2(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah2 = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah2 += separator + ribuan.join('.');
        }

        rupiah2 = split[1] != undefined ? rupiah2 + split[1] : rupiah2;
        return prefix == undefined ? rupiah2 : (rupiah2 ? 'Rp. ' + rupiah2 : '');
    }
</script>

<script>
    $('#submit-update').click(function() {
        $('#form-update').submit();
    });
</script>

@endpush