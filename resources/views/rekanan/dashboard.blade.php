@extends('layouts.home')
@section('title', 'Dashboard Rekanan')
@section('header', 'Dashboard Rekanan')
@section('menuopen0','menu-open')
@section('action1','active')
@section('action16','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard Rekanan</li>
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
                        <form action="{{route('rekanan.dashboard')}}" method="GET">
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
                        <a href="{{route('rekanan.dashboard')}}" class="btn btn-default btn-sm"><i class="fas fa-sm fa-sync-alt"></i></a>
                    </div>
                    </form>
                </div>
                <!-- ROW 1 -->
                <div class="row justify-content-start">
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-danger text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$vendor}}</h5>
                                <h6 class="text-xs"> JUMLAH REKANAN</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-primary text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$jumlah_rekanan_baru}}</h5>
                                <h6 class="text-xs">JUMLAH REKANAN BARU</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-dark text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$jumlah_rekanan_terdaftar}}</h5>
                                <h6 class="text-xs">JUMLAH REKANAN SUDAH TERDAFTAR</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-warning text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$jumlah_rekanan_onprogress}}</h5>
                                <h6 class="text-xs"> ONPROGRESS</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jumlah Rekanan Baru -->
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Jumlah Rekanan Baru</h3>
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
<!-- Tabel Rekanan Baru -->
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Tabel Rekanan Baru</h3>
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
                <a href="#" class="btn btn-primary btn-sm mb-3 text-right" data-toggle="modal" data-target="#cek"><span style="font-weight:bolder">Daftar Sos</span></a>
                <table class="fixeds table table-sm table-bordered table-hover datatable2 w-100">
                    <thead>
                        <tr>
                            <th>Nama Rekanan</th>
                            <th>Tipe</th>
                            <th>Kode Rekanan</th>
                            <th>Kode SAP</th>
                            <th>Alamat</th>
                            <th>SoS Barang</th>
                            <th>SoS Jasa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekanan_tabel as $rekanan)
                        <tr>
                            <td>{{$rekanan->nama_rekanan}}</td>
                            <td>{{$rekanan->tipe_perusahaan}}</td>
                            <td>{{$rekanan->kode_rekanan}}</td>
                            <td>{{$rekanan->kode_sap}}</td>
                            <td>{{$rekanan->alamat}}</td>
                            <td>{{$rekanan->no_sos_barang}}</td>
                            <td>{{$rekanan->no_sos_jasa}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SoS -->
<div class="modal fade" id="cek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Daftar SoS</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="table-responsive" style="width: 100%;">
                    <table class="table table-hover datatable table-bordered table-sm table-hide-overflow" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="center" style="width: 10%">No.</th>
                                <th class="center" style="width: 30%">Deskripsi</th>
                                <th class="center" style="width: 10%">Kode SoS</th>
                                <th class="center" style="width: 50%">Deskripsi SoS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sos as $so)
                            <tr>
                                <td>{{$so->loop_iteration}}</td>
                                <td>{{$so->deskripsi}}</td>
                                <td>{{$so->kode_sos}}</td>
                                <td>{{$so->deskripsi_sos}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Deskripsi</th>
                                <th>Kode SoS</th>
                                <th>Deskripsi SoS</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Status Rekanan -->
    <div class="col-4">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Status Rekanan</h3>
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
    <!-- Rekanan Suspend -->
    <div class="col-md-4">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Rekanan Suspend</h3>
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
    <!-- Rekanan Blacklist -->
    <div class="col-4">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Rekanan Blacklist</h3>
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
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    //1
    var options = {
        series: [{
            name: 'Nama Rekanan',
            data: <?php echo json_encode($grafik_rekanan_baru) ?>,
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
            text: 'Jumlah Rekanan Baru',
            offsetY: 0,
            align: 'center'
        },
        subtitle: {
            text: 'Berdasarkan Periode',
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
            categories: <?php echo json_encode($month_arr_rekanan) ?>,
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
                    return val + " Rekanan"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-1"), options);
    chart.render();

    //2
    var options = {
        title: {
            text: 'Status Rekanan',
            offsetY: 0,
            align: 'center',
        },
        series: [{
            name: 'Aktif',
            data: <?php echo json_encode($aktif) ?>,
            color: '#0f9e3e'
        }, {
            name: 'Tidak Aktif',
            data: <?php echo json_encode($nonaktif) ?>,
            color: '#ff2322'
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
            categories: ['Status'],

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
        title: {
            text: 'Rekanan Suspend',
            offsetY: 0,
            align: 'center',
        },
        series: [{
            name: 'Suspend',
            data: <?php echo json_encode($suspend) ?>,
            color: '#ff9700'
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
            categories: <?php echo json_encode($tahun) ?>,

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

    var chart = new ApexCharts(document.querySelector("#chart-3"), options);
    chart.render();

    //4
    var options = {
        title: {
            text: 'Rekanan Blacklist',
            offsetY: 0,
            align: 'center',
        },
        series: [{
            name: 'Suspend',
            data: <?php echo json_encode($blacklist) ?>,
            color: '#000000'
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
            categories: <?php echo json_encode($year) ?>,

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

    var chart = new ApexCharts(document.querySelector("#chart-4"), options);
    chart.render();
</script>
@endpush