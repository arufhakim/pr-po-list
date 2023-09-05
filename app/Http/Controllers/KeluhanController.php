<?php

namespace App\Http\Controllers;

use App\Keluhan;
use App\Rekanan;
use App\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class KeluhanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approved');
        $this->middleware('role:Admin|Jasa Pabrik|Jasa Non Pabrik|Jasa Distribusi & Pemasaran|Jasa Investasi EPC');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date_start = date('Y-m-d', strtotime('first day of january last year'));
        $date_end = date('Y-m-d', strtotime('last day of December this year'));

        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $query = Keluhan::query()
                    ->select([
                        'id',
                        'tanggal_pelaporan',
                        'nama_rekanan',
                        'deskripsi',
                        'media_penyampaian_keluhan',
                        'evidence',
                        'tanggal_close',
                        'keterangan',
                        'kategori',
                        'pelayanan_keluhan',
                        'last_updated_by',
                    ])->whereBetween('tanggal_pelaporan', array($request->from_date, $request->to_date));
            } else {
                $query = Keluhan::query()
                    ->select([
                        'id',
                        'tanggal_pelaporan',
                        'nama_rekanan',
                        'deskripsi',
                        'media_penyampaian_keluhan',
                        'evidence',
                        'tanggal_close',
                        'keterangan',
                        'kategori',
                        'pelayanan_keluhan',
                        'last_updated_by',
                    ])->whereBetween('tanggal_pelaporan', array($date_start, $date_end));
            }
            return datatables($query)->addIndexColumn()->addColumn('action', function ($row) {
                $html = '<a href="' . route('keluhan.show', $row->id) . '" class="btn btn-primary btn-xs mr-1"><span style="font-size:smaller; font-weight:bolder"> Detail</span> </a>';
                return $html;
            })->editColumn('tanggal_pelaporan', function ($row) {
                return $row->tanggal_pelaporan ? with(new Carbon($row->tanggal_pelaporan))->format('d/m/Y') : '';
            })->rawColumns(['action'])->toJson();
        }

        return view('keluhan.index', [
            'rekanan' => Rekanan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keluhan.create', [
            'rekanan' => Rekanan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keluhan_var = $request->validate([
            'tanggal_pelaporan' => 'required|date_format:Y-m-d',
            'nama_rekanan' => 'required|max:100',
            'deskripsi' => 'required|max:255',
            'media_penyampaian_keluhan' => 'required|max:100',
            'evidence' => 'required|max:100',
            'tanggal_close' => 'date_format:Y-m-d|nullable',
            'keterangan' => 'max:255',
            'kategori' => 'max:100',
            'pelayanan_keluhan' => 'max:100',
        ], [
            'tanggal_pelaporan.required' => 'Kolom tanggal pelaporan tidak boleh kosong',
            'tanggal_pelaporan.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'nama_rekanan.required' => 'Kolom nama rekanan tidak boleh kosong',
            'nama_rekanan.max' => 'Nama rekanan tidak boleh lebih dari 100 karakter',
            'deskripsi.required' => 'Kolom deskripsi tidak boleh kosong',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter',
            'media_penyampaian_keluhan.required' => 'Kolom media penyampaian keluhan tidak boleh kosong',
            'media_penyampaian_keluhan.max' => 'Media penyampaian keluhan tidak boleh lebih dari 100 karakter',
            'evidence.required' => 'Kolom evicende tidak boleh kosong',
            'evidence.max' => 'Evicende tidak boleh lebih dari 100 karakter',
            'tanggal_close.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter',
            'kategori.max' => 'Kategori tidak boleh lebih dari 100 karakter',
            'pelayanan_keluhan.max' => 'Pelayanan/Keluhan tidak boleh lebih dari 100 karakter',
        ]);

        $keluhan_var['last_updated_by'] = Auth::user()->name;

        $keluhan = Keluhan::create($keluhan_var);

        activity()
            ->withProperties(['keluhan_id' => $keluhan->id])
            ->log('Menambah Pelayanan Rekanan ' . $request->nama_rekanan);

        toastr()->success('Pelayanan Rekanan ' . $request->nama_rekanan . ' Berhasil Ditambahkan!', 'Success');
        return redirect()->route('keluhan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Keluhan $keluhan)
    {
        return view('keluhan.show', [
            'rekanan' => Rekanan::all(),
            'keluhan' => $keluhan,
            'users_log' => ActivityLog::with('user')
                ->where('properties->keluhan_id', $keluhan->id)
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
    public function edit(Keluhan $keluhan)
    {
        return view('keluhan.edit', [
            'rekanan' => Rekanan::all(),
            'keluhan' => $keluhan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keluhan $keluhan)
    {
        $keluhan_var = $request->validate([
            'tanggal_pelaporan' => 'required|date_format:Y-m-d',
            'nama_rekanan' => 'required|max:100',
            'deskripsi' => 'required|max:255',
            'media_penyampaian_keluhan' => 'required|max:100',
            'evidence' => 'required|max:100',
            'tanggal_close' => 'date_format:Y-m-d|nullable',
            'keterangan' => 'max:255',
            'kategori' => 'max:100',
            'pelayanan_keluhan' => 'max:100',
        ], [
            'tanggal_pelaporan.required' => 'Kolom tanggal pelaporan tidak boleh kosong',
            'tanggal_pelaporan.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'nama_rekanan.required' => 'Kolom nama rekanan tidak boleh kosong',
            'nama_rekanan.max' => 'Nama rekanan tidak boleh lebih dari 100 karakter',
            'deskripsi.required' => 'Kolom deskripsi tidak boleh kosong',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter',
            'media_penyampaian_keluhan.required' => 'Kolom media penyampaian keluhan tidak boleh kosong',
            'media_penyampaian_keluhan.max' => 'Media penyampaian keluhan tidak boleh lebih dari 100 karakter',
            'evidence.required' => 'Kolom evicende tidak boleh kosong',
            'evidence.max' => 'Evicende tidak boleh lebih dari 100 karakter',
            'tanggal_close.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter',
            'kategori.max' => 'Kategori tidak boleh lebih dari 100 karakter',
            'pelayanan_keluhan.max' => 'Pelayanan/Keluhan tidak boleh lebih dari 100 karakter',
        ]);

        $keluhan_var['last_updated_by'] = Auth::user()->name;

        $keluhan->update($keluhan_var);

        activity()
            ->withProperties(['keluhan_id' => $keluhan->id])
            ->log('Mengedit Pelayanan Rekanan ' . $request->nama_rekanan);

        toastr()->success('Pelayanan Rekanan ' . $request->nama_rekanan . ' Berhasil Diubah!', 'Success');
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
        $keluhan = Keluhan::find($request->id);
        Keluhan::find($request->id)->delete();

        activity()
            ->withProperties(['keluhan_id' => $keluhan->id])
            ->log('Menghapus Pelayanan Rekanan ' . $keluhan->nama_rekanan);

        toastr()->success('Pelayanan Rekanan ' . $keluhan->nama_rekanan . ' Berhasil Dihapus!', 'Success');
        return redirect()->route('keluhan.index');
    }
}
