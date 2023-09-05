@extends('layouts.home')
@section('title', 'Pengadaan Jasa')
@section('header', 'Pengadaan Jasa')
@section('menuopen0','menu-open')
@section('action1','active')
@section('action11','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Pengadaan Jasa</li>
</ol>
@endsection
@section('content')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table thead .center {
        font-size: smaller;
    }

    table tfoot th {
        font-size: smaller;

    }

    td {
        font-size: smaller;
        vertical-align: middle;
    }

    .highcharts-root {
        font-family: 'Arial Black';
    }
</style>
<!-- Realisasi PR-PO (Item)-->
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
                        <form action="{{route('laporan.jasa')}}" method="GET">
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
                        <a href="{{route('laporan.jasa')}}" class="btn btn-default btn-sm"><i class="fas fa-sync-alt fa-sm"></i></a>
                    </div>
                    </form>
                </div>

                <!-- ROW 1 -->
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <div class="card card-hover rounded">
                            <div class="bg-danger text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-money-bill-wave"></i></h1>
                                <h5>@currency($total_po_bumn)</h5>
                                <h6 class="text-xs">TOTAL NILAI PO SINERGI BUMN</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover rounded">
                            <div class="bg-primary text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-money-bill-wave"></i></h1>
                                <h5>@currency($total_po_pi)</h5>
                                <h6 class="text-xs">TOTAL NILAI PO SINERGI PI GROUP
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover rounded">
                            <div class="bg-warning text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-money-bill-wave"></i></h1>
                                <h5>@currency($total_po_pg)</h5>
                                <h6 class="text-xs">TOTAL NILAI PO SINERGI PG GROUP</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW 2 -->
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <div class="card card-hover rounded">
                            <div class="bg-success text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-money-bill-wave"></i></h1>
                                <h5>@currency($realisasi_po_padi_umkm)</h5>
                                <h6 class="text-xs"> REALISASI NILAI PO PENGADAAN JASA PADI UMKM</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-hover rounded">
                            <div class="bg-info text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-percentage"></i></h1>
                                <h5>{{$persen_realisasi_po_padi_umkm ?? 0}}%</h5>
                                <h6 class="text-xs"> % REALISASI PADI UMKM TERHADAP KPI CORPORATE</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW 3 -->
                <div class="row justify-content-start">
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-dark text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$item_pr}}</h5>
                                <h6 class="text-xs"> TOTAL ITEM PR</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-primary text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$item_po}}</h5>
                                <h6 class="text-xs"> TOTAL ITEM PO</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-secondary text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-percentage"></i></h1>
                                <h5>{{$persen_item_pr_ok ?? 0}}%</h5>
                                <h6 class="text-xs"> % ITEM PR - OK</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-warning text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-calendar-minus"></i></h1>
                                <h5>{{$lead_time_all_po[0] ?? 0}} <span style="font-size: 15px">Hari</span></h5>
                                <h6 class="text-xs"> LEAD TIME ALL PROCESS PO</h6>
                            </div>
                        </div>
                    </div>
                    <!-- ROW 4 -->
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-warning text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-calendar-minus"></i></h1>
                                <h5>{{$lead_time_po_non_kontrak[0] ?? 0}} <span style="font-size: 15px">Hari</span></h5>
                                <h6 class="text-xs"> LEAD TIME PROCESS PO NON KONTRAK</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-danger text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-money-bill-wave"></i></h1>
                                <h5>@currency($total_nilai_po)</h5>
                                <h6 class="text-xs"> TOTAL NILAI PO</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-info text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-money-bill-wave"></i></h1>
                                <h5>@currency($total_efisiensi_pr_ok)</h5>
                                <h6 class="text-xs"> NILAI EFISIENSI PR-OK</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-dark text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-percentage"></i></h1>
                                <h5>{{$persen_efisiensi_pr_ok}}%</h5>
                                <h6 class="text-xs"> % EFISIENSI PR-OK</h6>
                            </div>
                        </div>
                    </div>
                    <!-- ROW 5 -->
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-success text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$item_pr_no_sp}} <span style="font-size: 15px">Hari</span></h5>
                                <h6 class="text-xs">ITEM PR (NON SP)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-secondary text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$item_po_no_sp}}</h5>
                                <h6 class="text-xs"> ITEM PO (NON SP)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-primary text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-list-alt"></i></h1>
                                <h5>{{$item_po_no_sp_eproc}}</h5>
                                <h6 class="text-xs"> ITEM PO EPROC</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-hover rounded">
                            <div class="bg-danger text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-percentage"></i></h1>
                                <h5>{{$persen_item_po_no_sp_eproc}}%</h5>
                                <h6 class="text-xs"> % ITEM PO EPROC</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW 6 -->
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <div class="card card-hover rounded">
                            <div class="bg-primary text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-calendar-minus"></i></h1>
                                <h5>{{$lead_time_po_eproc[0] ?? 0}} <span style="font-size: 15px">Hari</span></h5>
                                <h6 class="text-xs"> LEAD TIME PROCESS PO EPROC</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-hover rounded">
                            <div class="bg-danger text-center py-3 px-1">
                                <h1><i class="fas fa-xs fa-money-bill-wave"></i></h1>
                                <h5>@currency($nilai_po_eproc)</h5>
                                <h6 class="text-xs"> NILAI PO EPROC</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Tabel Bagian-->
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">PR-PO Bagian</h3>
                <!-- tool -->
                <div class="card-tools" style="margin-top: 2px;">
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
                <!-- /tool -->
            </div>
            <div class="card-body p-0">
                <table id="users-table" class="table table-sm table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="center">NO.</th>
                            <th class="center" style="width: 13%;">BAGIAN</th>
                            <th class="center">JUMLAH PR</th>
                            <th class="center">JUMLAH PO</th>
                            <th class="center">PR KONTRAK</th>
                            <th class="center">PO KONTRAK</th>
                            <th class="center">PR NON KONTRAK (INDUK)</th>
                            <th class="center">PO NON KONTRAK (INDUK)</th>
                            <th class="center">PR NON KONTRAK (SPOT)</th>
                            <th class="center">PO NON KONTRAK (SPOT)</th>
                            <th class="center">STATUS BLANK</th>
                            <th class="center">PR ONPROGRESS</th>
                            <th class="center" style="width: 13%;">NILAI PO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1 -->
                        <tr>
                            <td align="center">1</td>
                            <td align="center">Jasa Pabrik</td>
                            <td align="center">{{$item_pr_pabrik}}</td>
                            <td align="center">{{$item_po_pabrik}}</td>
                            <td align="center">{{$item_pr_pabrik_kontrak}}</td>
                            <td align="center">{{$item_po_pabrik_kontrak}}</td>
                            <td align="center">{{$item_pr_pabrik_non_kontrak_induk}}</td>
                            <td align="center">{{$item_po_pabrik_non_kontrak_induk}}</td>
                            <td align="center">{{$item_pr_pabrik_non_kontrak_spot}}</td>
                            <td align="center">{{$item_po_pabrik_non_kontrak_spot}}</td>
                            <td align="center">{{$status_blank_pabrik}}</td>
                            <td align="center">{{$pr_on_progress_pabrik}}</td>
                            <td align="center">@currency($nilai_po_pabrik)</td>
                        </tr>

                        <!-- 2 -->
                        <tr>
                            <td align="center">2</td>
                            <td align="center">Jasa Non Pabrik</td>
                            <td align="center">{{$item_pr_nonpabrik}}</td>
                            <td align="center">{{$item_po_nonpabrik}}</td>
                            <td align="center">{{$item_pr_nonpabrik_kontrak}}</td>
                            <td align="center">{{$item_po_nonpabrik_kontrak}}</td>
                            <td align="center">{{$item_pr_nonpabrik_non_kontrak_induk}}</td>
                            <td align="center">{{$item_po_nonpabrik_non_kontrak_induk}}</td>
                            <td align="center">{{$item_pr_nonpabrik_non_kontrak_spot}}</td>
                            <td align="center">{{$item_po_nonpabrik_non_kontrak_spot}}</td>
                            <td align="center">{{$status_blank_nonpabrik}}</td>
                            <td align="center">{{$pr_on_progress_nonpabrik}}</td>
                            <td align="center">@currency($nilai_po_nonpabrik)</td>
                        </tr>

                        <!-- 3 -->
                        <tr>
                            <td align="center">3</td>
                            <td align="center">Jasa Investasi EPC</td>
                            <td align="center">{{$item_pr_investasiepc}}</td>
                            <td align="center">{{$item_po_investasiepc}}</td>
                            <td align="center">{{$item_pr_investasiepc_kontrak}}</td>
                            <td align="center">{{$item_po_investasiepc_kontrak}}</td>
                            <td align="center">{{$item_pr_investasiepc_non_kontrak_induk}}</td>
                            <td align="center">{{$item_po_investasiepc_non_kontrak_induk}}</td>
                            <td align="center">{{$item_pr_investasiepc_non_kontrak_spot}}</td>
                            <td align="center">{{$item_po_investasiepc_non_kontrak_spot}}</td>
                            <td align="center">{{$status_blank_investasiepc}}</td>
                            <td align="center">{{$pr_on_progress_investasiepc}}</td>
                            <td align="center">@currency($nilai_po_investasiepc)</td>
                        </tr>

                        <!-- 4 -->
                        <tr>
                            <td align="center">4</td>
                            <td align="center">Jasa Distribusi & Pemasaran</td>
                            <td align="center">{{$item_pr_distribusipemasaran}}</td>
                            <td align="center">{{$item_po_distribusipemasaran}}</td>
                            <td align="center">{{$item_pr_distribusipemasaran_kontrak}}</td>
                            <td align="center">{{$item_po_distribusipemasaran_kontrak}}</td>
                            <td align="center">{{$item_pr_distribusipemasaran_non_kontrak_induk}}</td>
                            <td align="center">{{$item_po_distribusipemasaran_non_kontrak_induk}}</td>
                            <td align="center">{{$item_pr_distribusipemasaran_non_kontrak_spot}}</td>
                            <td align="center">{{$item_po_distribusipemasaran_non_kontrak_spot}}</td>
                            <td align="center">{{$status_blank_distribusipemasaran}}</td>
                            <td align="center">{{$pr_on_progress_distribusipemasaran}}</td>
                            <td align="center">@currency($nilai_po_distribusipemasaran)</td>
                        </tr>

                        <!-- 5 -->
                        <tr>
                            <td align="center">5</td>
                            <td align="center">Belum Terproses</td>
                            <td align="center">{{$item_pr_belumterproses}}</td>
                            <td align="center">{{$item_po_belumterproses}}</td>
                            <td align="center">{{$item_pr_belumterproses_kontrak}}</td>
                            <td align="center">{{$item_po_belumterproses_kontrak}}</td>
                            <td align="center">{{$item_pr_belumterproses_non_kontrak_induk}}</td>
                            <td align="center">{{$item_po_belumterproses_non_kontrak_induk}}</td>
                            <td align="center">{{$item_pr_belumterproses_non_kontrak_spot}}</td>
                            <td align="center">{{$item_po_belumterproses_non_kontrak_spot}}</td>
                            <td align="center">{{$status_blank_belumterproses}}</td>
                            <td align="center">{{$pr_on_progress_belumterproses}}</td>
                            <td align="center">@currency($nilai_po_belumterproses)</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="center"></th>
                            <th class="center">Total Keseluruhan</th>
                            <th class="center">{{$item_pr_keseluruhan}}</th>
                            <th class="center">{{$item_po_keseluruhan}}</th>
                            <th class="center">{{$item_pr_keseluruhan_kontrak}}</th>
                            <th class="center">{{$item_po_keseluruhan_kontrak}}</th>
                            <th class="center">{{$item_pr_keseluruhan_non_kontrak_induk}}</th>
                            <th class="center">{{$item_po_keseluruhan_non_kontrak_induk}}</th>
                            <th class="center">{{$item_pr_keseluruhan_non_kontrak_spot}}</th>
                            <th class="center">{{$item_po_keseluruhan_non_kontrak_spot}}</th>
                            <th class="center">{{$status_blank_keseluruhan}}</th>
                            <th class="center">{{$pr_on_progress_keseluruhan}}</th>
                            <th class="center">@currency($nilai_po_keseluruhan)</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Realisasi PR-PO (Item)-->
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
            <div class="card-body" id="chart">
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
            <div class="card-body" id="chart-2">
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
            <div class="card-body" id="chart-3">
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
            <div class="card-body" id="chart-4">
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
            <div class="card-body" id="chart-5">
            </div>
        </div>
    </div>
</div>


<!-- LEAD TIME PROCESS PR-PO EPROC (HARI) -->
<div class="row">
    <div class="col-12">
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

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    //2
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

    var chart = new ApexCharts(document.querySelector("#chart-2"), options);
    chart.render();


    //3
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

    var chart = new ApexCharts(document.querySelector("#chart-3"), options);
    chart.render();

    //4
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

    var chart = new ApexCharts(document.querySelector("#chart-4"), options);
    chart.render();

    //5
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

    var chart = new ApexCharts(document.querySelector("#chart-5"), options);
    chart.render();

    //6
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

    var chart = new ApexCharts(document.querySelector("#chart-6"), options);
    chart.render();
</script>
@endpush