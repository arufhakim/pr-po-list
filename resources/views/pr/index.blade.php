@extends('layouts.home')
@section('title', 'Purchase Requisition')
@section('header', 'Purchase Requisition')
@section('menuopen5','menu-open')
@section('action21','active')
@section('action2','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Purchase Requisition</li>
</ol>
@endsection
@section('content')
<style>
    table tfoot th {
        background-color: #f1f1f1;
    }

    .position {
        height: 38px;
        border-style: solid;
        border-width: 2px;
        border-color: #dadfe3;
        border-radius: 4px;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h3 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Rentang Tanggal</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body" style="background-color: #f4f6f9;">
                <div class="row justify-content-center" style="border-radius: 5px;">
                    <div class="col-md-6">
                        <label for="tanggal_awal">Tanggal Awal<span class="required">*</span></label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('from_date')}}" data-target="#reservationdate" placeholder="Tanggal Awal" name="from_date" id="from_date">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_akhir">Tanggal Akhir<span class="required">*</span></label>
                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('to_date')}}" data-target="#reservationdate2" placeholder="Tanggal Akhir" name="to_date" id="to_date">
                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2" style="background-color: #f4f6f9;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <button type="button" name="refresh" id="refresh" class="btn btn-success btn-sm"><span style="font-weight:bolder">Refresh</span></i></button>
                <button type="button" name="filter" id="filter" class="btn btn-primary btn-sm"><span style="font-weight:bolder">Cari</span></i></button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
<div class="row">
    @include('alert')
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bold;">Purchase Requisition</h3>
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
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add"><span style="font-weight:bolder">Tambah Purchase Requisition</span></a>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <span style="font-weight:bolder">Rentang Tanggal</span>
                        </button>
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder">Clear Filters</span></a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="users-table" class="fixeds table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th class="tanggal">Tanggal SR</th>
                                <th class="tanggal">Tanggal SR Verifikasi</th>
                                <th class="uraian_pekerjaan">Uraian Pekerjaan</th>
                                <th class="tim">Tim</th>
                                <th class="user">User</th>
                                <th class="nomor_sr">Nomor SR</th>
                                <th class="gl_account">GL Account</th>
                                <th class="cost_center">Cost Center</th>
                                <th>PI/PG</th>
                                <th class="prioritas">Prioritas</th>
                                <th class="nomor_pr">Nomor PR</th>
                                <th>Line PR</th>
                                <th class="nilai">OE PR</th>
                                <th class="kontrak">Kontrak/Non-Kontrak</th>
                                <th class="status">Status</th>
                                <th class="tanggal">Tanggal Delivered</th>
                                <th class="tanggal">Tanggal Terima PR</th>
                                <th class="pic">PIC</th>
                                <th class="bagian">Bagian</th>
                                <th>EPROC/SAP</th>
                                <th class="prog">Progress</th>
                                <th>No. PO/Agreement/SP</th>
                                <th class="nilai">Nilai PO</th>
                                <th class="tanggal">Tanggal PO</th>
                                <th class="vendor">Vendor</th>
                                <th class="tanggal">Due Date PO</th>
                                <th>Waktu Proses</th>
                                <th class="sinergi">Sinergi BUMN/PI Group</th>
                                <th class="padi">Pembelian Melalui PaDi UMKM</th>
                                <th class="nilai">Invoicing PaDi</th>
                                <th>Delivered</th>
                                <th class="stb_delivered">Still To Be Delivered</th>
                                <th>Invoiced</th>
                                <th class="pic">Keterangan</th>
                                <th class="detail2">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot class="detail">
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Tanggal SR</th>
                                <th>Tanggal SR Verifikasi</th>
                                <th>Uraian Pekerjaan</th>
                                <th>Tim</th>
                                <th>User</th>
                                <th>Nomor SR</th>
                                <th>GL Account</th>
                                <th>Cost Center</th>
                                <th>PI/PG</th>
                                <th>Prioritas</th>
                                <th>Nomor PR</th>
                                <th>Line PR</th>
                                <th>OE PR</th>
                                <th>Kontrak/Non-Kontrak</th>
                                <th>Status</th>
                                <th>Tanggal Delivered</th>
                                <th>Tanggal Terima PR</th>
                                <th>PIC</th>
                                <th>Bagian</th>
                                <th>EPROC/SAP</th>
                                <th>Progress PO</th>
                                <th>No. PO/Agreement/SP</th>
                                <th>Nilai PO</th>
                                <th>Tanggal PO</th>
                                <th>Vendor</th>
                                <th>Due Date PO</th>
                                <th>Waktu Proses</th>
                                <th>Sinergi BUMN/PI Group</th>
                                <th>Pembelian Melalui PaDi UMKM</th>
                                <th>Invoicing PaDi</th>
                                <th>Delivered</th>
                                <th>Still To Be Delivered</th>
                                <th>Invoiced</th>
                                <th>Keterangan</th>
                                <th></th>
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
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah Purchase Requisition</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body py-2" style="background-color: #f4f6f9;">
                <form action="{{route('pr.store')}}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="tanggal_sr">Tanggal SR<span class="required">*</span></label>
                            <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input @error('tanggal_sr') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_sr')}}" data-target="#reservationdate3" placeholder="Tanggal SR" name="tanggal_sr">
                                <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('tanggal_sr')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="tanggal_sr_verif">Tanggal SR Verifikasi</label>
                            <div class="input-group date" id="reservationdate4" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input @error('tanggal_sr_verif') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_sr_verif')}}" data-target="#reservationdate4" placeholder="Tanggal SR Verifikasi" name="tanggal_sr_verif">
                                <div class="input-group-append" data-target="#reservationdate4" data-toggle="datetimepicker">
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
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="nomor_sr">Nomor SR<span class="required">*</span></label>
                        <input type="text" class="form-control @error('nomor_sr') is-invalid @enderror" value="{{old('nomor_sr')}}" id="nomor_sr" placeholder="Nomor SR" name="nomor_sr">
                        @error('nomor_sr')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="tim">Tim</label>
                            <select id="tim" name="tim" class="form-control select2bs4 @error('tim') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Non Pabrik' @if(old('tim')=='Non Pabrik' ) selected @endif>Non Pabrik</option>
                                <option value='Pabrik' @if(old('tim')=='Pabrik' ) selected @endif>Pabrik</option>
                                <option value='Umum' @if(old('tim')=='Umum' ) selected @endif>Umum</option>
                            </select>
                            @error('tim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="unit">User</label>
                            <select id="unit" name="unit" class="form-control select2bs4 @error('unit') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                @foreach($unit as $un)
                                <option value='{{$un->unit}}' {{ old('unit') == $un->unit ? 'selected' : '' }}>{{$un->unit}}</option>
                                @endforeach
                            </select>
                            @error('unit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="gl_account">GL Account</label>
                        <input type="text" class="form-control @error('gl_account') is-invalid @enderror" value="{{old('gl_account')}}" id="gl_account" placeholder="GL Account" name="gl_account">
                        @error('gl_account')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="cost_center">Cost Center</label>
                        <input type="text" class="form-control @error('cost_center') is-invalid @enderror" value="{{old('cost_center')}}" id="cost_center" placeholder="Cost Center" name="cost_center">
                        @error('cost_center')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="uraian_pekerjaan">Uraian Pekerjaan<span class="required">*</span></label>
                        <textarea id="uraian_pekerjaan" class="form-control @error('uraian_pekerjaan') is-invalid @enderror" name="uraian_pekerjaan" rows="3" cols="50" placeholder="Uraian Pekerjaan">{{old('uraian_pekerjaan')}}</textarea>
                        @error('uraian_pekerjaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="pipg">PI/PG</label>
                            <select id="pipg" name="pipg" class="form-control select2bs4 @error('pipg') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='PI' @if(old('pipg')=='PI' ) selected @endif>PI</option>
                                <option value='PG' @if(old('pipg')=='PG' ) selected @endif>PG</option>
                            </select>
                            @error('pipg')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="prioritas">Prioritas</label>
                            <select id="prioritas" name="prioritas" class="form-control select2bs4 @error('prioritas') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Normal - Backdate' @if(old('prioritas')=='Normal - Backdate' ) selected @endif>Normal - Backdate</option>
                                <option value='Normal - On Time' @if(old('prioritas')=='Normal - On Time' ) selected @endif>Normal - On Time</option>
                                <option value='Investasi' @if(old('prioritas')=='Investasi' ) selected @endif>Investasi</option>
                                <option value='Emergency' @if(old('prioritas')=='Emergency' ) selected @endif>Emergency</option>
                                <option value='Urgent' @if(old('prioritas')=='Urgent' ) selected @endif>Urgent</option>
                                <option value='TA' @if(old('prioritas')=='TA' ) selected @endif>TA</option>
                            </select>
                            @error('prioritas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="nomor_pr">Nomor PR</label>
                        <input type="text" class="form-control @error('nomor_pr') is-invalid @enderror" value="{{old('nomor_pr')}}" id="nomor_pr" placeholder="Nomor PR" name="nomor_pr">
                        @error('nomor_pr')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="line_pr">Line PR</label>
                        <input type="text" class="form-control @error('line_pr') is-invalid @enderror" value="{{old('line_pr')}}" id="line_pr" placeholder="Line PR" name="line_pr">
                        @error('line_pr')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="oe_pr">OE PR</label>
                        <input type="text" class="form-control @error('oe_pr') is-invalid @enderror" value="{{old('oe_pr')}}" id="oe_pr" placeholder="OE PR" name="oe_pr">
                        @error('oe_pr')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="kontrak">Kontrak</label>
                            <select id="kontrak" name="kontrak" class="form-control select2bs4 @error('kontrak') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Non Kontrak (Induk)' @if(old('kontrak')=='Non Kontrak (Induk)' ) selected @endif>Non Kontrak (Induk)</option>
                                <option value='Non Kontrak (Spot)' @if(old('kontrak')=='Non Kontrak (Spot)' ) selected @endif>Non Kontrak (Spot)</option>
                                <option value='Kontrak' @if(old('kontrak')=='Kontrak' ) selected @endif>Kontrak</option>
                                <option value='SPMK' @if(old('kontrak')=='SPMK' ) selected @endif>SPMK</option>
                            </select>
                            @error('kontrak')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="status">Status</label>
                            <select id="status" name="status" class="form-control select2bs4 @error('status') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                @foreach($status as $stat)
                                <option value='{{$stat->status}}' {{ old('status') == $stat->status ? 'selected' : '' }}>{{$stat->status}}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="tanggal_deliv">Tanggal Delivered</label>
                        <div class="input-group date" id="reservationdate5" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('tanggal_deliv') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask  value="{{old('tanggal_deliv')}}" data-target="#reservationdate5" placeholder="Tanggal Delivered" name="tanggal_deliv">
                            <div class="input-group-append" data-target="#reservationdate5" data-toggle="datetimepicker">
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
            <div class="modal-footer py-2" style="background-color: #f4f6f9;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Simpan</span></button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@if(count($errors) > 0)
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script>
    $(function() {
        $('#users-table tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text"  class="form-control" placeholder="" />');
        });

        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
                ],
                dom: "<'row'<'col-sm-6'B><'col-sm-6'Rf>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [{
                        extend: 'copy',
                        className: 'copy'
                    },
                    {
                        extend: 'excel',
                        className: 'excel'
                    },
                    {
                        extend: 'csv',
                        className: 'csv'
                    },
                    {
                        extend: 'pageLength',
                        className: 'pageLength'
                    },
                    {
                        extend: 'colvis',
                        className: 'colvis'
                    },
                ],
                fixedColumns: {
                    left: 0,
                    right: 1,
                },
                ajax: {
                    url: '{{ route("pr.index") }}',
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span> '
                },
                pageLength: 100,
                scrollY: 500,
                scrollX: true,
                scrollCollapse: true,
                columns: [{
                        orderable: false,
                        searchable: false,
                        data: null,
                        defaultContent: '',
                        className: 'select-checkbox',
                        targets: 0
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        className: 'center'
                    },
                    {
                        data: 'tanggal_sr',
                        name: 'tanggal_sr',
                        className: 'center',
                    },
                    {
                        data: 'tanggal_sr_verif',
                        name: 'tanggal_sr_verif',
                        className: 'center',
                    },
                    {
                        data: 'uraian_pekerjaan',
                        name: 'uraian_pekerjaan'
                    },
                    {
                        data: 'tim',
                        name: 'tim',

                    },
                    {
                        data: 'unit',
                        name: 'unit',
                    },
                    {
                        data: 'nomor_sr',
                        name: 'nomor_sr',
                        className: 'center'
                    },
                    {
                        data: 'gl_account',
                        name: 'gl_account',
                    },
                    {
                        data: 'cost_center',
                        name: 'cost_center',
                    },
                    {
                        data: 'pipg',
                        name: 'pipg',
                        className: 'center'
                    },
                    {
                        data: 'prioritas',
                        name: 'prioritas',
                    },
                    {
                        data: 'nomor_pr',
                        name: 'nomor_pr',
                        className: 'end'
                    },
                    {
                        data: 'line_pr',
                        name: 'line_pr',
                        className: 'center',
                        className: 'end'
                    },
                    {
                        data: 'oe_pr',
                        name: 'oe_pr',
                        render: $.fn.dataTable.render.number('.', '', '', 'Rp '),
                        className: 'end'
                    },
                    {
                        data: 'kontrak',
                        name: 'kontrak',

                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'tanggal_deliv',
                        name: 'tanggal_deliv',
                        className: 'center'
                    },
                    {
                        data: 'tanggal_terima_pr',
                        name: 'po.tanggal_terima_pr',
                        className: 'center',
                    },
                    {
                        data: 'pic',
                        name: 'po.pic',
                    },
                    {
                        data: 'bagian',
                        name: 'po.bagian',
                    },
                    {
                        data: 'eprocsap',
                        name: 'po.eprocsap',
                        className: 'center'
                    },
                    {
                        data: 'progress',
                        name: 'po.progress',
                        className: 'center',
                        render: function(data) {
                            if (data === 'Belum Diproses') {
                                return '<span class="badge badge-danger">Belum Diproses</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'no_po_sp',
                        name: 'po.no_po_sp',
                        className: 'end',
                    },
                    {
                        data: 'nilai_po',
                        name: 'po.nilai_po',
                        render: $.fn.dataTable.render.number('.', '', '', 'Rp '),
                        className: 'end'
                    },
                    {
                        data: 'tanggal_po',
                        name: 'po.tanggal_po',
                        className: 'center',

                    },
                    {
                        data: 'vendor',
                        name: 'po.vendor',
                    },
                    {
                        data: 'due_date_po',
                        name: 'po.due_date_po',
                        className: 'center',

                    },
                    {
                        data: 'waktu_proses',
                        name: 'po.waktu_proses',
                        className: 'end'
                    },
                    {
                        data: 'sinergi',
                        name: 'po.sinergi',
                        className: 'center'
                    },
                    {
                        data: 'padi',
                        name: 'po.padi',
                    },
                    {
                        data: 'invoicing',
                        name: 'po.invoicing',
                        render: $.fn.dataTable.render.number('.', '', '', 'Rp '),
                        className: 'end'
                    },
                    {
                        data: 'delivered',
                        name: 'po.delivered',
                    },
                    {
                        data: 'stb_delivered',
                        name: 'po.stb_delivered',
                    },
                    {
                        data: 'invoiced',
                        name: 'po.invoiced',
                    },
                    {
                        data: 'keterangan',
                        name: 'po.keterangan',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'center'
                    },
                ],
                order: [
                    [2, "desc"]
                ],
                initComplete: function() {
                    // Apply the search
                    this.api().columns([2, 3, 4, 7, 8, 9, 12, 13, 14, 17, 18, 23, 24, 25, 26, 27, 28, 31, 32, 33, 34, 35]).every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });

                    // -------------- here we add dropdown selectors filters to specified columns  --------------
                    this.api().columns([5, 6, 10, 11, 15, 16, 19, 20, 21, 22, 29, 30]).every(function() {
                        var column = this;
                        var select = $('<select class="form-control"><option  value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    });
                    // var $buttons = $('.dt-buttons').hide();
                    // $('#exportLink').on('change', function() {
                    //     var btnClass = $(this).find(":selected")[0].id ?
                    //         '.buttons-' + $(this).find(":selected")[0].id :
                    //         null;
                    //     if (btnClass) $buttons.find(btnClass).click();
                    // });
                },
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
            });
        }

        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date != '' && to_date != '') {
                $('#users-table').DataTable().destroy();
                load_data(from_date, to_date);
            } else {
                alert('Harap Mengisi Kedua Tanggal!');
            }
        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#users-table').DataTable().destroy();
            load_data();
        });
        table.buttons().container()
            .appendTo('#users_table_wrapper .col-md-6:eq(0)');
    });

    function ClearFilters() {

        $('.form-control').val('');

        var table = $('#users-table').DataTable();
        table
            .search('')
            .columns().search('')
            .draw();
    }
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
@endpush

@push('cs')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
@endpush