@extends('layouts.home')
@section('title', 'Import Proses Tender')
@section('header', 'Import Proses Tender')
@section('menuopen6','menu-open')
@section('action42','active')
@section('action4','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">Import Proses Tender</li>
</ol>
@endsection
@section('content')
<style>
    table tfoot th {
        background-color: #f1f1f1;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">History Import Proses Tender</h3>
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
                        <a href="#" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#add"><span style="font-weight:bolder">Import Proses Tender</span></a>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" class="btn btn-danger btn-sm" value="ClearFilters" onclick="ClearFilters()"><span style="font-weight:bolder">Clear Filters</span></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-hover datatable table-bordered table-sm table-hide-overflow">
                        <thead>
                            <tr>
                                <th class="center" style="width: 5%">No.</th>
                                <th class="center" style="width: 55%">File</th>
                                <th class="center" style="width: 16%">Created By</th>
                                <th class="center" style="width: 16%">Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($importpo as $import)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td><a href="{{route('po_file_download', ['importpo' => $import->id])}}">{{$import->file}}</a></td>
                                <td>{{$import->created_by}}</td>
                                <td align="center">{{\Carbon\Carbon::parse($import->created_at)->format('d/m/Y H:i:s')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>File</th>
                                <th>Created By</th>
                                <th>Tanggal</th>
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
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Import Proses Tender</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('import_po')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body py-2 px-0" style="background-color: #f4f6f9;">
                    <div class="row flex-column mr-3 ml-3">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm" for="file">File Proses Tender<span class="required">*</span></label>
                            <div class="custom-file">
                                <input name="file" type="file" class="custom-file-input  @error('file') is-invalid @enderror" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                            <span style="font-size: smaller;"> Tipe File : <span style="font-weight: lighter;">XLS, XLSX</span></span>
                            @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer pt-2 pb-0" style="background-color: #f4f6f9;">
                        <div class="row w-100">
                            <div class="col-12 d-flex justify-content-end pr-0">
                                <a href="{{asset('/file/Import_Tender.xlsx')}}" class="btn btn-primary btn-sm mr-1"><span style="font-weight:bolder">Download Template</span></a>
                                <button type="button" class="btn btn-danger btn-sm mr-1" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Submit</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#inputGroupFile01').on('change', function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@if(count($errors) > 0)
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif
@endpush