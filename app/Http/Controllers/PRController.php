<?php

namespace App\Http\Controllers;

use App\PR;
use App\PO;
use App\Unit;
use App\Status;
use App\ImportPR;
use App\Progress;
use App\Rekanan;
use App\ActivityLog;
use App\Imports\PRImport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class PRController extends Controller
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
    public function index(Request $request)
    {
        $date_start = date('Y-m-d', strtotime('first day of january last two year'));
        $date_end = date('Y-m-d', strtotime('last day of December this year'));

        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $query = PR::query()
                    ->select([
                        'pr.id',
                        'po.progress',
                        'pr.tanggal_sr',
                        'pr.tanggal_sr_verif',
                        'pr.tim',
                        'pr.unit',
                        'pr.nomor_sr',
                        'pr.gl_account',
                        'pr.cost_center',
                        'pr.uraian_pekerjaan',
                        'pr.pipg',
                        'pr.prioritas',
                        'pr.nomor_pr',
                        'pr.line_pr',
                        'pr.oe_pr',
                        'pr.kontrak',
                        'pr.status',
                        'pr.tanggal_deliv',
                        'po.tanggal_terima_pr',
                        'po.pic',
                        'po.bagian',
                        'po.eprocsap',
                        'po.no_po_sp',
                        'po.nilai_po',
                        'po.tanggal_po',
                        'po.vendor',
                        'po.due_date_po',
                        'po.waktu_proses',
                        'po.sinergi',
                        'po.padi',
                        'po.invoicing',
                        'po.delivered',
                        'po.stb_delivered',
                        'po.invoiced',
                        'po.keterangan',
                    ])->whereBetween('pr.tanggal_sr', array($request->from_date, $request->to_date))
                    ->leftJoin('po', function ($join) {
                        $join->on('pr.id', '=', 'po.pr_id');
                    });
            } else {
                $query = PR::query()
                    ->select([
                        'pr.id',
                        'po.progress',
                        'pr.tanggal_sr',
                        'pr.tanggal_sr_verif',
                        'pr.tim',
                        'pr.unit',
                        'pr.nomor_sr',
                        'pr.gl_account',
                        'pr.cost_center',
                        'pr.uraian_pekerjaan',
                        'pr.pipg',
                        'pr.prioritas',
                        'pr.nomor_pr',
                        'pr.line_pr',
                        'pr.oe_pr',
                        'pr.kontrak',
                        'pr.status',
                        'pr.tanggal_deliv',
                        'po.tanggal_terima_pr',
                        'po.pic',
                        'po.bagian',
                        'po.eprocsap',
                        'po.no_po_sp',
                        'po.nilai_po',
                        'po.tanggal_po',
                        'po.vendor',
                        'po.due_date_po',
                        'po.waktu_proses',
                        'po.sinergi',
                        'po.padi',
                        'po.invoicing',
                        'po.delivered',
                        'po.stb_delivered',
                        'po.invoiced',
                        'po.keterangan',
                    ])->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
                    ->leftJoin('po', function ($join) {
                        $join->on('pr.id', '=', 'po.pr_id');
                    });
            }

            return datatables($query)->addIndexColumn()->addColumn('action', function ($row) {
                $html = '<a href="/pr/' . $row->id . '" class="btn btn-primary btn-xs mr-1"><span style="font-size:smaller; font-weight:bolder"> Detail</span> </a>';
                return $html;
            })->editColumn('tanggal_sr', function ($row) {
                return $row->tanggal_sr ? with(new Carbon($row->tanggal_sr))->format('d/m/Y') : '';
            })->editColumn('tanggal_sr_verif', function ($row) {
                return $row->tanggal_sr_verif ? with(new Carbon($row->tanggal_sr_verif))->format('d/m/Y') : '';
            })->editColumn('tanggal_deliv', function ($row) {
                return $row->tanggal_deliv ? with(new Carbon($row->tanggal_deliv))->format('d/m/Y') : '';
            })->editColumn('tanggal_terima_pr', function ($row) {
                return $row->tanggal_terima_pr ? with(new Carbon($row->tanggal_terima_pr))->format('d/m/Y') : '';
            })->editColumn('tanggal_po', function ($row) {
                return $row->tanggal_po ? with(new Carbon($row->tanggal_po))->format('d/m/Y') : '';
            })->editColumn('due_date_po', function ($row) {
                return $row->due_date_po ? with(new Carbon($row->due_date_po))->format('d/m/Y') : '';
            })->rawColumns(['action'])->toJson(); // Datatables::of($query)->make(true);
        }
        // return datatables()->eloquent(PR::query())
        //     ->addColumn('action', function ($row) {
        //         $html = '<a href="/pr/' . $row->id . '" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Detail ';
        //         return $html;
        //     })->rawColumns(['action'])
        //     ->toJson();
        return view('pr.index', [
            'unit' => Unit::all(),
            'status' => status::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pr.create', [
            'unit' => Unit::all(),
            'status' => status::all(),
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
        if (isset($request->oe_pr)) {
            $pieces = explode(".", $request->oe_pr);
            $request->oe_pr = implode("", $pieces);
        }

        $pr_var = $request->validate([
            'tanggal_sr' => 'required|date_format:Y-m-d',
            'tanggal_sr_verif' => 'nullable|date_format:Y-m-d',
            'nomor_sr' => 'required|max:100',
            'gl_account' => 'max:100',
            'cost_center' => 'max:100',
            'uraian_pekerjaan' => 'required|max:255',
            'nomor_pr' => 'max:100',
            'line_pr' => 'max:100',
            'tanggal_deliv' => 'nullable|date_format:Y-m-d',
        ], [
            'tanggal_sr.required' => 'Kolom tanggal SR tidak boleh kosong',
            'tanggal_sr.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'tanggal_sr_verif.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'nomor_sr.required' => 'Kolom nomor SR tidak boleh kosong',
            'nomor_sr.max' => 'Nomor SR tidak boleh lebih dari 100 karakter',
            'gl_account.max' => 'GL Account tidak boleh lebih dari 100 karakter',
            'cost_center.max' => 'Cost Center tidak boleh lebih dari 100 karakter',
            'uraian_pekerjaan.required' => 'Kolom uraian pekerjaan tidak boleh kosong',
            'uraian_pekerjaan.max' => 'Uraian pekerjaan tidak boleh lebih dari 255 karakter',
            'nomor_pr.max' => 'Nomor PR tidak boleh lebih dari 100 karakter',
            'line_pr.max' => 'Line PR tidak boleh lebih dari 100 karakter',
            'tanggal_deliv.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
        ]);
        $pr_var['tim'] = $request->tim;
        $pr_var['oe_pr'] = $request->oe_pr;
        $pr_var['unit'] = $request->unit;
        $pr_var['pipg'] = $request->pipg;
        $pr_var['prioritas'] = $request->prioritas;
        $pr_var['kontrak'] = $request->kontrak;
        $pr_var['status'] = $request->status;
        $pr_var['last_update_by'] = Auth::user()->name;
        $pr_var['bagian_last_update'] = Auth::user()->roles->first()->name;

        $pr = PR::create($pr_var);

        PO::create([
            'pr_id' => $pr['id'],
            'progress' => 'Belum Diproses',
        ]);

        activity()
            ->withProperties(['pr_id' => $pr->id])
            ->log('Menambah Purchase Requisition (ID: ' . $pr->id . ')');

        toastr()->success('Purchase Requisition dengan untuk SR Nomor ' . $request->nomor_sr . ' Berhasil Ditambahkan!', 'Success');
        return redirect()->route('pr.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PR $pr)
    {
        return view('pr.show', [
            'purchase_requisition' => $pr,
            'unit' => Unit::all(),
            'status' => Status::all(),
            'progress' => Progress::all(),
            'rekanan' => Rekanan::all(),
            'users_log' => ActivityLog::with('user')
                ->where('properties->pr_id', $pr->id)
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
    public function edit(PR $pr)
    {
        return view('pr.edit', [
            'purchase_request' => $pr,
            'unit' => Unit::all(),
            'status' => status::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PR $pr)
    {
        if (isset($request->oe_pr)) {
            $pieces = explode(".", $request->oe_pr);
            $request->oe_pr = implode("", $pieces);
        }

        $pr_var = $request->validate([
            'tanggal_sr' => 'required|date_format:Y-m-d',
            'tanggal_sr_verif' => 'nullable|date_format:Y-m-d',
            'nomor_sr' => 'required|max:100',
            'gl_account' => 'max:100',
            'cost_center' => 'max:100',
            'uraian_pekerjaan' => 'required|max:255',
            'nomor_pr' => 'max:100',
            'line_pr' => 'max:100',
            'tanggal_deliv' => 'nullable|date_format:Y-m-d',
        ], [
            'tanggal_sr.required' => 'Kolom tanggal SR tidak boleh kosong',
            'tanggal_sr.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'tanggal_sr_verif.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'nomor_sr.required' => 'Kolom nomor SR tidak boleh kosong',
            'nomor_sr.max' => 'Nomor SR tidak boleh lebih dari 100 karakter',
            'gl_account.max' => 'GL Account tidak boleh lebih dari 100 karakter',
            'cost_center.max' => 'Cost Center tidak boleh lebih dari 100 karakter',
            'uraian_pekerjaan.required' => 'Kolom uraian pekerjaan tidak boleh kosong',
            'uraian_pekerjaan.max' => 'Uraian pekerjaan tidak boleh lebih dari 255 karakter',
            'nomor_pr.max' => 'Nomor PR tidak boleh lebih dari 100 karakter',
            'line_pr.max' => 'Line PR tidak boleh lebih dari 100 karakter',
            'tanggal_deliv.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
        ]);
        $pr_var['tim'] = $request->tim;
        $pr_var['oe_pr'] = $request->oe_pr;
        $pr_var['unit'] = $request->unit;
        $pr_var['pipg'] = $request->pipg;
        $pr_var['prioritas'] = $request->prioritas;
        $pr_var['kontrak'] = $request->kontrak;
        $pr_var['status'] = $request->status;
        $pr_var['last_update_by'] = Auth::user()->name;
        $pr_var['bagian_last_update'] = Auth::user()->roles->first()->name;

        $pr->update($pr_var);

        activity()
            ->withProperties(['pr_id' => $pr->id])
            ->log('Mengedit Purchase Requisition (ID: ' . $pr->id . ')');

        toastr()->success('Purchase Requisition untuk SR Nomor ' . $pr->nomor_sr . ' Berhasil Diubah!', 'Success');
        return redirect()->route('pr.show', $pr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $pr = PR::find($request->id);
        PR::find($request->id)->delete();

        activity()
            ->withProperties(['pr_id' => $pr->id])
            ->log('Menghapus Purchase Requisition (ID: ' . $pr->id . ')');

        toastr()->success('Purchase Requisition untuk SR Nomor ' . $pr->nomor_sr . ' Berhasil Dihapus!', 'Success');
        return redirect()->route('pr.index');
    }

    //Halaman history import file excel
    public function import_pr_history()
    {
        $importpr = ImportPR::orderBy('id', 'desc')->get();
        return view('pr.import_pr_history', compact('importpr'));
    }

    public function pr_file_download(ImportPR $importpr)
    {
        $pr_file = ImportPR::find($importpr['id']);
        $download = public_path() . '/file_upload/' . $pr_file->file;
        return response()->download($download);
    }

    //Halaman import file excel
    public function import_pr_view()
    {
        return view('pr.import_pr_view');
    }

    //Fungsi import file excel
    public function import_pr(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new PRImport, $request->file('file'));

        $excel = $request->file('file');
        $nama_excel = $excel->getClientOriginalName();
        $excel->move('file_upload', $nama_excel);

        ImportPR::create([
            'file' =>  $nama_excel,
            'created_by' => Auth::user()->name,
            'tanggal' => Carbon::now(),
        ]);

        toastr()->success('Purchase Requisition Berhasil di Import!', 'Success');
        return back();
    }
}
