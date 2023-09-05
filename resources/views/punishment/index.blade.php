@extends('layouts.home')
@section('title', 'Daftar Punishment Rekanan')
@section('header', 'Daftar Punishment Rekanan')
@section('action7','active')
@section('action72','active')
@section('menuopen3','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Daftar Punishment Rekanan</li>
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
                <h3 class="card-title" style="font-size: 15px; font-weight: bold;">Daftar Punishment Rekanan</h3>
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
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add"><span style="font-weight:bolder">Tambah Punishment Rekanan</span></a>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <span style="font-weight:bolder">Rentang Tanggal</span>
                        </button>
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder">Clear Filters</span></a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="punishment" class="fixeds table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th class="vendor">Nama Rekanan</th>
                                <th class="no_sap">No SAP</th>
                                <th class="jenis_hukuman">Jenis Hukuman</th>
                                <th class="jenis_tangguhan">Jenis Tangguhan</th>
                                <th class="catatan_hukuman">Catatan Hukuman</th>
                                <th class="tanggal">Tanggal Mulai</th>
                                <th class="tanggal">Tanggal Selesai</th>
                                <th class="tanggal">Tanggal Dibuat</th>
                                <th class="tanggal">Tanggal Diubah</th>
                                <th>Status</th>
                                <th class="keterangan">Keterangan</th>
                                <th class="pic">Last Updated By</th>
                                <th class="detail2">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama Rekanan</th>
                                <th>No SAP</th>
                                <th>Jenis Hukuman</th>
                                <th>Jenis Tangguhan</th>
                                <th>Catatan Hukuman</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Diubah</th>
                                <th>Status</th>
                                <th>Keterangan</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah Punishment</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('punishment.store')}}" method="POST">
                <div class="modal-body py-2" style="background-color: #f4f6f9;">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="rekanan_id">Nama Rekanan<span class="required">*</span></label>
                        <select id="rekanan_id" name="rekanan_id" class="form-control select2bs4 @error('rekanan_id') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                            <option value=''></option>
                            @foreach($rekanan as $rekan)
                            <option value='{{$rekan->id}}' {{ old('rekanan_id') == $rekan->id ? 'selected' : '' }}>{{$rekan->nama_rekanan}}</option>
                            @endforeach
                        </select>
                        @error('rekanan_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="jenis_hukuman">Jenis Hukuman<span class="required">*</span></label>
                            <select id="jenis_hukuman" name="jenis_hukuman" class="form-control select2bs4 @error('jenis_hukuman') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='Suspend' @if(old('jenis_hukuman')=='Suspend' ) selected @endif>Suspend</option>
                                <option value='Blacklist' @if(old('jenis_hukuman')=='Blacklist' ) selected @endif>Blacklist</option>
                            </select>
                            @error('jenis_hukuman')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="jenis_tangguhan">Jenis Tangguhan</label>
                            <select id="jenis_tangguhan" name="jenis_tangguhan" class="form-control select2bs4 @error('jenis_tangguhan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                <option value='PI Group' @if(old('jenis_tangguhan')=='PI Group' ) selected @endif>PI Group</option>
                                <option value='Lokal' @if(old('jenis_tangguhan')=='Lokal' ) selected @endif>Lokal</option>
                            </select>
                            @error('jenis_tangguhan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="catatan_hukuman">Catatan Hukuman<span class="required">*</span></label>
                        <textarea id="catatan_hukuman" class="form-control @error('catatan_hukuman') is-invalid @enderror" name="catatan_hukuman" rows="3" cols="50" placeholder="Catatan Hukuman">{{old('catatan_hukuman')}}</textarea>
                        @error('catatan_hukuman')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="tanggal_mulai">Tanggal Mulai<span class="required">*</span></label>
                            <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input @error('tanggal_mulai') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_mulai')}}" data-target="#reservationdate3" placeholder="Tanggal Mulai" name="tanggal_mulai">
                                <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('tanggal_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-sm" for="tanggal_selesai">Tanggal Selesai<span class="required">*</span></label>
                            <div class="input-group date" id="reservationdate4" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input @error('tanggal_selesai') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('tanggal_selesai')}}" data-target="#reservationdate4" placeholder="Tanggal Selesai" name="tanggal_selesai">
                                <div class="input-group-append" data-target="#reservationdate4" data-toggle="datetimepicker">
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
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="status">Status<span class="required">*</span></label>
                        <select id="status" name="status" class="form-control select2bs4 @error('status') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                            <option value=''></option>
                            <option value='Punished' @if(old('status')=='Punished' ) selected @endif>Punished</option>
                            <option value='Open Punished' @if(old('status')=='Open Punished' ) selected @endif>Open Punished</option>
                        </select>
                        @error('status')
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

@if($errors->has('rekanan_id') || $errors->has('jenis_hukuman') || $errors->has('jenis_tangguhan') || $errors->has('catatan_hukuman') || $errors->has('tanggal_mulai') || $errors->has('tanggal_selesai') || $errors->has('status'))
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif

<script>
    $(function() {
        $('#punishment tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text"  class="form-control" placeholder="" />');
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
            $('#punishment').DataTable({
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
                    url: '{{ route("punishment.index") }}',
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
                        data: 'nama_rekanan',
                        name: 'rekanan.nama_rekanan',
                    },
                    {
                        data: 'no_sap',
                        name: 'rekanan.no_sap',
                        className: 'end'
                    },
                    {
                        data: 'jenis_hukuman',
                        name: 'jenis_hukuman',
                    },
                    {
                        data: 'jenis_tangguhan',
                        name: 'jenis_tangguhan',
                    },
                    {
                        data: 'catatan_hukuman',
                        name: 'catatan_hukuman',
                    },
                    {
                        data: 'tanggal_mulai',
                        name: 'tanggal_mulai',
                        className: 'center'
                    },
                    {
                        data: 'tanggal_selesai',
                        name: 'tanggal_selesai',
                        className: 'center'
                    },
                    {
                        data: 'tanggal_dibuat',
                        name: 'tanggal_dibuat',
                        className: 'center'
                    },
                    {
                        data: 'tanggal_diubah',
                        name: 'tanggal_diubah',
                        className: 'center'
                    },
                    {
                        data: 'status',
                        name: 'punishment.status',
                        className: 'center',
                        render: function(data) {
                            if (data === 'Punished') {
                                return '<span class="badge badge-danger badge-sm">Punished</span>';
                            } else if (data === 'Open Punished') {
                                return '<span class="badge badge-success badge-sm">Open Punished</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                    },
                    {
                        data: 'last_updated_by',
                        name: 'punishment.last_updated_by',
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
                    [8, "desc"]
                ],
                initComplete: function() {
                    // Apply the search
                    this.api().columns([1, 2, 5, 6, 7, 8, 9, 12]).every(function() {
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
                    this.api().columns([3, 4, 10, 11]).every(function() {
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
                $('#punishment').DataTable().destroy();
                load_data(from_date, to_date);
            } else {
                alert('Harap Mengisi Kedua Tanggal!');
            }
        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#punishment').DataTable().destroy();
            load_data();
        });
        table.buttons().container()
            .appendTo('#users_table_wrapper .col-md-6:eq(0)');
    });

    function ClearFilters() {

        $('.form-control').val('');

        var table = $('#punishment').DataTable();
        table
            .search('')
            .columns().search('')
            .draw();
    }
</script>
@endpush