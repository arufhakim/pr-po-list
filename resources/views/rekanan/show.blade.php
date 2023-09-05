@extends('layouts.home')
@section('title', 'Daftar Rekanan')
@section('header', 'Daftar Rekanan')
@section('action7','active')
@section('action71','active')
@section('menuopen3','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('punishment.index')}}">Daftar Rekanan</a></li>
    <li class="breadcrumb-item active">Detail Rekanan</li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-navy">
            <div class="card-header" style="line-height: 10px;">
                <h3 class="card-title" style="font-size: 15px; font-weight: bolder;">Detail Rekanan</h3>
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
                <ul class="nav nav-tabs kembali mb-4" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item" style="width: 33.3%;">
                        <a class="nav-link active text-center" id="custom-content-below-home-tab" data-toggle="pill" href="#detail" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="font-weight: bolder;">DETAIL REKANAN</a>
                    </li>
                    <li class="nav-item" style="width: 33.3%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#edit" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">EDIT REKANAN</a>
                    </li>
                    <li class="nav-item" style="width: 33.3%;">
                        <a class="nav-link text-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#log" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="font-weight: bolder;">LOG HISTORY</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="periode">Periode<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" value="{{$rekanan->periode}}" name="periode" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="kode_rekanan">Kode Rekanan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->kode_rekanan}}" name="kode_rekanan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tipe_perusahaan">Tipe perusahaan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->tipe_perusahaan}}" name="tipe_perusahaan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="nama_rekanan">Nama Rekanan<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->nama_rekanan}}" name="nama_rekanan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="alamat">Alamat</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->alamat}}" name="alamat" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="kota">Kota</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->kota}}" name="kota" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="email">Email</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->email}}" name="email" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="no_telp">No. Telp</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->no_telp}}" name="no_telp" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="no_sos_barang_detail">No. SoS Barang</label>
                                    <div class="col-md-10">
                                        <select name="no_sos_barang_detail[]" multiple class="form-control select2bs4" style="width: 100%;" disabled>
                                            <option value=''></option>
                                            @foreach($no_sos_barang as $sos)
                                            @if($rekanan->no_sos_barang)
                                            <option value="{{ $sos->kode_sos }}" {{ in_array($sos->kode_sos, $rekanan->no_sos_barang) ? 'selected' : '' }}>{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                            @else
                                            <option value="{{ $sos->kode_sos }}">{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="no_sos_jasa_detail">No. SoS Jasa</label>
                                    <div class="col-md-10">
                                        <select name="no_sos_jasa_detail[]" multiple class="form-control select2bs4" style="width: 100%;" disabled>
                                            <option value=''></option>
                                            @foreach($no_sos_jasa as $sos)
                                            @if($rekanan->no_sos_jasa)
                                            <option value="{{ $sos->kode_sos }}" {{ in_array($sos->kode_sos, $rekanan->no_sos_jasa) ? 'selected' : '' }}>{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                            @else
                                            <option value="{{ $sos->kode_sos }}">{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="status_rekanan">Status Rekanan</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->status_rekanan}}" name="status_rekanan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="no_sap">No SAP</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->no_sap}}" name="no_sap" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="tes_link">Tes Link</label>
                                    <div class="col-md-10">
                                        <textarea id="tes_link" class="form-control" name="tes_link" rows="3" cols="50" style="font-size: 14px" readonly>{{$rekanan->tes_link}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="status">Status<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->status}}" name="status" readonly>
                                    </div>
                                </div>
                                <div class="form-group row clearfix">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="khusus_detail">Rekanan Khusus</label>
                                    <div class="col-md-10">
                                        <div class="icheck-success d-inline">
                                            <input type="checkbox" name="khusus_detail" value="Rekanan Khusus" disabled {{ old('khusus_detail', $rekanan->khusus) == 'Rekanan Khusus' ? 'checked' : '' }}>
                                            <label for="khusus">
                                                <span style="font-weight: lighter;"> Rekanan Khusus</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="last_updated_by">Last Updated By</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->last_updated_by}}" name="last_updated_by" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="created_at">Tanggal Dibuat</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->created_at}}" name="created_at" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label col-form-label-sm" for="updated_at">Tanggal Diubah</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{$rekanan->updated_at}}" name="updated_at" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger float-right hapus" data-toggle="modal" data-id='{{$rekanan->id}}' data-target="#hapus"><span style="font-weight:bolder"> Hapus</span></button>
                    </div>
                    <div class="tab-pane fade" id="log" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                        <div class="table-responsive" style="width: 100%;">
                            <table class="table table-hover datatable table-bordered table-sm" style="width: 100%">
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
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                        <form id="form-update" action="{{route('rekanan.update', ['rekanan' => $rekanan->id])}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="periode">Periode<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('periode') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('periode') ?? $rekanan->periode}}" data-target="#reservationdate" placeholder="Periode" name="periode">
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                @error('periode')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="kode_rekanan">Kode Rekanan</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('kode_rekanan') is-invalid @enderror" value="{{old('kode_rekanan') ?? $rekanan->kode_rekanan}}" id="kode_rekanan" placeholder="Kode Rekanan" name="kode_rekanan">
                                            @error('kode_rekanan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tipe_perusahaan">Tipe perusahaan</label>
                                        <div class="col-md-10">
                                            <select id="tipe_perusahaan" name="tipe_perusahaan" class="form-control select2bs4 @error('tipe_perusahaan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='CV' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'CV' ? 'selected' : '' }}>CV</option>
                                                <option value='PT' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'PT' ? 'selected' : '' }}>PT</option>
                                                <option value='UD' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'UD' ? 'selected' : '' }}>UD</option>
                                                <option value='PO' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'PO' ? 'selected' : '' }}>PO</option>
                                                <option value='KOPERASI' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'KOPERASI' ? 'selected' : '' }}>KOPERASI</option>
                                                <option value='KUD' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'KUD' ? 'selected' : '' }}>KUD</option>
                                                <option value='YAYASAN' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'YAYASAN' ? 'selected' : '' }}>YAYASAN</option>
                                                <option value='DINAS' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'DINAS' ? 'selected' : '' }}>DINAS</option>
                                                <option value='PUSKUD' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'PUSKUD' ? 'selected' : '' }}>PUSKUD</option>
                                                <option value='BAPAK' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'BAPAK' ? 'selected' : '' }}>BAPAK</option>
                                                <option value='IBU' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'IBU' ? 'selected' : '' }}>IBU</option>
                                                <option value='PD' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'PD' ? 'selected' : '' }}>PD</option>
                                                <option value='TOKO' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'TOKO' ? 'selected' : '' }}>TOKO</option>
                                                <option value='KIOS' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'KIOS' ? 'selected' : '' }}>KIOS</option>
                                                <option value='GAPOKTAN' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'GAPOKTAN' ? 'selected' : '' }}>GAPOKTAN</option>
                                                <option value='COMPANY' {{ old('tipe_perusahaan', $rekanan->tipe_perusahaan) == 'COMPANY' ? 'selected' : '' }}>COMPANY</option>
                                            </select>
                                            @error('tipe_perusahaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="nama_rekanan">Nama Rekanan<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('nama_rekanan') is-invalid @enderror" value="{{old('nama_rekanan') ?? $rekanan->nama_rekanan}}" id="nama_rekanan" placeholder="Nama Rekanan" name="nama_rekanan">
                                            @error('nama_rekanan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="alamat">Alamat</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat') ?? $rekanan->alamat}}" id="alamat" placeholder="Alamat" name="alamat">
                                            @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="kota">Kota</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('kota') is-invalid @enderror" value="{{old('kota') ?? $rekanan->kota}}" id="kota" placeholder="Kota" name="kota">
                                            @error('kota')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="email">Email</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{old('email') ?? $rekanan->email}}" id="email" placeholder="Email" name="email">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="no_telp">No. Telp</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" value="{{old('no_telp') ?? $rekanan->no_telp}}" id="no_telp" placeholder="081xxx" name="no_telp">
                                            @error('no_telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="no_sos_barang">No. SoS Barang</label>
                                        <div class="col-md-10">
                                            <select id="no_sos_barang" name="no_sos_barang[]" multiple class="form-control select2bs4 @error('no_sos_barang') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                @foreach($no_sos_barang as $sos)
                                                @if (old('no_sos_barang'))
                                                <option value="{{ $sos->kode_sos }}" {{ in_array($sos->kode_sos, old('no_sos_barang')) ? 'selected' : '' }}>{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                                @elseif($rekanan->no_sos_barang)
                                                <option value="{{ $sos->kode_sos }}" {{ in_array($sos->kode_sos, $rekanan->no_sos_barang) ? 'selected' : '' }}>{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                                @else
                                                <option value="{{ $sos->kode_sos }}">{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('no_sos_barang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="no_sos_jasa">No. SoS Jasa</label>
                                        <div class="col-md-10">
                                            <select id="no_sos_jasa" name="no_sos_jasa[]" multiple class="form-control select2bs4 @error('no_sos_jasa') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                @foreach($no_sos_jasa as $sos)
                                                @if (old('no_sos_jasa'))
                                                <option value="{{ $sos->kode_sos }}" {{ in_array($sos->kode_sos, old('no_sos_jasa')) ? 'selected' : '' }}>{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                                @elseif($rekanan->no_sos_jasa)
                                                <option value="{{ $sos->kode_sos }}" {{ in_array($sos->kode_sos, $rekanan->no_sos_jasa) ? 'selected' : '' }}>{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                                @else
                                                <option value="{{ $sos->kode_sos }}">{{ $sos->kode_sos }} - {{ $sos->deskripsi_sos }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('no_sos_jasa')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="status_rekanan">Status Rekanan</label>
                                        <div class="col-md-10">
                                            <select id="status_rekanan" name="status_rekanan" class="form-control select2bs4 @error('status_rekanan') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Registered' {{ old('status_rekanan', $rekanan->status_rekanan) == 'Registered' ? 'selected' : '' }}>Registered</option>
                                                <option value='Unregistered' {{ old('status_rekanan', $rekanan->status_rekanan) == 'Unregistered' ? 'selected' : '' }}>Unregistered</option>
                                            </select>
                                            @error('status_rekanan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="no_sap">No SAP</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('no_sap') is-invalid @enderror" value="{{old('no_sap') ?? $rekanan->no_sap}}" id="no_sap" placeholder="No SAP" name="no_sap">
                                            @error('no_sap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="tes_link">Tes Link</label>
                                        <div class="col-md-10">
                                            <textarea id="tes_link" class="form-control @error('tes_link') is-invalid @enderror" name="tes_link" rows="3" cols="50" style="font-size: 14px" placeholder="Tes Link">{{old('tes_link') ?? $rekanan->tes_link}}</textarea>
                                            @error('tes_link')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="status">Status<span class="required">*</span></label>
                                        <div class="col-md-10">
                                            <select id="status" name="status" class="form-control select2bs4 @error('status') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                                <option value=''></option>
                                                <option value='Aktif' {{ old('status', $rekanan->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value='Non Aktif' {{ old('status', $rekanan->status) == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row clearfix">
                                        <label class="col-md-2 col-form-label col-form-label-sm" for="khusus">Rekanan Khusus</label>
                                        <div class="col-md-10">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="khusus" id="khusus" value="Rekanan Khusus" {{ old('khusus', $rekanan->khusus) == 'Rekanan Khusus' ? 'checked' : '' }}>
                                                <label for="khusus">
                                                    <span style="font-weight: lighter;"> Rekanan Khusus</span>
                                                </label>
                                            </div>
                                            @error('khusus')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-toggle="modal" data-target="#confirm-update" class="btn btn-success btn-sm float-right"><span style="font-weight:bolder">Simpan</span></button>
                        </form>
                    </div>
                </div>
            </div>
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
                <form action="{{route('rekanan.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_hapus" name="id">
                    Apakah Anda Yakin Ingin Menghapus Rekanan Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <button type="submit" class="btn btn-success btn-sm"><span style="font-weight:bolder">Hapus<span></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- EDIT -->
<div class="modal fade" id="confirm-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ffc107; color: black;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px; font-weight:bolder;">Konfirmasi Update</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghapus Data Berikut?
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span style="font-weight:bolder">Tutup</span></button>
                <a href="#" id="submit-update" class="btn btn-success btn-sm"><span style="font-weight:bolder">Submit</span></a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@if(count($errors) > 0)
<script type="text/javascript">
    $('.kembali li:eq(1) a').tab('show')
</script>
@endif

<script>
    $(document).on('click', '.hapus', function() {
        let id = $(this).attr('data-id');
        $('#id_hapus').val(id);
    });
</script>

<script>
    $('#submit-update').click(function() {
        $('#form-update').submit();
    });
</script>
@endpush