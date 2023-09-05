@extends('layouts.home')
@section('title', 'Daftar Rekanan')
@section('header', 'Daftar Rekanan')
@section('action7','active')
@section('action71','active')
@section('menuopen3','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Daftar Rekanan</li>
</ol>
@endsection
@section('content')
<style>
    table tfoot th {
        background-color: #f1f1f1;
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
                <h3 class="card-title" style="font-size: 15px; font-weight: bold;">Daftar Rekanan</h3>
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
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add"><span style="font-weight:bolder">Tambah Rekanan</span></a>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <span style="font-weight:bolder">Rentang Tanggal</span>
                        </button>
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder">Clear Filters</span></a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="vendors" class="fixeds table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th class="tanggal">Periode</th>
                                <th class="no_sap">Kode Rekanan</th>
                                <th>Tipe Perusahaan</th>
                                <th class="vendor">Nama Rekanan</th>
                                <th class="alamat">Alamat</th>
                                <th class="kota">Kota</th>
                                <th class="email">Email</th>
                                <th class="no">No. Telp</th>
                                <th class="sos">No. SoS Barang</th>
                                <th class="sos">No. SoS Jasa</th>
                                <th class="no_sap">Status Rekanan</th>
                                <th class="no_sap">No SAP</th>
                                <th class="sos">Rekanan Khusus</th>
                                <th class="alamat">Test Link</th>
                                <th class="tanggal">Status</th>
                                <th class="pic">Last Updated By</th>
                                <th class="detail2">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Periode</th>
                                <th>Kode Rekanan</th>
                                <th>Tipe Perusahaan</th>
                                <th>Nama Rekanan</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>No SoS Barang</th>
                                <th>No SoS Jasa</th>
                                <th>Status Rekanan</th>
                                <th>No SAP</th>
                                <th>Rekanan Khusus</th>
                                <th>Test Link</th>
                                <th>Status</th>
                                <th>Last Updated By</th>
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
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah Rekanan</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body py-2" style="background-color: #f4f6f9;">
                <form action="{{route('rekanan.store')}}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="periode">Periode<span class="required">*</span></label>
                        <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('periode') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('periode')}}" data-target="#reservationdate3" placeholder="Periode" name="periode">
                            <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            @error('periode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="kode_rekanan">Kode Rekanan</label>
                            <input type="text" class="form-control @error('kode_rekanan') is-invalid @enderror" value="{{old('kode_rekanan')}}" id="kode_rekanan" placeholder="Kode Rekanan" name="kode_rekanan">
                            @error('kode_rekanan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="no_sap">No SAP</label>
                            <input type="text" class="form-control @error('no_sap') is-invalid @enderror" value="{{old('no_sap')}}" id="no_sap" placeholder="No SAP" name="no_sap">
                            @error('no_sap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="tipe_perusahaan">Tipe Perusahaan</label>
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
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="nama_rekanan">Nama Rekanan<span class="required">*</span></label>
                        <input type="text" class="form-control @error('nama_rekanan') is-invalid @enderror" value="{{old('nama_rekanan')}}" id="nama_rekanan" placeholder="Nama Rekanan" name="nama_rekanan">
                        @error('nama_rekanan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}" id="alamat" placeholder="Alamat" name="alamat">
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="kota">Kota</label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror" value="{{old('kota')}}" id="kota" placeholder="Kota" name="kota">
                            @error('kota')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="email" placeholder="Email" name="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="no_telp">No. Telp</label>
                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" value="{{old('no_telp')}}" id="no_telp" placeholder="081xxx" name="no_telp">
                            @error('no_telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="no_sos_barang">No. SoS Barang</label>
                        <select id="no_sos_barang" name="no_sos_barang[]" multiple class="form-control select2bs4 @error('no_sos_barang') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                            <option value=''></option>
                            @foreach($no_sos_barang as $sos)
                            @if (old('no_sos_barang'))
                            <option value="{{ $sos->kode_sos }}" {{ in_array($sos->kode_sos, old('no_sos_barang')) ? 'selected' : '' }}>{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                            @else
                            <option value="{{ $sos->kode_sos }}">{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('no_sos_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="no_sos_jasa">No. SoS Jasa</label>
                        <select id="no_sos_jasa" name="no_sos_jasa[]" multiple class="form-control select2bs4 @error('no_sos_jasa') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                            <option value=''></option>
                            @foreach($no_sos_jasa as $sos)
                            @if (old('no_sos_jasa'))
                            <option value="{{ $sos->kode_sos }}" {{ in_array($sos->kode_sos, old('no_sos_jasa')) ? 'selected' : '' }}>{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                            @else
                            <option value="{{ $sos->kode_sos }}">{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('no_sos_jasa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="status_rekanan">Status Rekanan</label>
                            <select id="status_rekanan" name="status_rekanan" class="form-control select2bs4 @error('status_rekanan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Registered' @if(old('status_rekanan')=='Registered' ) selected @endif>Registered</option>
                                <option value='Unregistered' @if(old('status_rekanan')=='Unregistered' ) selected @endif>Unregistered</option>
                            </select>
                            @error('status_rekanan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="status">Status<span class="required">*</span></label>
                            <select id="status" name="status" class="form-control select2bs4 @error('status') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Aktif' @if(old('status')=='Aktif' ) selected @endif>Aktif</option>
                                <option value='Non Aktif' @if(old('status')=='Non Aktif' ) selected @endif>Non Aktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="tes_link">Tes Link</label>
                        <textarea id="tes_link" class="form-control @error('tes_link') is-invalid @enderror" name="tes_link" rows="3" cols="50" placeholder="Tes Link">{{old('tes_link')}}</textarea>
                        @error('tes_link')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="khusus">Rekanan Khusus?</label>
                        <div class="icheck-success">
                            <input type="checkbox" name="khusus" id="khusus" value="Rekanan Khusus" @if(old('khusus')=='Rekanan Khusus' ) checked @endif>
                            <label for="khusus">
                                <span style="font-weight: lighter;"> Rekanan Khusus</span>
                            </label>
                        </div>
                        @error('khusus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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

<script>
    $(function() {
        $('#vendors tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="" />');
        });

        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });


        load_data();

        function load_data(from_date = '', to_date = '') {
            var table = $('#vendors').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
                ],
                dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
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
                        extend: 'print',
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
                ajax: {
                    url: '{{ route("rekanan.index") }}',
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
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'center'
                    },
                    {
                        data: 'periode',
                        name: 'periode',
                        className: 'center',
                    },
                    {
                        data: 'kode_rekanan',
                        name: 'kode_rekanan',
                        className: 'center',
                    },
                    {
                        data: 'tipe_perusahaan',
                        name: 'tipe_perusahaan',
                        className: 'center',
                    },
                    {
                        data: 'nama_rekanan',
                        name: 'nama_rekanan',
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                    },
                    {
                        data: 'kota',
                        name: 'kota',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp',
                        className: 'end'
                    },
                    {
                        data: 'no_sos_barang',
                        name: 'no_sos_barang',
                    },
                    {
                        data: 'no_sos_jasa',
                        name: 'no_sos_jasa',
                    },
                    {
                        data: 'status_rekanan',
                        name: 'status_rekanan',
                    },
                    {
                        data: 'no_sap',
                        name: 'no_sap',
                        className: 'end'
                    },
                    {
                        data: 'khusus',
                        name: 'khusus',
                        className: 'center',
                    },
                    {
                        data: 'tes_link',
                        name: 'tes_link',
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'center',
                        render: function(data) {
                            if (data === 'Aktif') {
                                return '<span class="badge badge-success badge-sm">Aktif</span>';
                            } else if (data === 'Non Aktif') {
                                return '<span class="badge badge-danger badge-sm">Non Aktif</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'last_updated_by',
                        name: 'last_updated_by',
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
                    [3, "asc"]
                ],
                initComplete: function() {
                    // Apply the search
                    this.api().columns([3, 4, 6, 7, 8, 9, 11]).every(function() {
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
                    this.api().columns([3, 11, 13, 15]).every(function() {
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
                },
                fixedColumns: {
                    left: 0,
                    right: 1,
                },
            });
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date != '' && to_date != '') {
                $('#vendors').DataTable().destroy();
                load_data(from_date, to_date);
            } else {
                alert('Harap Mengisi Kedua Tanggal!');
            }
        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#vendors').DataTable().destroy();
            load_data();
        });
        table.buttons().container()
            .appendTo('#vendors_wrapper .col-md-6:eq(0)');
    });

    function ClearFilters() {

        $('.form-control').val('');

        var table = $('#vendors').DataTable();
        table
            .search('')
            .columns().search('')
            .draw();
    }
</script>
@endpush