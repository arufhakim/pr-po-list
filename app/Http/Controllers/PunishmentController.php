<?php

namespace App\Http\Controllers;

use App\Punishment;
use App\Rekanan;
use Carbon\Carbon;
use App\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PunishmentController extends Controller
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
        $punishments = Punishment::all();

        Punishment::where('status', 'Punished')
            ->whereDate('tanggal_selesai', '<=', now())
            ->update([
                'status' => 'Open Punished',
                'keterangan' => 'Punishment otomatis dibuka oleh sistem',
            ]);

        Punishment::where('status', 'Open Punished')
            ->whereDate('tanggal_selesai', '>', now())
            ->update([
                'status' => 'Punished',
                'keterangan' => 'Punishment otomatis diberikan oleh sistem',
            ]);

        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $query = Punishment::query()
                    ->select([
                        'punishment.id',
                        'rekanan.nama_rekanan',
                        'rekanan.no_sap',
                        'punishment.jenis_hukuman',
                        'punishment.jenis_tangguhan',
                        'punishment.catatan_hukuman',
                        'punishment.tanggal_mulai',
                        'punishment.tanggal_selesai',
                        'punishment.tanggal_dibuat',
                        'punishment.tanggal_diubah',
                        'punishment.status',
                        'punishment.keterangan',
                        'punishment.last_updated_by',
                    ])->whereBetween('punishment.tanggal_mulai', array($request->from_date, $request->to_date))
                    ->leftJoin('rekanan', function ($join) {
                        $join->on('punishment.rekanan_id', '=', 'rekanan.id');
                    });
            } else {
                $query = Punishment::query()
                    ->select([
                        'punishment.id',
                        'rekanan.nama_rekanan',
                        'rekanan.no_sap',
                        'punishment.jenis_hukuman',
                        'punishment.jenis_tangguhan',
                        'punishment.catatan_hukuman',
                        'punishment.tanggal_mulai',
                        'punishment.tanggal_selesai',
                        'punishment.tanggal_dibuat',
                        'punishment.tanggal_diubah',
                        'punishment.status',
                        'punishment.keterangan',
                        'punishment.last_updated_by',
                    ])
                    ->leftJoin('rekanan', function ($join) {
                        $join->on('punishment.rekanan_id', '=', 'rekanan.id');
                    });
            }

            return datatables($query)->addIndexColumn()->addColumn('action', function ($row) {
                $html = '<a href="' . route('punishment.show', $row->id) . '" class="btn btn-primary btn-xs mr-1"><span style="font-size:smaller; font-weight:bolder"> Detail</span> </a>';
                return $html;
            })->editColumn('tanggal_mulai', function ($row) {
                return $row->tanggal_mulai ? with(new Carbon($row->tanggal_mulai))->format('d/m/Y') : '';
            })->editColumn('tanggal_selesai', function ($row) {
                return $row->tanggal_selesai ? with(new Carbon($row->tanggal_selesai))->format('d/m/Y') : '';
            })->editColumn('tanggal_dibuat', function ($row) {
                return $row->tanggal_dibuat ? with(new Carbon($row->tanggal_dibuat))->format('d/m/Y') : '';
            })->editColumn('tanggal_diubah', function ($row) {
                return $row->tanggal_diubah ? with(new Carbon($row->tanggal_diubah))->format('d/m/Y') : '';
            })->rawColumns(['action'])->toJson();
        }
        return view('punishment.index', [
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
        return view('punishment.create', [
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
        $punishment_var = $request->validate([
            'rekanan_id' => 'required',
            'jenis_hukuman' => 'required|max:50',
            'jenis_tangguhan' => 'max:50',
            'catatan_hukuman' => 'required|max:255',
            'tanggal_mulai' => 'required|date_format:Y-m-d',
            'tanggal_selesai' => 'required|date_format:Y-m-d',
            'status' => 'required|max:50',
        ], [
            'rekanan_id.required' => 'Kolom nama vendor tidak boleh kosong',
            'jenis_hukuman.required' => 'Kolom jenis hukuman tidak boleh kosong',
            'jenis_hukuman.max' => 'Jenis hukuman tidak boleh lebih dari 50 karakter',
            'jenis_tangguhan.max' => 'Jenis tangguhan tidak boleh lebih dari 50 karakter',
            'catatan_hukuman.required' => 'Kolom catatan hukuman tidak boleh kosong',
            'catatan_hukuman.max' => 'Catatan hukuman tidak boleh lebih dari 255 karakter',
            'tanggal_mulai.required' => 'Kolom tanggal mulai tidak boleh kosong',
            'tanggal_mulai.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'tanggal_selesai.required' => 'Kolom tanggal selesai tidak boleh kosong',
            'tanggal_selesai.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'status.required' => 'Kolom status tidak boleh kosong',
            'status.max' => 'Status tidak boleh lebih dari 50 karakter',
        ]);
        $punishment_var['tanggal_dibuat'] = Carbon::now();
        $punishment_var['last_updated_by'] = Auth::user()->name;

        $punishment = Punishment::create($punishment_var);

        $rekanan = Rekanan::find($punishment_var['rekanan_id']);

        activity()
            ->withProperties(['punishment_id' => $punishment->id])
            ->log('Menambah Punishment Rekanan ' . $rekanan->nama_rekanan);

        toastr()->success('Punishment Rekanan Berhasil Ditambahkan!', 'Success');
        return redirect()->route('punishment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Punishment $punishment)
    {
        return view('punishment.show', [
            'rekanan' => Rekanan::all(),
            'punishment' => $punishment,
            'users_log' => ActivityLog::with('user')
                ->where('properties->punishment_id', $punishment->id)
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
    public function edit(Punishment $punishment)
    {
        return view('punishment.edit', [
            'rekanan' => Rekanan::all(),
            'punishment' => $punishment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Punishment $punishment)
    {
        $punishment_var = $request->validate([
            'rekanan_id' => 'required',
            'jenis_hukuman' => 'required|max:50',
            'jenis_tangguhan' => 'max:50',
            'catatan_hukuman' => 'required|max:255',
            'tanggal_mulai' => 'required|date_format:Y-m-d',
            'tanggal_selesai' => 'required|date_format:Y-m-d',
            'status' => 'required|max:50',
        ], [
            'rekanan_id.required' => 'Kolom nama vendor tidak boleh kosong',
            'jenis_hukuman.required' => 'Kolom jenis hukuman tidak boleh kosong',
            'jenis_hukuman.max' => 'Jenis hukuman tidak boleh lebih dari 50 karakter',
            'jenis_tangguhan.max' => 'Jenis tangguhan tidak boleh lebih dari 50 karakter',
            'catatan_hukuman.required' => 'Kolom catatan hukuman tidak boleh kosong',
            'catatan_hukuman.max' => 'Catatan hukuman tidak boleh lebih dari 255 karakter',
            'tanggal_mulai.required' => 'Kolom tanggal mulai tidak boleh kosong',
            'tanggal_mulai.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'tanggal_selesai.required' => 'Kolom tanggal selesai tidak boleh kosong',
            'tanggal_selesai.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'status.required' => 'Kolom status tidak boleh kosong',
            'status.max' => 'Status tidak boleh lebih dari 50 karakter',
        ]);

        $punishment_var['tanggal_diubah'] = Carbon::now();
        $punishment_var['last_updated_by'] = Auth::user()->name;

        $punishment->update($punishment_var);

        $rekanan = Rekanan::find($punishment_var['rekanan_id']);

        activity()
            ->withProperties(['punishment_id' => $punishment->id])
            ->log('Mengedit Punishment Rekanan ' . $rekanan->nama_rekanan);

        toastr()->success('Punishment Rekanan Berhasil Diubah!', 'Success');
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
        $punishment = Punishment::find($request->id);
        Punishment::find($request->id)->delete();

        $rekanan = Rekanan::find($punishment->rekanan_id);

        activity()
            ->withProperties(['punishment_id' => $punishment->id])
            ->log('Mengedit Punishment Rekanan ' . $rekanan->nama_rekanan);

        toastr()->success('Punishment Rekanan Berhasil Dihapus!', 'Success');
        return redirect()->route('punishment.index');
    }
}
