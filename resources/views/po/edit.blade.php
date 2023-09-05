@extends('layouts.home')
@section('title', 'Daftar Purchase Order (PO)')
@section('header', 'Daftar Purchase Order (PO)')
@section('menuopen6','menu-open')
@section('action41','active')
@section('action4','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('po.index')}}">Daftar Purchase Order (PO)</a></li>
    <li class="breadcrumb-item"><a href="{{route('po.show', ['po' => $po->pr_id])}}">Detail PR & PO</a></li>
    <li class="breadcrumb-item active">Edit Purchase Order (PO)</li>
</ol>
@endsection
@section('content')
<div class="row">
    @include('alert')
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Edit Purchase Order (PO)</h3>
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
                <form action="{{route('po.update', ['po' => $po->id])}}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_terima_pr">Tanggal Terima PR<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datetimepicker-input @error('tanggal_terima_pr') is-invalid @enderror" value="{{old('tanggal_terima_pr') ?? $po->tanggal_terima_pr}}" data-target="#reservationdate" placeholder="Tanggal Terima PR" name="tanggal_terima_pr">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('tanggal_terima_pr')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="eprocsap">EPROC/SAP</label>
                                <div class="col-md-10">
                                    <select id="eprocsap" name="eprocsap" class="form-control form-control-sm select2bs4 @error('eprocsap') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=''></option>
                                        <option value='EPROC' {{ old('eprocsap', $po->eprocsap) == 'EPROC' ? 'selected' : '' }}>EPROC</option>
                                        <option value='SAP' {{ old('eprocsap', $po->eprocsap) == 'SAP' ? 'selected' : '' }}>SAP</option>
                                    </select>
                                    @error('eprocsap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="progress">Progress <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus fa-xs"></i></a></label>
                                <div class="col-md-10">
                                    <select id="progress" name="progress" class="form-control form-control-sm  select2bs4 @error('progress') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=''></option>
                                        @foreach($progress as $prog)
                                        <option value='{{$prog->progress}}' {{ old('progress', $po->progress) == $prog->progress ? 'selected' : '' }}>{{$prog->progress}}</option>
                                        @endforeach
                                    </select>
                                    @error('progress')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="no_po_sp">No. PO/Agreement/SP</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('no_po_sp') is-invalid @enderror" value="{{old('no_po_sp') ??  $po->no_po_sp}}" id="no_po_sp" placeholder="No. PO/Agreement/SP" name="no_po_sp">
                                    @error('no_po_sp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="nilai_po">Nilai PO</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('nilai_po') is-invalid @enderror" value="{{old('nilai_po') ?? $po->nilai_po}}" id="nilai_po" placeholder="Nilai PO" name="nilai_po">
                                    @error('nilai_po')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="tanggal_po">Tanggal PO</label>
                                <div class="col-md-10">
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datetimepicker-input @error('tanggal_po') is-invalid @enderror" value="{{old('tanggal_po') ?? $po->tanggal_po}}" data-target="#reservationdate2" placeholder="Tanggal PO" name="tanggal_po">
                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('tanggal_po')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="vendor">Vendor</label>
                                <div class="col-md-10">
                                    <select id="vendor" name="vendor" class="form-control form-control-sm  select2bs4 @error('vendor') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=''></option>
                                        @foreach($rekanan as $vendor)
                                        <option value='{{$vendor->nama_rekanan}}' {{ old('vendor', $po->vendor) == $vendor->nama_rekanan ? 'selected' : '' }}>{{$vendor->nama_rekanan}}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="due_date_po">Due Date PO</label>
                                <div class="col-md-10">
                                    <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datetimepicker-input @error('due_date_po') is-invalid @enderror" value="{{old('due_date_po') ?? $po->due_date_po}}" data-target="#reservationdate3" placeholder="Tanggal Due Date" name="due_date_po">
                                        <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('due_date_po')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="sinergi">Sinergi</label>
                                <div class="col-md-10">
                                    <select id="sinergi" name="sinergi" class="form-control form-control-sm select2bs4 @error('sinergi') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=""></option>
                                        <option value='BUMN' {{ old('sinergi', $po->sinergi) == 'BUMN' ? 'selected' : '' }}>BUMN</option>
                                        <option value='PI GROUP' {{ old('sinergi', $po->sinergi) == 'PI GROUP' ? 'selected' : '' }}>PI GROUP</option>
                                        <option value='PG GROUP' {{ old('sinergi', $po->sinergi) == 'PG GROUP' ? 'selected' : '' }}>PG GROUP</option>
                                    </select>
                                    @error('sinergi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="padi">Pembelian Melalui PaDi UMKM</label>
                                <div class="col-md-10">
                                    <select id="padi" name="padi" class="form-control form-control-sm select2bs4 @error('padi') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                        <option value=""></option>
                                        <option value='Pengadaan Internal UMKM' {{ old('padi', $po->padi) == 'Pengadaan Internal UMKM' ? 'selected' : '' }}>Pengadaan Internal UMKM</option>
                                        <option value='Pengadaan B2B PaDi UMKM' {{ old('padi', $po->padi) == 'Pengadaan B2B PaDi UMKM' ? 'selected' : '' }}>Pengadaan B2B PaDi UMKM</option>
                                    </select>
                                    @error('padi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="invoicing">Invoicing PaDi</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('invoicing') is-invalid @enderror" value="{{old('invoicing') ?? $po->invoicing}}" id="invoicing" placeholder="Invoicing PaDi" name="invoicing">
                                    @error('invoicing')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="delivered">Delivered</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('delivered') is-invalid @enderror" value="{{old('delivered') ?? $po->delivered}}" id="delivered" placeholder="Delivered" name="delivered">
                                    @error('delivered')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="stb_delivered">Still To Be Delivered</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('stb_delivered') is-invalid @enderror" value="{{old('stb_delivered') ?? $po->stb_delivered}}" id="stb_delivered" placeholder="Still To Be Delivered" name="stb_delivered">
                                    @error('stb_delivered')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="invoiced">Invoiced</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm @error('invoiced') is-invalid @enderror" value="{{old('invoiced') ?? $po->invoiced}}" id="invoiced" placeholder="Invoiced" name="invoiced">
                                    @error('invoiced')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label col-form-label-sm" for="keterangan">Keterangan</label>
                                <div class="col-md-10">
                                    <textarea id="keterangan" class="form-control form-control-sm @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" cols="50">{{old('keterangan') ?? $po->keterangan}}</textarea>
                                    @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" style="width: 100%;" onclick="return confirm('Update PO?');"><span style="font-weight:bolder">Simpan</span></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Progress -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Tambah Item Progress</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('progress.store2')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="progress">Progress<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('progress') is-invalid @enderror" value="{{old('progress')}}" placeholder="Progress" name="progress">
                        @error('progress')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                    <button type="submit" class="btn btn-primary btn-sm"><span style="font-weight:bolder">Simpan</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection