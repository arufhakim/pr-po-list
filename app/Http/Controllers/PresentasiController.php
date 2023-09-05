<?php

namespace App\Http\Controllers;

use App\Presentasi;
use App\Unit;
use Carbon\Carbon;
use App\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PresentasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store']);
        $this->middleware('approved')->except(['create', 'store']);
        $this->middleware('role:Admin')->except(['create', 'store']);
        $this->middleware('role:Admin|Jasa Pabrik|Jasa Non Pabrik|Jasa Distribusi & Pemasaran|Jasa Investasi EPC')->except(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Presentasi::query()
                ->select([
                    'presentasi.id',
                    'presentasi.tipe_perusahaan',
                    'presentasi.nama_vendor',
                    'presentasi.email_vendor',
                    'presentasi.website_vendor',
                    'presentasi.bidang_usaha',
                    'presentasi.merk',
                    'presentasi.nama_pic',
                    'presentasi.email_pic',
                    'presentasi.no_hp_pic',
                    'presentasi.tanggal_diajukan',
                    'presentasi.status',
                ]);

            return datatables($query)->addIndexColumn()->addColumn('action', function ($row) {
                $html = '<a href="' . route('presentasi.show', $row->id) . '" class="btn btn-primary btn-xs mr-1"><span style="font-size:smaller; font-weight:bolder"> Detail</span> </a>';
                return $html;
            })->editColumn('tanggal_diajukan', function ($row) {
                return $row->tanggal_diajukan ? with(new Carbon($row->tanggal_diajukan))->format('d/m/Y') : '';
            })->rawColumns(['action'])->toJson();
        }
        return view('presentasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('presentasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $presentasi_var = $request->validate([
            'tipe_perusahaan' => 'required|max:50',
            'nama_vendor' => 'required|max:100',
            'email_vendor' => 'max:100',
            'website_vendor' => 'max:100',
            'bidang_usaha' => 'required|max:255',
            'merk' => 'max:100',
            'nama_pic' => 'required|max:100',
            'email_pic' => 'required|email|max:100',
            'no_hp_pic' => 'required|digits_between:7,13|numeric',
            'company_profile' => 'required|mimes:pdf|max:10000',
            'katalog' => 'required|mimes:pdf|max:10000',
            'surat_permohonan' => 'required|mimes:pdf|max:10000',
            'pengalaman_kerja' => 'required|mimes:pdf|max:10000',
            'g-recaptcha-response' => 'required|captcha'
        ], [
            'tipe_perusahaan.required' => 'Kolom tipe perusahaan tidak boleh kosong',
            'tipe_perusahaan.max' => 'Tipe perusahaan tidak boleh lebih dari 50 karakter',
            'nama_vendor.required' => 'Kolom nama vendor tidak boleh kosong',
            'nama_vendor.max' => 'Nama vendor tidak boleh lebih dari 100 karakter',
            'email_vendor.max' => 'Email perusahaan tidak boleh lebih dari 100 karakter',
            'website_vendor.max' => 'Website perusahaan tidak boleh lebih dari 100 karakter',
            'bidang_usaha.required' => 'Kolom bidang usaha tidak boleh kosong',
            'bidang_usaha.max' => 'Bidang usaha tidak boleh lebih dari 255 karakter',
            'merk.max' => 'Merk/Brand tidak boleh lebih dari 100 karakter',
            'nama_pic.required' => 'Kolom nama PIC tidak boleh kosong',
            'nama_pic.max' => 'Nama PIC tidak boleh lebih dari 100 karakter',
            'email_pic.email' => 'Email harus merupakan email yang valid',
            'email_pic.required' => 'Kolom email PIC tidak boleh kosong',
            'email_pic.max' => 'Email PIC tidak boleh lebih dari 100 karakter',
            'no_hp_pic.required' => 'Kolom no HP PIC tidak boleh kosong',
            'no_hp_pic.digits_between' => 'No HP PIC tidak boleh lebih dari 13 karakter',
            'no_hp_pic.numeric' => 'No HP PIC harus berupa angka',
            'company_profile.required' => 'Kolom company profile tidak boleh kosong',
            'company_profile.mimes' => 'File company profile harus bertipe .pdf',
            'katalog.required' => 'Kolom katalog tidak boleh kosong',
            'katalog.mimes' => 'File katalog harus bertipe .pdf',
            'surat_permohonan.required' => 'Kolom surat permohonan tidak boleh kosong',
            'surat_permohonan.mimes' => 'File surat permohonan harus bertipe .pdf',
            'pengalaman_kerja.required' => 'Kolom pengalaman kerja tidak boleh kosong',
            'pengalaman_kerja.mimes' => 'File pengalaman kerja harus bertipe .pdf',
            'g-recaptcha-response.required' => 'Captcha tidak boleh kosong'
        ]);

        $presentasi_var['tanggal_diajukan'] = Carbon::now();

        $company_profile = $request->file('company_profile');
        $nama_company_profile = Str::random(30) . '.' . $company_profile->getClientOriginalExtension();
        $company_profile->move('file_upload', $nama_company_profile);

        $katalog = $request->file('katalog');
        $nama_katalog =  Str::random(30) . '.' . $katalog->getClientOriginalExtension();
        $katalog->move('file_upload', $nama_katalog);

        $surat_permohonan = $request->file('surat_permohonan');
        $nama_surat_permohonan = Str::random(30) . '.' . $surat_permohonan->getClientOriginalExtension();
        $surat_permohonan->move('file_upload', $nama_surat_permohonan);

        $pengalaman_kerja = $request->file('pengalaman_kerja');
        $nama_pengalaman_kerja = Str::random(30) . '.' . $pengalaman_kerja->getClientOriginalExtension();
        $pengalaman_kerja->move('file_upload', $nama_pengalaman_kerja);

        $presentasi_var['company_profile'] =  $nama_company_profile;
        $presentasi_var['katalog'] =  $nama_katalog;
        $presentasi_var['surat_permohonan'] =  $nama_surat_permohonan;
        $presentasi_var['pengalaman_kerja'] =  $nama_pengalaman_kerja;

        Presentasi::create($presentasi_var);

        toastr()->success('Berhasil Melakukan Pengajuan Presentasi Company Profile!', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Presentasi $presentasi)
    {
        return view('presentasi.show', [
            'presentasi' => $presentasi,
            'unit' => Unit::all(),
            'users_log' => ActivityLog::with('user')
                ->where('properties->presentasi_id', $presentasi->id)
                ->limit(20)
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Presentasi $presentasi)
    {
        return view('presentasi.edit', [
            'presentasi' => $presentasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presentasi $presentasi)
    {
        $presentasi_var = $request->validate([
            'company_profile' => 'mimes:pdf|max:10000',
            'katalog' => 'mimes:pdf|max:10000',
            'surat_permohonan' => 'mimes:pdf|max:10000',
            'pengalaman_kerja' => 'mimes:pdf|max:10000',
        ], [
            'company_profile.mimes' => 'File company profile harus bertipe .pdf',
            'katalog.mimes' => 'File katalog harus bertipe .pdf',
            'surat_permohonan.mimes' => 'File surat permohonan harus bertipe .pdf',
            'pengalaman_kerja.mimes' => 'File pengalaman kerja harus bertipe .pdf',
        ]);

        if (isset($presentasi_var['company_profile'])) {
            $company_profile = $request->file('company_profile');
            $nama_company_profile = Str::random(30) . '.' . $company_profile->getClientOriginalExtension();
            $company_profile->move('file_upload', $nama_company_profile);
            $presentasi_var['company_profile'] =  $nama_company_profile;
        }

        if (isset($presentasi_var['katalog'])) {
            $katalog = $request->file('katalog');
            $nama_katalog =  Str::random(30) . '.' . $katalog->getClientOriginalExtension();
            $katalog->move('file_upload', $nama_katalog);
            $presentasi_var['katalog'] =  $nama_katalog;
        }

        if (isset($presentasi_var['surat_permohonan'])) {
            $surat_permohonan = $request->file('surat_permohonan');
            $nama_surat_permohonan = Str::random(30) . '.' . $surat_permohonan->getClientOriginalExtension();
            $surat_permohonan->move('file_upload', $nama_surat_permohonan);
            $presentasi_var['surat_permohonan'] =  $nama_surat_permohonan;
        }

        if (isset($presentasi_var['pengalaman_kerja'])) {
            $pengalaman_kerja = $request->file('pengalaman_kerja');
            $nama_pengalaman_kerja = Str::random(30) . '.' . $pengalaman_kerja->getClientOriginalExtension();
            $pengalaman_kerja->move('file_upload', $nama_pengalaman_kerja);
            $presentasi_var['pengalaman_kerja'] =  $nama_pengalaman_kerja;
        }


        $presentasi->update($presentasi_var);

        toastr()->success('Berhasil Melakukan Perubahan Berkas Presentasi Company Profile!', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Presentasi::find($request->id)->delete();
        toastr()->success('Pengajuan Presentasi Vendor Berhasil Dihapus!', 'Success');
        return redirect()->route('presentasi.index');
    }

    public function company_profile(Presentasi $presentasi)
    {
        $company_profile = Presentasi::find($presentasi['id']);
        $download = public_path() . '/file_upload/' . $company_profile->company_profile;
        return response()->download($download);
    }

    public function katalog(Presentasi $presentasi)
    {
        $katalog = Presentasi::find($presentasi['id']);
        $download = public_path() . '/file_upload/' . $katalog->katalog;
        return response()->download($download);
    }

    public function surat_permohonan(Presentasi $presentasi)
    {
        $surat_permohonan = Presentasi::find($presentasi['id']);
        $download = public_path() . '/file_upload/' . $surat_permohonan->surat_permohonan;
        return response()->download($download);
    }

    public function pengalaman_kerja(Presentasi $presentasi)
    {
        $pengalaman_kerja = Presentasi::find($presentasi['id']);
        $download = public_path() . '/file_upload/' . $pengalaman_kerja->pengalaman_kerja;
        return response()->download($download);
    }

    public function acc(Request $request, Presentasi $presentasi)
    {
        $presentasi_var = $request->validate([
            'status' => 'required',
            'tanggal_pelaksanaan' => 'nullable|date_format:Y-m-d',
            'tempat' => 'max:100',
            'waktu_pelaksanaan' => 'nullable|date_format:H:i:s',
            'user' => 'max:100',
            'keterangan' => 'required|max:255',
        ], [
            'status.required' => 'Status tidak boleh kosong',
            'tanggal_pelaksanaan.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'tempat.max' => 'Tempat tidak boleh lebih dari 100 karakter',
            'waktu_pelaksanaan.date_format' => 'Format penulisan waktu: Jam:Menit:Detik (08:30:00)',
            'user.max' => 'User tidak boleh lebih dari 100 karakter',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter',
        ]);

        if (empty($presentasi->tanggal_disetujui)) {
            $presentasi_var['tanggal_disetujui'] = Carbon::now();
            $presentasi_var['created_by'] = Auth::user()->name;
        }

        $presentasi->update($presentasi_var);

        activity()
            ->withProperties(['presentasi_id' => $presentasi->id])
            ->log('Memproses Pengajuan Presentasi Rekanan ' . $presentasi->nama_vendor);

        toastr()->success('Persetujuan Pengajuan Presentasi Berhasil Disimpan!', 'Success');
        return redirect()->back();
    }
}
