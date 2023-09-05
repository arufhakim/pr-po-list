@extends('layouts.home')
@section('title', 'Daftar User')
@section('header', 'Daftar User')
@section('menuopen','menu-open')
@section('action3','active')
@section('action30','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Daftar User</li>
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
                <h3 class="card-title" style="font-size: 15px; font-weight:bolder;">Daftar User</h3>
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
                        <a href="#" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#add"><span style="font-weight:bolder">Tambah User</span></a>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#log"><span style="font-weight:bolder"> Log History <span></a>
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder">Clear Filters</span></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-hover datatable table-bordered table-sm table-hide-overflow">
                        <thead>
                            <tr>
                                <th class="center" style="width: 5%">No.</th>
                                <th class="center" style="width: 30%">User</th>
                                <th class="center" style="width: 20%">Last Updated by</th>
                                <th class="center" style="width: 16%">Tanggal Dibuat</th>
                                <th class="center" style="width: 16%">Tanggal Diubah</th>
                                <th class="center" style="width: 13%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unit as $un)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td>{{$un->unit ?? '-'}}</td>
                                <td>{{$un->last_updated_by ?? '-'}}</td>
                                @if(isset($un->created_at))
                                <td align="center">{{\Carbon\Carbon::parse($un->created_at)->format('d/m/Y H:i:s')}}</td>
                                @else
                                <td></td>
                                @endif
                                @if(isset($un->updated_at))
                                <td align="center">{{\Carbon\Carbon::parse($un->updated_at)->format('d/m/Y H:i:s')}}</td>
                                @else
                                <td></td>
                                @endif
                                <td align="center">
                                    <div class="row justify-content-md-center">
                                        <a href="#" class="btn btn-warning btn-xs mr-1" data-toggle="modal" data-target="#edit" data-id="{{$un->id}}" data-unit="{{$un->unit}}"><span style="font-size:smaller; font-weight:bolder"> Edit</span></a>
                                        <button type="button" class="btn btn-xs btn-danger hapus" data-toggle="modal" data-id='{{$un->id}}' data-target="#hapus"><span style="font-size:smaller; font-weight:bolder"> Hapus</span></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>User</th>
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
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah User</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('unit.store')}}" method="POST">
                <div class="modal-body py-2" style="background-color: #f4f6f9;">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="unit_add">User<span class="required">*</span></label>
                        <input type="text" class="form-control @error('unit_add') is-invalid @enderror" value="{{old('unit_add')}}" id="unit_add" placeholder="Nama User" name="unit_add">
                        @error('unit_add')
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
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Edit User</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('unit.update')}}" method="POST">
                <div class="modal-body py-2" style="background-color: #f4f6f9;">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" id="id" value="{{old('id')}}">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="unit">User<span class="required">*</span></label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" value="{{old('unit')}}" id="unit" placeholder="Nama User" name="unit">
                        @error('unit')
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
                <form action="{{route('unit.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_hapus" name="id">
                    Apakah Anda Yakin Ingin Menghapus User Berikut?
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

@if($errors->has('unit_add'))
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif

@if($errors->has('unit'))
<script type="text/javascript">
    $('#edit').modal('show');
</script>
@endif

<script>
    $('#edit').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)
        var id = button.data('id')
        var unit = button.data('unit')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #unit').val(unit);
    })
</script>

<script>
    $(document).on('click', '.hapus', function() {
        let id = $(this).attr('data-id');
        $('#id_hapus').val(id);
    });
</script>
@endpush