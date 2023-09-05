@extends('layouts.home')
@section('title', 'Pelayanan Rekanan')
@section('header', 'Pelayanan Rekanan')
@section('menuopen0','menu-open')
@section('action1','active')
@section('action17','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Pelayanan Rekanan</li>
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
                        <form action="{{route('rekanan.pelayanan')}}" method="GET">
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
                        <a href="{{route('rekanan.pelayanan')}}" class="btn btn-default btn-sm"><i class="fas fa-sm fa-sync-alt"></i></a>
                    </div>
                    </form>
                </div>
                <!-- ROW 1 -->
                <div class="row justify-content-start">
                    <div class="col-md-4">
                        <div class="card card-hover rounded">
                            <div class="bg-danger text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$total_penyampaian}}</h5>
                                <h6 class="text-xs"> TOTAL PENYAMPAIAN</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover rounded">
                            <div class="bg-primary text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$total_pelayanan}}</h5>
                                <h6 class="text-xs">TOTAL PELAYANAN</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover rounded">
                            <div class="bg-dark text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$total_keluhan}}</h5>
                                <h6 class="text-xs"> TOTAL KELUHAN</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Jumlah Pelayanan -->
    <div class="col-7">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Jumlah Pelayanan</h3>
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
    <!-- Kategori Pelayanan Rekanan -->
    <div class="col-md-5">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Kategori Pelayanan Rekanan</h3>
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
<div class="row">
    <!-- Jumlah Keluhan -->
    <div class="col-7">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Jumlah Keluhan</h3>
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
    <!-- Kategori Keluhan Rekanan -->
    <div class="col-md-5">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Kategori Keluhan Rekanan</h3>
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
</div>
<div class="row">
    <!-- Media Penyimpanan -->
    <div class="col-5">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Media Penyampaian</h3>
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
    <!-- Jumlah Penyampaian -->
    <div class="col-md-7">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Jumlah Penyampaian</h3>
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
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    //1
    var options = {
        series: [{
            name: 'Pelayanan',
            data: <?php echo json_encode($pelayanan_grafik) ?>,
            color: '#20c997'
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
            text: 'Jumlah Pelayanan',
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
            curve: 'smooth',
        },
        xaxis: {
            categories: <?php echo json_encode($month_arr_pelayanan) ?>,
        },
        yaxis: {
            title: {
                text: 'Jumlah'
            },
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return val + " Pelayanan"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-1"), options);
    chart.render();

    //2
    var options = {
        title: {
            text: 'Kategori Pelayanan Rekanan',
            offsetY: 0,
            align: 'center',
        },
        series: [{
            name: 'Kategori Pelayanan',
            data: <?php echo json_encode($pelayanan_tahun_data) ?>,
            color: '#20c997'
        }, ],
        chart: {
            type: 'bar',
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: true,
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
            categories: <?php echo json_encode($pelayanan_tahun) ?>,
            labels: {
                formatter: function(val) {
                    return Math.floor(val)
                }
            }
        },
        yaxis: {
            title: {
                text: 'Jumlah'
            },
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            shared: false,
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-2"), options);
    chart.render();

    //3
    var options = {
        series: [{
            name: 'Keluhan',
            data: <?php echo json_encode($keluhan_grafik) ?>,
            color: '#ffc107'
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
            text: 'Jumlah Keluhan',
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
            curve: 'smooth',
        },
        xaxis: {
            categories: <?php echo json_encode($month_arr_keluhan) ?>,
        },
        yaxis: {
            title: {
                text: 'Jumlah'
            },
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return val + " Keluhan"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-3"), options);
    chart.render();

    //4
    var options = {
        title: {
            text: 'Kategori Keluhan Rekanan',
            offsetY: 0,
            align: 'center',
        },
        series: [{
            name: 'Kategori Keluhan',
            data: <?php echo json_encode($keluhan_tahun_data) ?>,
            color: '#ffc107'
        }, ],
        chart: {
            type: 'bar',
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: true,
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
            categories: <?php echo json_encode($keluhan_tahun) ?>,
            labels: {
                formatter: function(val) {
                    return Math.floor(val)
                }
            }
        },
        yaxis: {
            title: {
                text: 'Jumlah'
            },
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            shared: false,
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-4"), options);
    chart.render();

    //5
    var options = {
        series: <?php echo json_encode($media_count) ?>,
        chart: {
            width: 380,
            type: 'pie',
        },
        labels: <?php echo json_encode($media_kat) ?>,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart-5"), options);
    chart.render();

    //6
    var options = {
        title: {
            text: 'Jumlah Penyampaian',
            offsetY: 0,
            align: 'center',
        },
        series: [{
            name: 'Jumlah Penyampaian',
            data: <?php echo json_encode($rekanan_gb_count) ?>,
            color: '#6c757d'
        }, ],
        chart: {
            type: 'bar',
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: true,
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
            categories: <?php echo json_encode($rekanan_gb) ?>,
            labels: {
                formatter: function(val) {
                    return Math.floor(val)
                }
            }
        },
        yaxis: {
            title: {
                text: 'Jumlah'
            },
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            shared: false,
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-6"), options);
    chart.render();
</script>
@endpush