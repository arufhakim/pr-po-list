@extends('layouts.home')
@section('title', 'Proses Tender')
@section('header', 'Proses Tender')
@section('menuopen6','menu-open')
@section('action41','active')
@section('action4','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Proses Tender</li>
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
                            <input type="text" class="form-control datetimepicker-input" value="{{old('from_date')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask data-target="#reservationdate" placeholder="Tanggal Awal" name="from_date" id="from_date">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_akhir">Tanggal Akhir<span class="required">*</span></label>
                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" value="{{old('to_date')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask data-target="#reservationdate2" placeholder="Tanggal Akhir" name="to_date" id="to_date">
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
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bold;">Proses Tender</h3>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 text-left">
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <span style="font-weight:bolder">Rentang Tanggal</span>
                        </button>
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder">Clear Filters</span></a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="users-table2" class="fixeds table table-bordered table-sm table-striped table-hover">
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
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script>
    $(function() {
        $('#users-table2 tfoot th').each(function() {
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
            var table = $('#users-table2').DataTable({
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
                    url: '{{ route("po.index") }}',
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
                    }, {
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
                            if (data == 'Belum Diproses') {
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
                $('#users-table2').DataTable().destroy();
                load_data(from_date, to_date);
            } else {
                alert('Harap Mengisi Kedua Tanggal!');
            }
        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#users-table2').DataTable().destroy();
            load_data();
        });
        table.buttons().container()
            .appendTo('#users_table2_wrapper .col-md-6:eq(0)');
    });

    function ClearFilters() {

        $('.form-control').val('');

        var table = $('#users-table2').DataTable();
        table
            .search('')
            .columns().search('')
            .draw();
    }
</script>
@endpush

@push('cs')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
@endpush