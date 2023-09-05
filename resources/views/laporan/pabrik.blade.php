@extends('layouts.home')
@section('title', 'Laporan Jasa Pabrik')
@section('header', 'Laporan Jasa Pabrik')
@section('menuopen0','menu-open')
@section('action1','active')
@section('action14','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Jasa Pabrik</li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;"></h3>
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
                <div class="row justify-content-between">
                    <div class="col-md-3 text-center">
                        <img src="../../img/pg.png" alt="Petrokimia Logo" width="140px" class="center">
                    </div>
                    <div class="col-md-6 mt-2">
                        <h4 class="m-0 text-center mb-4" style="font-weight: bold;">LAPORAN DEPARTEMEN PENGADAAN JASA <br>KOMPARTEMEN TEKNIK</h4>
                    </div>
                    <div class="col-md-3 text-center">
                        <img src="../../img/pi.png" alt="Pupuk Indonesia Logo" width="140px" class="center">
                    </div>
                </div>
                <div class="row justify-content-center bg-light mt-4 mb-5 pt-3 px-3 mx-0" style="border-radius: 5px;">
                    <div class="col-md-5">
                        <form action="{{route('laporan.pabrik')}}" method="GET">
                            <div class="form-group">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datetimepicker-input @error('tanggal_awal') is-invalid @enderror" value="{{$date_start}}" data-target="#reservationdate" placeholder="Tanggal Awal" name="tanggal_awal">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    @error('tanggal_awal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="col-md-5 text-left">
                        <div class="form-group">
                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                <input type="text" class="form-control form-control-sm datetimepicker-input @error('tanggal_akhir') is-invalid @enderror" value="{{$date_end}}" data-target="#reservationdate2" placeholder="Tanggal Akhir" name="tanggal_akhir">
                                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('tanggal_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-sm fa-search"></i></button>
                        <a href="{{route('laporan.pabrik')}}" class="btn btn-default btn-sm"><i class="fas fa-sm fa-sync-alt"></i></a>
                    </div>
                    </form>
                </div>
                <!-- ROW 1 -->
                <div class="row justify-content-start">
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-danger text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-calendar-minus"></i></h1>
                                <h5>{{$lead_time_all_po[0] ?? 0}} <span style="font-size: 15px">Hari</span></h5>
                                <h6 class="text-xs"> LEAD TIME PROCESS PR-PO</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-primary text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-calendar-minus"></i></h1>
                                <h5>{{$lead_time_po_eproc[0] ?? 0}} <span style="font-size: 15px">Hari</span></h5>
                                <h6 class="text-xs"> LEAD TIME PROCESS EPROC</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-dark text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-money-bill-wave"></i></h1>
                                <h5>@currency($total_efisiensi_pr_ok)</h5>
                                <h6 class="text-xs"> NILAI EFISIENSI PR-OK</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-warning text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-percentage"></i></h1>
                                <h5>{{$persen_efisiensi_pr_ok}}%</h5>
                                <h6 class="text-xs"> % EFISIENSI PR-OK</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Total Realisasi PR-PO (Item) -->
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Total Realisasi PR-PO (Item)</h3>
                <!-- tool -->
                <div class="card-tools" style="margin-top: 2px;">
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
                <!-- /tool -->
            </div>
            <div class="card-body" id="chart-1">
            </div>
        </div>
    </div>
</div>

<!-- Realisasi PR-PO (Item) -->
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Realisasi PR-PO (Item)</h3>
                <!-- tool -->
                <div class="card-tools" style="margin-top: 2px;">
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
                <!-- /tool -->
            </div>
            <div class="card-body" id="chart-2">
            </div>
        </div>
    </div>
</div>

<!-- Realisasi PR-PO (Item) Kumulatif -->
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Realisasi PR-PO (Item) Kumulatif</h3>
                <!-- tool -->
                <div class="card-tools" style="margin-top: 2px;">
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
                <!-- /tool -->
            </div>
            <div class="card-body" id="chart-3">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- OVERALL LEAD TIME PROCESS PR-PO (HARI) -->
    <div class="col-6">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Overall Lead Time Process PR-PO (Hari)</h3>
                <!-- tool -->
                <div class="card-tools" style="margin-top: 2px;">
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
                <!-- /tool -->
            </div>
            <div class="card-body" id="chart-4">
            </div>
        </div>
    </div>
    <!-- LEAD TIME PROCESS PR-PO SPOT (HARI) -->
    <div class="col-6">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Lead Time Process PR-PO Spot (Hari)</h3>
                <!-- tool -->
                <div class="card-tools" style="margin-top: 2px;">
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
                <!-- /tool -->
            </div>
            <div class="card-body" id="chart-5">
            </div>
        </div>
    </div>
</div>

<!-- REALISASI EPROC (ITEM) -->
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Realisasi EPROC (Item)</h3>
                <!-- tool -->
                <div class="card-tools" style="margin-top: 2px;">
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
                <!-- /tool -->
            </div>
            <div class="card-body" id="chart-6">
            </div>
        </div>
    </div>
</div>

<!-- LEAD TIME PROCESS PR-PO EPROC (HARI) -->
<div class="row">
    <div class="col-5">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Lead Time Process PR-PO EPROC (Hari)</h3>
                <!-- tool -->
                <div class="card-tools" style="margin-top: 2px;">
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
                <!-- /tool -->
            </div>
            <div class="card-body" id="chart-7">
            </div>
        </div>
    </div>
    <!-- LEAD TIME PROCESS PR-PO EPROC (HARI) -->
    <div class="col-7">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">PR Onprogress</h3>
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
                <table class="fixeds table table-sm table-bordered table-hover datatable2">
                    <thead>
                        <tr>
                            <th>NO. PR</th>
                            <th>URAIAN PEKERJAAN</th>
                            <th>STATUS</th>
                            <th>PROGRESS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pr_progress as $pr)
                        <tr>
                            <td>{{$pr->nomor_pr}}</td>
                            <td>{{$pr->uraian_pekerjaan}}</td>
                            <td>{{$pr->kontrak}}</td>
                            <td>{{$pr->progress}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    //1
    var options = {
        title: {
            text: 'Total Realisasi PR-PO (Item)',
            offsetY: 0,
            align: 'center',
        },
        subtitle: {
            text: 'Berdasarkan Tanggal SR',
            align: 'center',
        },
        series: [{
            name: 'Jumlah PR',
            data: <?php echo json_encode($item_pr) ?>,
            color: '#0099ff'
        }, {
            name: 'Jumlah PO',
            data: <?php echo json_encode($item_po) ?>,
            color: '#00ff00'
        }, ],
        chart: {
            type: 'bar',
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10,
                columnWidth: '10%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Jasa Pabrik'],

        },
        yaxis: {
            title: {
                text: 'Jumlah'
            },
            labels: {
                formatter: function(val) {
                    return Math.floor(val)
                }
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return val + " Item"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-1"), options);
    chart.render();

    //2
    var options = {
        title: {
            text: 'Realisasi PR-PO (Item), {{$tahun}}',
            offsetY: 0,
            align: 'center',
        },
        subtitle: {
            text: 'Berdasarkan Tahun',
            align: 'center',
        },
        series: [{
            name: 'Jumlah PR',
            data: <?php echo json_encode($data_pr) ?>,
            color: '#0099ff'
        }, {
            name: 'Jumlah PO',
            data: <?php echo json_encode($data_po) ?>,
            color: '#00ff00'
        }, ],
        chart: {
            type: 'bar',
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10,
                columnWidth: '70%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],

        },
        yaxis: {
            title: {
                text: 'Jumlah'
            },
            labels: {
                formatter: function(val) {
                    return Math.floor(val)
                }
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return val + " Item"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-2"), options);
    chart.render();

    //3
    var options = {
        series: [{
                name: "Jumlah PR",
                data: <?php echo json_encode($jumlah_pr_cumulative) ?>,
                color: '#0099ff'
            },
            {
                name: "Jumlah PO",
                data: <?php echo json_encode($jumlah_po_cumulative) ?>,
                color: '#00ff00'
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: true
        },
        title: {
            text: 'Realisasi PR-PO (Item) Kumulatif, {{$tahun}}',
            offsetY: 0,
            align: 'center'
        },
        subtitle: {
            text: 'Berdasarkan Tahun',
            align: 'center',
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        stroke: {
            curve: 'straight',
            width: 3,
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        },
        yaxis: {
            title: {
                text: 'Jumlah'
            },
            labels: {
                formatter: function(val) {
                    return Math.floor(val)
                }
            }
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return val + " Item"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-3"), options);
    chart.render();

    //4
    var options = {
        series: [{
            name: 'Waktu Proses',
            data: <?php echo json_encode($lead_time_overall) ?>,
            color: '#0099ff'
        }, ],
        legend: {
            show: true,
        },
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: true
        },
        title: {
            text: 'Overall Lead Time Process PR-PO (Hari)',
            offsetY: 0,
            align: 'center'
        },
        subtitle: {
            text: 'Berdasarkan Tanggal SR',
            align: 'center',
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        stroke: {
            curve: 'straight',
            width: 3,
        },
        xaxis: {
            categories: <?php echo json_encode($month_arr_overall_lead_time) ?>,
        },
        yaxis: {
            title: {
                text: 'Waktu Proses'
            },
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return val + " Hari"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-4"), options);
    chart.render();

    //5
    var options = {
        series: [{
            name: 'Waktu Proses',
            data: <?php echo json_encode($lead_time_spot) ?>,
            color: '#0099ff'
        }, ],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: true
        },
        title: {
            text: 'Lead Time Process PR-PO Spot (Hari)',
            offsetY: 0,
            align: 'center'
        },
        subtitle: {
            text: 'Berdasarkan Tanggal SR',
            align: 'center',
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        stroke: {
            curve: 'straight',
            width: 3,
        },
        xaxis: {
            categories: <?php echo json_encode($month_arr_spot_lead_time) ?>,
        },
        yaxis: {
            title: {
                text: 'Waktu Proses'
            },
            labels: {
                formatter: function(val) {
                    return Math.floor(val)
                }
            }
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return val + " Hari"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-5"), options);
    chart.render();

    //6
    var options = {
        title: {
            text: 'Realisasi EPROC (Item), {{$tahun}}',
            offsetY: 0,
            align: 'center',
        },
        subtitle: {
            text: 'Berdasarkan Tahun',
            align: 'center',
        },
        series: [{
            name: 'Jumlah PR',
            data: <?php echo json_encode($data_pr_spot) ?>,
            color: '#0099ff'
        }, {
            name: 'Jumlah EPROC',
            data: <?php echo json_encode($data_po_eproc) ?>,
            color: '#00ff00'
        }, ],
        chart: {
            type: 'bar',
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10,
                columnWidth: '70%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],

        },
        yaxis: {
            title: {
                text: 'Jumlah'
            },
            labels: {
                formatter: function(val) {
                    return Math.floor(val)
                }
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return val + " Item"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-6"), options);
    chart.render();

    //7
    var options = {
        series: [{
            name: 'Waktu Proses',
            data: <?php echo json_encode($lead_time_eproc) ?>,
            color: '#0099ff'
        }, ],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: true
        },
        title: {
            text: 'Lead Time Process PR-PO EPROC (Hari)',
            offsetY: 0,
            align: 'center'
        },
        subtitle: {
            text: 'Berdasarkan Tanggal SR',
            align: 'center',
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        stroke: {
            curve: 'straight',
            width: 3,
        },
        xaxis: {
            categories: <?php echo json_encode($month_arr_eproc_lead_time) ?>,
        },
        yaxis: {
            title: {
                text: 'Waktu Proses'
            },
            labels: {
                formatter: function(val) {
                    return Math.floor(val)
                }
            }
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return val + " Hari"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-7"), options);
    chart.render();
</script>
@endpush