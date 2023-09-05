@extends('layouts.home')
@section('title', 'Presentasi Company Profile')
@section('header', 'Presentasi Company Profile')
@section('action7','active')
@section('action73','active')
@section('menuopen3','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Presentasi Company Profile</li>
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
                <h3 class="card-title" style="font-size: 15px; font-weight:bolder;">Presentasi Company Profile</h3>
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
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder">Clear Filters</span></a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="presentasi" class="fixeds table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tipe Perusahaan</th>
                                <th class="vendor">Nama Vendor</th>
                                <th class="email">Email Vendor</th>
                                <th class="website">Website Vendor</th>
                                <th class="bidang_usaha">Bidang Usaha</th>
                                <th class="merk">Merk/ Brand</th>
                                <th class="pic">Nama PIC</th>
                                <th class="email">Email PIC</th>
                                <th class="no">No HP PIC</th>
                                <th class="tanggal">Status</th>
                                <th class="tanggal">Tanggal Diajukan</th>
                                <th class="detail2">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Tipe Perusahaan</th>
                                <th>Nama Vendor</th>
                                <th>Email Vendor</th>
                                <th>Website Vendor</th>
                                <th>Bidang Usaha</th>
                                <th>Merk/ Brand</th>
                                <th>Nama PIC</th>
                                <th>Email PIC</th>
                                <th>No HP PIC</th>
                                <th>Status</th>
                                <th>Tanggal Diajukan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function() {
        $('#presentasi tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="" />');
        });
        $('#presentasi').DataTable({
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
            ajax: '{{ route("presentasi.index") }}',
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
                    data: 'tipe_perusahaan',
                    name: 'tipe_perusahaan',
                    className: 'center',
                },
                {
                    data: 'nama_vendor',
                    name: 'nama_vendor',
                },
                {
                    data: 'email_vendor',
                    name: 'email_vendor',
                },
                {
                    data: 'website_vendor',
                    name: 'website_vendor',
                },
                {
                    data: 'bidang_usaha',
                    name: 'bidang_usaha',
                },
                {
                    data: 'merk',
                    name: 'merk',
                },
                {
                    data: 'nama_pic',
                    name: 'nama_pic',
                },
                {
                    data: 'email_pic',
                    name: 'email_pic',
                },
                {
                    data: 'no_hp_pic',
                    name: 'no_hp_pic',
                    className: 'end'
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'center',
                    render: function(data) {
                        if (data === 'Proses') {
                            return '<span class="badge badge-secondary badge-sm">Proses</span>';
                        } else if (data === 'Terima') {
                            return '<span class="badge badge-success badge-sm">Terima</span>';
                        } else if (data === 'Tolak') {
                            return '<span class="badge badge-danger badge-sm">Tolak</span>';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'tanggal_diajukan',
                    name: 'tanggal_diajukan',
                    className: 'center',
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
                [11, "desc"]
            ],
            initComplete: function() {
                // Apply the search
                this.api().columns([2, 3, 4, 5, 6, 7, 8, 9, 11]).every(function() {
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
                this.api().columns([1, 10]).every(function() {
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
    });

    function ClearFilters() {

        $('.form-control').val('');

        var table = $('#presentasi').DataTable();
        table
            .search('')
            .columns().search('')
            .draw();
    }
</script>
@endpush