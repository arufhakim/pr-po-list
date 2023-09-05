<?php

namespace App\Http\Controllers;

use App\PR;
use App\PO;
use App\Migrasi;
use App\Progress;
use App\ImportPO;
use App\Rekanan;
use App\ActivityLog;
use App\Imports\POImport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Imports\MigrasiPRPO;

class POController extends Controller
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
                $html = '<a href="/po/' . $row->id . '"class="btn btn-primary btn-xs mr-1"><span style="font-size:smaller; font-weight:bolder"> Detail</span> </a>';
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

        return view('po.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PR $po)
    {
        return view('po.create', [
            'purchase_request' => $po,
            'progress' => Progress::all(),
            'rekanan' => Rekanan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PR $po)
    {
        $po_data = PO::all();
        foreach ($po_data as $pod) {
            if ($pod->pr_id == $po['id']) {
                return redirect()->route('po.show', $po)->with('gagal', 'Data PO untuk PR Nomor ' . $po->nomor_pr . ' Sudah Ditambahkan!');;
                break;
            } else {
                continue;
            }
        }
        $po_var = $request->validate([
            'tanggal_terima_pr' => 'required|date_format:Y-m-d',
            'no_po_sp' => 'max:100',
            'nilai_po' => 'nullable|numeric',
            'tanggal_po' => 'nullable|date_format:Y-m-d',
            'vendor' => 'max:100',
            'due_date_po' => 'nullable|date_format:Y-m-d',
            'padi' => 'max:100',
            'invoicing' => 'nullable|numeric',
            'delivered' => 'max:100',
            'stb_delivered' => 'max:100',
            'invoiced' => 'max:100',
            'keterangan' => 'max:100',
        ], [
            'tanggal_terima_pr.required' => 'Kolom tanggal terima PR tidak boleh kosong',
            'tanggal_terima_pr.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'no_po_sp.max' => 'Nomor PO/Agreement/SP tidak boleh lebih dari 100 karakter',
            'nilai_po.numeric' => 'Nilai PO harus berupa angka',
            'tanggal_po.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'vendor.max' => 'Vendor tidak boleh lebih dari 100 karakter',
            'due_date_po.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'padi.max' => 'Padi tidak boleh lebih dari 100 karakter',
            'invoicing.numeric' => 'Invoicing harus berupa angka',
            'delivered.max' => 'Delivered tidak boleh lebih dari 100 karakter',
            'stb_delivered.max' => 'Still To Be Delivered tidak boleh lebih dari 100 karakter',
            'invoiced.max' => 'Invoiced tidak boleh lebih dari 100 karakter',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 100 karakter',
        ]);
        $po_var['pr_id'] = $po['id'];
        $po_var['pic'] = Auth::user()->name;
        $po_var['bagian'] = Auth::user()->roles->first()->name;
        $po_var['eprocsap'] = $request->eprocsap;
        $po_var['progress'] = $request->progress;
        $po_var['sinergi'] = $request->sinergi;
        $po_var['last_update_by'] = Auth::user()->name;
        $po_var['bagian_last_update'] = Auth::user()->roles->first()->name;

        if (empty($request->tanggal_po)) {
            $po_var['waktu_proses'] = null;
        } else {
            $sec = strtotime($request->tanggal_po) - strtotime($request->tanggal_terima_pr);
            $po_var['waktu_proses'] = $sec / 86400;
        }

        PO::create($po_var);

        return redirect()->route('po.show', $po)->with('success', 'Data PO untuk PR Nomor ' . $po->nomor_pr . ' Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PR $po)
    {
        return view('po.show', [
            'purchase_requisition' => $po,
            'po' => PO::where('pr_id', $po['id'])->first(),
            'progress' => Progress::all(),
            'rekanan' => Rekanan::all(),
            'users_log' => ActivityLog::with('user')
                ->where('properties->pr_id', $po->id)
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
    public function edit(PR $po)
    {
        return view('po.edit', [
            'po' => PO::where('pr_id', $po['id'])->first(),
            'progress' => Progress::all(),
            'rekanan' => Rekanan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PO $po)
    {

        if (isset($request->nilai_po)) {
            $pieces = explode(".", $request->nilai_po);
            $request->nilai_po = implode("", $pieces);
        }

        if (isset($request->invoicing)) {
            $pieces = explode(".", $request->invoicing);
            $request->invoicing = implode("", $pieces);
        }

        $po_var = $request->validate([
            'tanggal_terima_pr' => 'required|date_format:Y-m-d',
            'no_po_sp' => 'max:100',
            'tanggal_po' => 'nullable|date_format:Y-m-d',
            'vendor' => 'max:100',
            'due_date_po' => 'nullable|date_format:Y-m-d',
            'padi' => 'max:100',
            'delivered' => 'max:100',
            'stb_delivered' => 'max:100',
            'invoiced' => 'max:100',
            'keterangan' => 'max:100',
        ], [
            'tanggal_terima_pr.required' => 'Kolom tanggal terima PR tidak boleh kosong',
            'tanggal_terima_pr.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'no_po_sp.max' => 'Nomor PO/Agreement/SP tidak boleh lebih dari 100 karakter',
            'tanggal_po.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'vendor.max' => 'Vendor tidak boleh lebih dari 100 karakter',
            'due_date_po.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'padi.max' => 'Padi tidak boleh lebih dari 100 karakter',
            'delivered.max' => 'Delivered tidak boleh lebih dari 100 karakter',
            'stb_delivered.max' => 'Still To Be Delivered tidak boleh lebih dari 100 karakter',
            'invoiced.max' => 'Invoiced tidak boleh lebih dari 100 karakter',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 100 karakter',
        ]);
        $po_var['pic'] = Auth::user()->name;
        $po_var['bagian'] = Auth::user()->roles->first()->name;
        $po_var['nilai_po'] = $request->nilai_po;
        $po_var['invoicing'] = $request->invoicing;
        $po_var['eprocsap'] = $request->eprocsap;
        $po_var['progress'] = $request->progress;
        $po_var['sinergi'] = $request->sinergi;
        $po_var['last_update_by'] = Auth::user()->name;
        $po_var['bagian_last_update'] = Auth::user()->roles->first()->name;

        if (empty($request->tanggal_po)) {
            $po_var['waktu_proses'] = null;
        } else {
            $sec = strtotime($request->tanggal_po) - strtotime($request->tanggal_terima_pr);
            $po_var['waktu_proses'] = $sec / 86400;
        }

        $po->update($po_var);

        $pr = PR::where('id', $po['pr_id'])->first();

        activity()
            ->withProperties(['pr_id' => $pr->id])
            ->log('Memproses Tender untuk Purchase Requisition dengan ID ' . $pr->id);

        toastr()->success('Proses Tender untuk PR Nomor ' . $po->pr->nomor_pr . ' Berhasil Diupdate!', 'Success');
        return redirect()->route('po.show', [
            'po' => PR::where('id', $po['pr_id'])->first(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function json()
    {
    }

    //Halaman history import file excel
    public function import_po_history()
    {
        $importpo = ImportPO::orderBy('id', 'desc')->get();
        return view('po.import_po_history', compact('importpo'));
    }

    public function po_file_download(ImportPO $importpo)
    {
        $po_file = ImportPO::find($importpo['id']);
        $download = public_path() . '/file_upload/' . $po_file->file;
        return response()->download($download);
    }

    //Halaman import file excel
    public function import_po_view()
    {
        return view('po.import_po_view');
    }

    //Fungsi import file excel
    public function import_po(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $data = Excel::toArray(new POImport, request()->file('file'));

        collect(head($data))
            ->each(function ($row, $key) {

                if (isset($row['tanggal_terima_pr'])) {
                    $row['tanggal_terima_pr'] = date('Y-m-d', ($row['tanggal_terima_pr'] - 25569) * 86400);
                } else {
                    $row['tanggal_terima_pr'] = null;
                }

                if (isset($row['tanggal_po'])) {
                    $row['tanggal_po'] = date('Y-m-d', ($row['tanggal_po'] - 25569) * 86400);
                } else {
                    $row['tanggal_po'] = null;
                }

                if (isset($row['due_date_po'])) {
                    $row['due_date_po'] = date('Y-m-d', ($row['due_date_po'] - 25569) * 86400);
                } else {
                    $row['due_date_po'] = null;
                }

                $row['nilai_po'] = floatval($row['nilai_po']);
                $row['invoicing'] = floatval($row['invoicing']);
                $row['waktu_proses'] = (int) $row['waktu_proses'];

                DB::table('po')
                    ->where('pr_id', $row['id'])
                    ->update(Arr::except($row, ['id']));
            });

        $excel = $request->file('file');
        $nama_excel = $excel->getClientOriginalName();
        $excel->move('file_upload', $nama_excel);

        ImportPO::create([
            'file' =>  $nama_excel,
            'created_by' => Auth::user()->name,
            'tanggal' => Carbon::now(),
        ]);

        toastr()->success('Proses Tender Berhasil di Import!', 'Success');
        return back();
    }

    public function migrasi_list_history()
    {
        $migrasi_list = Migrasi::orderBy('id', 'desc')->get();
        return view('migrasi_list.migrasi_list_history', compact('migrasi_list'));
    }

    public function list_file_download(Migrasi $migrasi)
    {
        $list_file = Migrasi::find($migrasi['id']);
        $download = public_path() . '/file_upload/' . $list_file->file;
        return response()->download($download);
    }

    public function migrasi_list_view()
    {
        return view('migrasi_list.migrasi_list_view');
    }

    public function migrasi_list(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new MigrasiPRPO, $request->file('file'));

        $excel = $request->file('file');
        $nama_excel = $excel->getClientOriginalName();
        $excel->move('file_upload', $nama_excel);

        Migrasi::create([
            'file' =>  $nama_excel,
            'created_by' => Auth::user()->name,
            'tanggal' => Carbon::now(),
        ]);

        toastr()->success('PR-PO List Berhasil Dimigrasi!', 'Success');
        return back();
    }
}
