@extends('layouts.home')
@section('title', 'Daftar Item Progress')
@section('header', 'Daftar Item Progress')
@section('menuopen2','menu-open')
@section('action5','active')
@section('action51','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Daftar Item Progress</li>
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
                <h3 class="card-title" style="font-size: 15px; font-weight:bolder;">Daftar Item Progress</h3>
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
                        <a href="#" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#add"><span style="font-weight:bolder"> Tambah Item Progress</span></a>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#log"><span style="font-weight:bolder"> Log History <span></a>
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder"> Clear Filters</span></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-hover datatable table-bordered table-sm table-hide-overflow">
                        <thead>
                            <tr>
                                <th class="center" style="width: 5%">No.</th>
                                <th class="center" style="width: 30%">Item Progress</th>
                                <th class="center" style="width: 20%">Last Updated by</th>
                                <th class="center" style="width: 16%">Tanggal Dibuat</th>
                                <th class="center" style="width: 16%">Tanggal Diubah</th>
                                <th class="center" style="width: 13%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($progress as $prog)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td>{{$prog->progress ?? '-'}}</td>
                                <td>{{$prog->last_updated_by}}</td>
                                @if(isset($prog->created_at))
                                <td align="center">{{\Carbon\Carbon::parse($prog->created_at)->format('d/m/Y H:i:s')}}</td>
                                @else
                                <td></td>
                                @endif
                                @if(isset($prog->updated_at))
                                <td align="center">{{\Carbon\Carbon::parse($prog->updated_at)->format('d/m/Y H:i:s')}}</td>
                                @else
                                <td></td>
                                @endif
                                <td align="center">
                                    <div class="row justify-content-md-center">
                                        @if($prog->progress == 'Belum Diproses' || $prog->progress == 'Diterima' || $prog->progress == 'OK' || $prog->progress == 'SP' || $prog->progress == 'Agreement')
                                        <a class="btn btn-dark btn-xs"><span style="font-size:smaller; font-weight:bolder"> No Action</span></a>
                                        @else
                                        <a href="#" class="btn btn-warning btn-xs mr-1" data-toggle="modal" data-target="#edit" data-id="{{$prog->id}}" data-progress="{{$prog->progress}}"><span style="font-size:smaller; font-weight:bolder"> Edit</span></a>
                                        <button type="button" class="btn btn-xs btn-danger hapus" data-toggle="modal" data-id='{{$prog->id}}' data-target="#hapus"><span style="font-size:smaller; font-weight:bolder"> Hapus</span></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Item Progress</th>
                                <th>Last Updated by</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Diubah</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- LOG -->
<div class="modal fade" id="log" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Log History</h5>
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
                                <th class="center" style="width: 5%;">Diproses Oleh</th>
                                <th class="center" style="width: 70%;">Keterangan Aktivitas</th>
                                <th class="center" style="width: 15%;">Tanggal</th>
                                <th class="center" style="width: 10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users_log as $log)
                            <tr>
                                <td>{{$log->user->name}}</td>
                                <td>{{$log->description}}</td>
                                <td align="center">{{\Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i:s')}}</td>
                                <td align="center">{{Carbon\Carbon::parse($log->created_at)->diffForHumans()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Diproses Oleh</th>
                                <th>Keterangan Aktivitas</th>
                                <th>Tanggal</th>
                                <th></th>
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
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah Item Progress</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('progress.store')}}" method="POST">
                <div class="modal-body py-2" style="background-color: #f4f6f9;">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="progress_add">Progress<span class="required">*</span></label>
                        <input type="text" class="form-control @error('progress_add') is-invalid @enderror" value="{{old('progress_add')}}" id="progress_add" placeholder="Progress" name="progress_add">
                        @error('progress_add')
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

<!-- EDIT -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #001f3f; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Edit Item Progress</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('progress.update')}}" method="POST">
                <div class="modal-body py-2" style="background-color: #f4f6f9;">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" id="id" value="{{old('id')}}">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="progress">Progress<span class="required">*</span></label>
                        <input type="text" class="form-control @error('progress') is-invalid @enderror" value="{{old('progress')}}" id="progress" placeholder="Progress" name="progress">
                        @error('progress')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer py-2" style="background-color: #f4f6f9;">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                    <button type="submit" class="btn btn-success btn-sm""><span style="font-weight:bolder">Simpan</span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- HAPUS -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545; color: white;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Konfirmasi Hapus</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
            <form action="{{route('progress.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_hapus" name="id">
                    Apakah Anda Yakin Ingin Menghapus Item Progress Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Hapus<span></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@if($errors->has('progress_add'))
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif

@if($errors->has('progress'))
<script type="text/javascript">
    $('#edit').modal('show');
</script>
@endif

<script>
    $('#edit').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)
        var id = button.data('id')
        var progress = button.data('progress')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #progress').val(progress);
    })
</script>

<script>
    $(document).on('click', '.hapus', function() {
        let id = $(this).attr('data-id');
        $('#id_hapus').val(id);
    });
</script>
@endpush