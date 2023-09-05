<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use Exception;
use App\Status;
use App\PR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
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
        return view('status.index', [
            'status' => Status::orderBy('status', 'asc')->get(),
            'pr_use' => PR::all(),
            'users_log' => ActivityLog::with('user')
                ->where('description', 'like', '%' . 'Status' . '%')
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
        return view('status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status_var = $request->validate([
            'status_add' => 'required|max:100',
        ],  [
            'status_add.required' => 'Kolom status tidak boleh kosong',
            'status_add.max' => 'Status tidak boleh lebih dari 100 karakter',
        ]);
        $status_var['last_updated_by'] = Auth::user()->name;

        Status::create([
            'status' => $status_var['status_add'],
            'last_updated_by' => $status_var['last_updated_by'],
        ]);

        activity()->log('Menambah Item Status ' . $request->status_add);

        toastr()->success('Item Status ' . $request->status_add . ' Berhasil Ditambahkan!', 'Success');
        return redirect()->route('status.index');
    }

    public function store2(Request $request)
    {
        $status_var = $request->validate([
            'status' => 'required|max:100',
        ],  [
            'status.required' => 'Kolom status tidak boleh kosong',
            'status.max' => 'Status tidak boleh lebih dari 100 karakter',
        ]);
        $status_var['last_updated_by'] = Auth::user()->name;
        Status::create($status_var);

        toastr()->success('Item Status ' . $request->status . ' Berhasil Ditambahkan!', 'Success');
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
    public function edit(Status $status)
    {
        return view('status.edit', [
            'status' => $status
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
        $old_data_status = Status::where('id', $request->id)->first();
        $old_data = $old_data_status->status;

        $status_var = $request->validate([
            'status' => 'required|max:100',
        ],  [
            'status.required' => 'Kolom status tidak boleh kosong',
            'status.max' => 'Status tidak boleh lebih dari 100 karakter',
        ]);
        $status_var['id'] = $request->id;
        $status_var['last_updated_by'] = Auth::user()->name;

        Status::where('id', $request->id)->update($status_var);

        PR::where('status', $old_data)->update([
            'status' => $request->status,
        ]);

        activity()->log('Mengedit Item Status ' . $old_data);

        toastr()->success('Item Status ' . $old_data . ' Berhasil Diubah!', 'Success');
        return redirect()->route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $old_data = Status::find($request->id);
        $status = Status::find($request->id);
        $purchase_request = PR::all();
        $pr_item = count($purchase_request);
        $i = 0;

        foreach ($purchase_request as $pr) {
            if ($status->status == $pr->status) {
                toastr()->error('Tidak dapat Menghapus Item Status ' . $old_data->status . '!', 'Error');
                return redirect()->back();
                break;
            } else {
                if (++$i === $pr_item) {
                    $status->delete();

                    activity()->log('Menghapus Item Status ' . $old_data->status);

                    toastr()->success('Item Status ' . $old_data->status . ' Berhasil Dihapus!', 'Success');
                    return redirect()->back();
                    break;
                }
                continue;
            }
        }
    }
}
