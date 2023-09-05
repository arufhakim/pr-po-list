<?php

namespace App\Http\Controllers;

use Exception;
use App\Progress;
use App\PO;
use App\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
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
        return view('progress.index', [
            'progress' => Progress::orderBy('progress', 'asc')->get(),
            'po_use' => PO::all(),
            'users_log' => ActivityLog::with('user')
                ->where('description', 'like', '%' . 'Progress' . '%')
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
        return view('progress.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $progress_var = $request->validate([
            'progress_add' => 'required|max:255'
        ],  [
            'progress_add.required' => 'Kolom progress tidak boleh kosong',
            'progress_add.max' => 'Progress tidak boleh lebih dari 255 karakter',
        ]);
        $progress_var['last_updated_by'] = Auth::user()->name;

        Progress::create([
            'progress' => $progress_var['progress_add'],
            'last_updated_by' => $progress_var['last_updated_by'],
        ]);

        activity()->log('Menambah Item Progress ' . $request->progress_add);

        toastr()->success('Item Progress ' . $request->progress_add . ' Berhasil Ditambahkan!', 'Success');
        return redirect()->route('progress.index');
    }

    public function store2(Request $request)
    {
        $progress_var = $request->validate([
            'progress' => 'required|max:255'
        ],  [
            'progress.required' => 'Kolom progress tidak boleh kosong',
            'progress.max' => 'Progress tidak boleh lebih dari 255 karakter',
        ]);
        $progress_var['last_updated_by'] = Auth::user()->name;
        Progress::create($progress_var);

        toastr()->success('Item Progress ' . $request->progress . ' Berhasil Ditambahkan!', 'Success');
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
    public function edit(Progress $progress)
    {
        return view('progress.edit', [
            'progress' => $progress
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
        $old_data_progress = Progress::where('id', $request->id)->first();
        $old_data = $old_data_progress->progress;

        $progress_var = $request->validate([
            'progress' => 'required|max:255',
        ], [
            'progress.required' => 'Kolom progress tidak boleh kosong',
            'progress.max' => 'Progress tidak boleh lebih dari 255 karakter',
        ]);
        $progress_var['id'] = $request->id;
        $progress_var['last_updated_by'] = Auth::user()->name;

        Progress::where('id', $request->id)->update($progress_var);

        PO::where('progress', $old_data)->update([
            'progress' => $request->progress,
        ]);

        activity()->log('Mengedit Item Progress ' . $old_data);

        toastr()->success('Item Progress ' . $old_data . ' Berhasil Diubah!', 'Success');
        return redirect()->route('progress.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $old_data = Progress::find($request->id);
        $progress = Progress::find($request->id);
        $purchase_order = PO::all();
        $po_item = count($purchase_order);
        $i = 0;

        foreach ($purchase_order as $po) {
            if ($progress->progress == $po->progress) {
                toastr()->error('Tidak dapat Menghapus Item Progress ' . $old_data->progress . '!', 'Error');
                return redirect()->back();
                break;
            } else {
                if (++$i === $po_item) {
                    $progress->delete();

                    activity()->log('Menghapus Item Progress ' . $old_data->progress);

                    toastr()->success('Item Progress ' . $old_data->progress . ' Berhasil Dihapus!', 'Success');
                    return redirect()->back();
                    break;
                }
                continue;
            }
        }
    }
}
