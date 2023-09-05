@extends('layouts.home')
@section('title', 'Daftar Pelayanan Rekanan')
@section('header', 'Daftar Pelayanan Rekanan')
@section('action7','active')
@section('action75','active')
@section('menuopen3','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Daftar Pelayanan Rekanan</li>
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
                <h3 class="card-title" style="font-size: 15px; font-weight: bold;">Daftar Pelayanan Rekanan</h3>
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
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add"><span style="font-weight:bolder">Tambah Pelayanan Rekanan</span></a>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <span style="font-weight:bolder"> Rentang Tanggal </span>
                        </button>
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder">Clear Filters</span></a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="keluhan" class="fixeds table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th class="tanggal">Tanggal Pelaporan</th>
                                <th class="vendor">Nama Rekanan</th>
                                <th class="bidang_usaha">Deskripsi</th>
                                <th class="tanggal">Media Penyampaian Keluhan</th>
                                <th class="">Evidence</th>
                                <th class="tanggal">Tanggal Close</th>
                                <th class="bidang_usaha">Keterangan</th>
                                <th class="website">Kategori</th>
                                <th class="tanggal">Pelayanan/Keluhan</th>
                                <th class="pic">Last Updated By</th>
                                <th class="detail2">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Pelaporan</th>
                                <th>Nama Rekanan</th>
                                <th>Deskripsi</th>
                                <th>Media Penyampaian Keluhan</th>
                                <th>Evidence</th>
                                <th>Tanggal Close</th>
                                <th>Keterangan</th>
                                <th>Kategori</th>
                                <th>Pelayanan/Keluhan</th>
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
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah Pelayanan Rekanan</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body py-2" style="background-color: #f4f6f9;">
                <form action="{{route('keluhan.store')}}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="tanggal_pelaporan">Tanggal Pelaporan<span class="required">*</span></label>
                        <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('tanggal_pelaporan') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_pelaporan')}}" data-target="#reservationdate3" placeholder="Tanggal Pelaporan" name="tanggal_pelaporan">
                            <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            @error('tanggal_pelaporan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="nama_rekanan">Nama Rekanan<span class="required">*</span></label>
                        <select id="nama_rekanan" name="nama_rekanan" class="form-control select2bs4 @error('nama_rekanan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                            <option value=''></option>
                            @foreach($rekanan as $rekan)
                            <option value='{{$rekan->nama_rekanan}}' {{ old('nama_rekanan') == $rekan->nama_rekanan ? 'selected' : '' }}>{{$rekan->nama_rekanan}}</option>
                            @endforeach
                        </select>
                        @error('nama_rekanan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="deskripsi">Deskripsi<span class="required">*</span></label>
                        <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" cols="50" placeholder="Deskripsi">{{old('deskripsi')}}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="media_penyampaian_keluhan">Media Penyampaian Keluhan<span class="required">*</span></label>
                            <select id="media_penyampaian_keluhan" name="media_penyampaian_keluhan" class="form-control select2bs4 @error('media_penyampaian_keluhan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Email' @if(old('media_penyampaian_keluhan')=='Email' ) selected @endif>Email</option>
                                <option value='Telepon' @if(old('media_penyampaian_keluhan')=='Telepon' ) selected @endif>Telepon</option>
                                <option value='WhatsApp' @if(old('media_penyampaian_keluhan')=='WhatsApp' ) selected @endif>WhatsApp</option>
                                <option value='Langsung' @if(old('media_penyampaian_keluhan')=='Langsung' ) selected @endif>Langsung</option>
                            </select>
                            @error('media_penyampaian_keluhan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="evidence">Evidence<span class="required">*</span></label>
                            <select id="evidence" name="evidence" class="form-control select2bs4 @error('evidence') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Ada' @if(old('evidence')=='Ada' ) selected @endif>Ada</option>
                                <option value='Tidak' @if(old('evidence')=='Tidak' ) selected @endif>Tidak</option>
                            </select>
                            @error('evidence')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="tanggal_close">Tanggal Close</label>
                        <div class="input-group date" id="reservationdate4" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('tanggal_close') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_close')}}" data-target="#reservationdate4" placeholder="Tanggal Close" name="tanggal_close">
                            <div class="input-group-append" data-target="#reservationdate4" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            @error('tanggal_close')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="keterangan">Keterangan</label>
                        <textarea id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" cols="50" placeholder="Keterangan">{{old('keterangan')}}</textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="kategori">Kategori</label>
                            <select id="kategori" name="kategori" class="form-control select2bs4 @error('kategori') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Eproc Error' @if(old('kategori')=='Eproc Error' ) selected @endif>Eproc Error</option>
                                <option value='Extend Rekanan' @if(old('kategori')=='Extend Rekanan' ) selected @endif>Extend Rekanan</option>
                                <option value='Migrasi Data' @if(old('kategori')=='Migrasi Data' ) selected @endif>Migrasi Data</option>
                                <option value='Pendaftaran Rekanan' @if(old('kategori')=='Pendaftaran Rekanan' ) selected @endif>Pendaftaran Rekanan</option>
                                <option value='PO Outstanding' @if(old('kategori')=='PO Outstanding' ) selected @endif>PO Outstanding</option>
                                <option value='Proses Tender' @if(old('kategori')=='Proses Tender' ) selected @endif>Proses Tender</option>
                                <option value='Reset Password' @if(old('kategori')=='Reset Password' ) selected @endif>Reset Password</option>
                                <option value='Trial' @if(old('kategori')=='Trial' ) selected @endif>Trial</option>
                                <option value='Update Data Rekanan' @if(old('kategori')=='Update Data Rekanan' ) selected @endif>Update Data Rekanan</option>
                            </select>
                            @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="pelayanan_keluhan">Pelayanan/Keluhan</label>
                            <select id="pelayanan_keluhan" name="pelayanan_keluhan" class="form-control select2bs4 @error('pelayanan_keluhan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Pelayanan' @if(old('pelayanan_keluhan')=='Pelayanan' ) selected @endif>Pelayanan</option>
                                <option value='Keluhan' @if(old('pelayanan_keluhan')=='Keluhan' ) selected @endif>Keluhan</option>
                            </select>
                            @error('pelayanan_keluhan')
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

<script>
    $(function() {
        $('#keluhan tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text"  class="form-control" placeholder="" />');
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
            $('#keluhan').DataTable({
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
                        extend: 'pageLength',
                        className: 'pageLength'
                    },
                    {
                        extend: 'colvis',
                        className: 'colvis'
                    },
                ],
                ajax: {
                    url: '{{ route("keluhan.index") }}',
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
                        data: 'tanggal_pelaporan',
                        name: 'tanggal_pelaporan',
                        className: 'center'
                    },
                    {
                        data: 'nama_rekanan',
                        name: 'nama_rekanan',
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                    },
                    {
                        data: 'media_penyampaian_keluhan',
                        name: 'media_penyampaian_keluhan',
                    },
                    {
                        data: 'evidence',
                        name: 'evidence',
                    },
                    {
                        data: 'tanggal_close',
                        name: 'tanggal_close',
                        className: 'center'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                    },
                    {
                        data: 'kategori',
                        name: 'kategori',
                    },
                    {
                        data: 'pelayanan_keluhan',
                        name: 'pelayanan_keluhan',
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
                    [2, "desc"]
                ],
                initComplete: function() {
                    // Apply the search
                    this.api().columns([1, 2, 3, 6, 7, 10]).every(function() {
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
                    this.api().columns([4, 5, 8, 9]).every(function() {
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
                $('#keluhan').DataTable().destroy();
                load_data(from_date, to_date);
            } else {
                alert('Harap Mengisi Kedua Tanggal!');
            }
        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#keluhan').DataTable().destroy();
            load_data();
        });
        table.buttons().container()
            .appendTo('#users_table_wrapper .col-md-6:eq(0)');
    });

    function ClearFilters() {

        $('.form-control').val('');

        var table = $('#keluhan').DataTable();
        table
            .search('')
            .columns().search('')
            .draw();
    }
</script>
@endpush