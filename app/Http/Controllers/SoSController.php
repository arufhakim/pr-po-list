<?php

namespace App\Http\Controllers;

use App\SoS;
use App\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoSController extends Controller
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
    public function index()
    {
        return view('sos.index', [
            'sos' => SoS::orderBy('kode_sos', 'asc')->get(),
            'users_log' => ActivityLog::with('user')
                ->where('description', 'like', '%' . 'SoS' . '%')
                ->limit(20)
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sos_var = $request->validate([
            'deskripsi_add' => 'max:255',
            'kode_sos_add' => 'required|max:10',
            'deskripsi_sos_add' => 'required|max:255'
        ], [
            'deskripsi_add.max' => 'Deskripsi tidak boleh lebih dari 255 karakter',
            'kode_sos_add.required' => 'Kolom kode SoS tidak boleh kosong',
            'kode_sos_add.max' => 'Kode SoS tidak boleh lebih dari 10 karakter',
            'deskripsi_sos_add.required' => 'Kolom deskripsi SoS tidak boleh kosong',
            'deskripsi_sos_add.max' => 'Deskripsi SoS tidak boleh lebih dari 255 karakter',
        ]);

        $sos_var['last_updated_by'] = Auth::user()->name;
        SoS::create([
            'deskripsi' => $sos_var['deskripsi_add'],
            'kode_sos' => $sos_var['kode_sos_add'],
            'deskripsi_sos' => $sos_var['deskripsi_sos_add'],
            'last_updated_by' => $sos_var['last_updated_by'],
        ]);

        activity()->log('Menambah SoS ' . $request->kode_sos_add);

        toastr()->success('SoS ' . $request->kode_sos_add . ' Berhasil Ditambahkan!', 'Success');
        return redirect()->route('sos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SoS $so)
    {
        return view('sos.edit', [
            'sos' => $so,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sos_var = $request->validate([
            'deskripsi' => 'max:255',
            'kode_sos' => 'required|max:10',
            'deskripsi_sos' => 'required|max:255'
        ], [
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter',
            'kode_sos.required' => 'Kolom kode SoS tidak boleh kosong',
            'kode_sos.max' => 'Kode SoS tidak boleh lebih dari 10 karakter',
            'deskripsi_sos.required' => 'Kolom deskripsi SoS tidak boleh kosong',
            'deskripsi_sos.max' => 'Deskripsi SoS tidak boleh lebih dari 255 karakter',
        ]);

        $sos_var['id'] = $request->id;
        $sos_var['last_updated_by'] = Auth::user()->name;

        $old_data = SoS::find($request->id);
        SoS::where('id', $request->id)->update($sos_var);

        activity()->log('Mengedit SoS ' . $old_data->kode_sos);

        toastr()->success('SoS ' . $old_data->kode_sos . ' Berhasil Diubah!', 'Success');
        return redirect()->route('sos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $old_data = SoS::find($request->id);
        SoS::find($request->id)->delete();

        activity()->log('Menghapus SoS ' . $old_data->kode_sos);

        toastr()->success('SoS ' . $old_data->kode_sos . ' Berhasil Dihapus!', 'Success');
        return redirect()->back();
    }
}
