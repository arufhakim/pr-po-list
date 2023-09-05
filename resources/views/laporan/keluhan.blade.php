@extends('layouts.home')
@section('title', 'Dashboard Keluhan Rekanan')
@section('header', 'Dashboard Keluhan Rekanan')
@section('action7','active')
@section('action75','active')
@section('menuopen3','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('keluhan.index')}}">Dashboard Keluhan Rekanan</a></li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Tambah Keluhan</h3>
                <!-- tool -->
                <div class="card-tools" style="margin-top: 2px;">
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
                <!-- /tool -->
            </div>
            <div class="card-body" id="chart">

            </div>  
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        title: {
            text: 'Realisasi PR-PO (Item), 2002',
            offsetY: 0,
            align: 'center',
        },
        series: [{
            name: 'Jumlah PR',
            data: <?php echo json_encode($data_pr) ?>,
        }, {
            name: 'Jumlah PO',
            data: <?php echo json_encode($data_po) ?>,
        }, ],
        chart: {
            type: 'bar',
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10,
                columnWidth: '60%',
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
            categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],

        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function(val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endpush