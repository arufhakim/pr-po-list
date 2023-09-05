<?php

namespace App\Http\Controllers;

use Exception;
use App\Unit;
use App\PR;
use App\PO;
use App\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approved');
        $this->middleware('role:Admin|PPBJ');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unit.index', [
            'unit' => Unit::orderBy('unit', 'asc')->get(),
            'pr_use' => PR::all(),
            'users_log' => ActivityLog::with('user')
                ->where('description', 'like', '%' . 'User' . '%')
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
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unit_var = $request->validate([
            'unit_add' => 'required|max:100',
        ], [
            'unit_add.required' => 'Kolom unit tidak boleh kosong',
            'unit_add.max' => 'Unit tidak boleh lebih dari 100 karakter',
        ]);
        $unit_var['last_updated_by'] = Auth::user()->name;

        Unit::create([
            'unit' => $unit_var['unit_add'],
            'last_updated_by' => $unit_var['last_updated_by'],
        ]);

        activity()->log('Menambah User ' . $request->unit_add);

        toastr()->success('User ' . $request->unit_add . ' Berhasil Ditambahkan!', 'Success');
        return redirect()->route('unit.index');
    }

    public function store2(Request $request)
    {
        $unit_var = $request->validate([
            'unit' => 'required|max:100',
        ], [
            'unit.required' => 'Kolom unit tidak boleh kosong',
            'unit.max' => 'Unit tidak boleh lebih dari 100 karakter',
        ]);

        $unit_var['last_updated_by'] = Auth::user()->name;
        Unit::create($unit_var);

        toastr()->success('User ' . $request->unit . ' Berhasil Ditambahkan!', 'Success');
        return redirect()->back();
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
    public function edit(Unit $unit)
    {
        return view('unit.edit', [
            'unit' => $unit
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
        $old_data_unit = Unit::where('id', $request->id)->first();
        $old_data = $old_data_unit->unit;

        $unit_var = $request->validate([
            'unit' => 'required|max:100',
        ], [
            'unit.required' => 'Kolom unit tidak boleh kosong',
            'unit.max' => 'Unit tidak boleh lebih dari 100 karakter',
        ]);
        $unit_var['id'] = $request->id;
        $unit_var['last_updated_by'] = Auth::user()->name;

        Unit::where('id', $request->id)->update($unit_var);

        PR::where('unit', $old_data)->update([
            'unit' => $request->unit,
        ]);

        activity()->log('Mengedit User ' . $old_data);

        toastr()->success('User ' . $old_data . ' Berhasil Diubah!', 'Success');
        return redirect()->route('unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $old_data = Unit::find($request->id);
        $unit = Unit::find($request->id);
        $purchase_request = PR::all();
        $pr_item = count($purchase_request);
        $i = 0;

        foreach ($purchase_request as $pr) {
            if ($unit->unit == $pr->unit) {
                toastr()->error('Tidak dapat Menghapus User ' . $old_data->unit . '!', 'Error');
                return redirect()->back();
                break;
            } else {
                if (++$i === $pr_item) {
                    $unit->delete();

                    activity()->log('Menghapus User ' . $old_data->unit);
                    
                    toastr()->success('User ' . $old_data->unit . ' Berhasil Dihapus!', 'Success');
                    return redirect()->back();
                    break;
                }
                continue;
            }
        }
    }
}
