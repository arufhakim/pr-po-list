<?php

namespace App\Http\Controllers;

use App\PO;
use App\Rekanan;
use App\ImportV;
use App\Punishment;
use App\ActivityLog;
use Illuminate\Http\Request;
use App\Imports\RekananImport;
use App\Keluhan;
use App\SoS;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class RekananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approved');
        $this->middleware('role:Admin|Jasa Pabrik|Jasa Non Pabrik|Jasa Distribusi & Pemasaran|Jasa Investasi EPC');
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $query = Rekanan::query()
                    ->select([
                        'rekanan.id',
                        'rekanan.periode',
                        'rekanan.kode_rekanan',
                        'rekanan.tipe_perusahaan',
                        'rekanan.nama_rekanan',
                        'rekanan.alamat',
                        'rekanan.kota',
                        'rekanan.email',
                        'rekanan.no_telp',
                        'rekanan.no_sos_barang',
                        'rekanan.no_sos_jasa',
                        'rekanan.status_rekanan',
                        'rekanan.no_sap',
                        'rekanan.khusus',
                        'rekanan.tes_link',
                        'rekanan.status',
                        'rekanan.last_updated_by',
                    ])->whereBetween('rekanan.periode', array($request->from_date, $request->to_date));
            } else {
                $query = Rekanan::query()
                    ->select([
                        'rekanan.id',
                        'rekanan.periode',
                        'rekanan.kode_rekanan',
                        'rekanan.tipe_perusahaan',
                        'rekanan.nama_rekanan',
                        'rekanan.alamat',
                        'rekanan.kota',
                        'rekanan.email',
                        'rekanan.no_telp',
                        'rekanan.no_sos_barang',
                        'rekanan.no_sos_jasa',
                        'rekanan.status_rekanan',
                        'rekanan.no_sap',
                        'rekanan.khusus',
                        'rekanan.tes_link',
                        'rekanan.status',
                        'rekanan.last_updated_by',
                    ]);
            }

            return datatables($query)->addIndexColumn()->addColumn('action', function ($row) {
                $html = '<a href="' . route('rekanan.show', $row->id) . '" class="btn btn-primary btn-xs mr-1"><span style="font-size:smaller; font-weight:bolder"> Detail</span> </a>';
                return $html;
            })->editColumn('periode', function ($row) {
                return $row->periode ? with(new Carbon($row->periode))->format('d/m/Y') : '';
            })->rawColumns(['action'])->toJson();
        }
        return view('rekanan.index', [
            'no_sos_barang' => SoS::all(),
            'no_sos_jasa' => SoS::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rekanan.create', [
            'no_sos_barang' => SoS::all(),
            'no_sos_jasa' => SoS::all(),
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
        $rekanan_var = $request->validate([
            'periode' => 'required|date_format:Y-m-d',
            'kode_rekanan' => 'max:50',
            'tipe_perusahaan' => 'max:50',
            'nama_rekanan' => 'required|max:100',
            'alamat' => 'max:255',
            'kota' => 'max:100',
            'email' => 'email|max:100',
            'no_telp' => 'digits_between:7,13|numeric|nullable',
            'no_sos_barang' => 'max:100',
            'no_sos_jasa' => 'max:100',
            'status_rekanan' => 'max:100',
            'no_sap' => 'max:50',
            'khusus' => 'max:50',
            'tes_link' => 'max:255',
            'status' => 'required|max:50',
        ], [
            'periode.required' => 'Kolom periode tidak boleh kosong',
            'periode.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'kode_rekanan.max' => 'Kolom kode rekanan tidak boleh lebih dari 50 karakter',
            'tipe_perusahaan.max' => 'Tipe perusahaan tidak boleh lebih dari 50 karakter',
            'nama_rekanan.required' => 'Kolom nama rekanan tidak boleh kosong',
            'nama_rekanan.max' => 'Nama rekanan tidak boleh lebih dari 100 karakter',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter',
            'kota.max' => 'Alamat tidak boleh lebih dari 100 karakter',
            'email.email' => 'Email harus merupakan email yang valid',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter',
            'no_telp.digits_between' => 'No. Telp tidak boleh lebih dari 13 karakter',
            'no_telp.numeric' => 'No. Telp harus berupa angka',
            'no_sos_barang.max' => 'No SoS Barang tidak boleh lebih dari 100 karakter',
            'no_sos_jasa.max' => 'No SoS Jasa tidak boleh lebih dari 100 karakter',
            'status_rekanan.max' => 'Status rekanan tidak boleh lebih dari 100 karakter',
            'no_sap.max' => 'No SAP tidak boleh lebih dari 50 karakter',
            'khusus.max' => 'Khusus tidak boleh lebih dari 50 karakter',
            'tes_link.max' => 'Test Link tidak boleh lebih dari 255 karakter',
            'status.required' => 'Kolom status tidak boleh kosong',
            'status.max' => 'Status tidak boleh lebih dari 50 karakter',
        ]);

        if (isset($rekanan_var['no_sos_barang'])) {
            $sos_barang = $request->no_sos_barang;
            $barang = implode(',', $sos_barang);

            $rekanan_var['no_sos_barang'] = $barang;
        }

        if (isset($rekanan_var['no_sos_jasa'])) {
            $sos_jasa = $request->no_sos_jasa;
            $jasa = implode(',', $sos_jasa);

            $rekanan_var['no_sos_jasa'] = $jasa;
        }

        $rekanan_var['last_updated_by'] = Auth::user()->name;
        $rekanan = Rekanan::create($rekanan_var);

        activity()
            ->withProperties(['rekanan_id' => $rekanan->id])
            ->log('Menambah Rekanan ' . $request->nama_rekanan);

        toastr()->success('Rekanan ' . $request->nama_rekanan . ' Berhasil Ditambahkan!', 'Success');
        return redirect()->route('rekanan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rekanan $rekanan)
    {
        if (isset($rekanan['no_sos_barang'])) {
            $rekanan['no_sos_barang'] = (explode(",", $rekanan['no_sos_barang']));
        }
        if (isset($rekanan['no_sos_jasa'])) {
            $rekanan['no_sos_jasa'] = (explode(",", $rekanan['no_sos_jasa']));
        }
        return view('rekanan.show', [
            'rekanan' => $rekanan,
            'no_sos_barang' => SoS::all(),
            'no_sos_jasa' => SoS::all(),
            'users_log' => ActivityLog::with('user')
                ->where('properties->rekanan_id', $rekanan->id)
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
    public function edit(Rekanan $rekanan)
    {
        return view('rekanan.edit', [
            'rekanan' => $rekanan,
            'no_sos_barang' => SoS::all(),
            'no_sos_jasa' => SoS::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekanan $rekanan)
    {
        $rekanan_var = $request->validate([
            'periode' => 'required|date_format:Y-m-d',
            'kode_rekanan' => 'max:50',
            'tipe_perusahaan' => 'max:50',
            'nama_rekanan' => 'required|max:100',
            'alamat' => 'max:255',
            'kota' => 'max:100',
            'email' => 'email|max:100',
            'no_telp' => 'digits_between:7,13|numeric|nullable',
            'no_sos_barang' => 'max:100',
            'no_sos_jasa' => 'max:100',
            'status_rekanan' => 'max:100',
            'no_sap' => 'max:50',
            'khusus' => 'max:50',
            'tes_link' => 'max:255',
            'status' => 'required|max:50',
        ], [
            'periode.required' => 'Kolom periode tidak boleh kosong',
            'periode.date_format' => 'Format penulisan tanggal: YYYY-MM-DD (2020-01-30)',
            'kode_rekanan.max' => 'Kolom kode rekanan tidak boleh lebih dari 50 karakter',
            'tipe_perusahaan.max' => 'Tipe perusahaan tidak boleh lebih dari 50 karakter',
            'nama_rekanan.required' => 'Kolom nama rekanan tidak boleh kosong',
            'nama_rekanan.max' => 'Nama rekanan tidak boleh lebih dari 100 karakter',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter',
            'kota.max' => 'Alamat tidak boleh lebih dari 100 karakter',
            'email.email' => 'Email harus merupakan email yang valid',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter',
            'no_telp.digits_between' => 'No. Telp tidak boleh lebih dari 13 karakter',
            'no_telp.numeric' => 'No. Telp harus berupa angka',
            'no_sos_barang.max' => 'No SoS Barang tidak boleh lebih dari 100 karakter',
            'no_sos_jasa.max' => 'No SoS Jasa tidak boleh lebih dari 100 karakter',
            'status_rekanan.max' => 'Status rekanan tidak boleh lebih dari 100 karakter',
            'no_sap.max' => 'No SAP tidak boleh lebih dari 50 karakter',
            'khusus.max' => 'Khusus tidak boleh lebih dari 50 karakter',
            'tes_link.max' => 'Test Link tidak boleh lebih dari 255 karakter',
            'status.required' => 'Kolom status tidak boleh tidak boleh kosong',
            'status.max' => 'Status tidak boleh lebih dari 50 karakter',
        ]);

        if (isset($rekanan_var['no_sos_barang'])) {
            $sos_barang = $request->no_sos_barang;
            $barang = implode(',', $sos_barang);

            $rekanan_var['no_sos_barang'] = $barang;
        }

        if (isset($rekanan_var['no_sos_jasa'])) {
            $sos_jasa = $request->no_sos_jasa;
            $jasa = implode(',', $sos_jasa);

            $rekanan_var['no_sos_jasa'] = $jasa;
        }

        $rekanan_var['last_updated_by'] = Auth::user()->name;
        $rekanan->update($rekanan_var);

        activity()
            ->withProperties(['rekanan_id' => $rekanan->id])
            ->log('Mengedit Rekanan ' . $request->nama_rekanan);

        toastr()->success('Rekanan ' . $request->nama_rekanan . ' Berhasil Diubah!', 'Success');
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
        $rekanan = Rekanan::find($request->id);
        $purchase_order = PO::all();
        $po_item = count($purchase_order);
        $i = 0;

        foreach ($purchase_order as $po) {
            if ($rekanan->nama_rekanan == $po->vendor) {
                toastr()->error('Tidak dapat Menghapus Rekanan ' . $rekanan->nama_rekanan . '!', 'Error');
                return redirect()->back();
                break;
            } else {
                if (++$i === $po_item) {
                    $rekanan->delete();

                    activity()
                        ->withProperties(['rekanan_id' => $rekanan->id])
                        ->log('Mengapus Rekanan ' . $rekanan->nama_rekanan);

                    toastr()->success('Rekanan ' . $rekanan->nama_rekanan . ' Berhasil Dihapus!', 'Success');
                    return redirect()->route('rekanan.index');
                    break;
                }
                continue;
            }
        }
    }

    public function import_vendor_history()
    {
        $importv = ImportV::orderBy('tanggal', 'desc')->get();
        return view('rekanan.import_vendor_history', compact('importv'));
    }

    public function vendor_file_download(ImportV $importv)
    {
        $vendor_file = ImportV::find($importv['id']);
        $download = public_path() . '/file_upload/' . $vendor_file->file;
        return response()->download($download);
    }

    public function import_vendor_view()
    {
        return view('rekanan.import_vendor_view');
    }

    public function import_vendor(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        Excel::import(new RekananImport, $request->file('file'));

        $excel = $request->file('file');
        $nama_excel = $excel->getClientOriginalName();
        $excel->move('file_upload', $nama_excel);

        ImportV::create([
            'file' =>  $nama_excel,
            'created_by' => Auth::user()->name,
            'tanggal' => Carbon::now(),
        ]);

        toastr()->success('Daftar Rekanan Berhasil di Import!', 'Success');
        return back();
    }

    public function dashboard(Request $request)
    {
        //Sorting Tanggal
        $date_start = $request->tanggal_awal ?? date('Y-m-d', strtotime('first day of january this year'));
        $date_end = $request->tanggal_akhir ?? date('Y-m-d');


        $tahun = Punishment::select(DB::raw('DISTINCT YEAR(tanggal_mulai) as year'))
            ->where('jenis_hukuman', 'Suspend')
            ->groupBy(DB::raw("Year(tanggal_mulai)"))
            ->orderBy(DB::raw("Year(tanggal_mulai)"), 'asc')
            ->pluck('year');

        $suspend = Punishment::select(DB::raw("count(tanggal_mulai) as count"))
            ->where('jenis_hukuman', 'Suspend')
            ->groupBy(DB::raw("Year(tanggal_mulai)"))
            ->orderBy(DB::raw("Year(tanggal_mulai)"), 'asc')
            ->pluck('count');

        $year = Punishment::select(DB::raw('DISTINCT YEAR(tanggal_mulai) as year'))
            ->where('jenis_hukuman', 'Blacklist')
            ->groupBy(DB::raw("Year(tanggal_mulai)"))
            ->orderBy(DB::raw("Year(tanggal_mulai)"), 'asc')
            ->pluck('year');

        $blacklist = Punishment::select(DB::raw("count(tanggal_mulai) as count"))
            ->where('jenis_hukuman', 'Blacklist')
            ->groupBy(DB::raw("Year(tanggal_mulai)"))
            ->orderBy(DB::raw("Year(tanggal_mulai)"), 'asc')
            ->pluck('count');

        $vendor = Rekanan::count();

        $aktif = Rekanan::select(DB::raw("count(nama_rekanan) as count"))
            ->where('status', 'Aktif')
            ->pluck('count');

        $nonaktif = Rekanan::select(DB::raw("count(nama_rekanan) as count"))
            ->where('status', 'Non Aktif')
            ->pluck('count');

        $jumlah_rekanan_baru = Rekanan::whereBetween('periode', array($date_start, $date_end))
            ->count();

        $jumlah_rekanan_terdaftar = Rekanan::whereBetween('periode', array($date_start, $date_end))
            ->where('status_rekanan', 'Registered')
            ->count();

        $jumlah_rekanan_onprogress = Rekanan::whereBetween('periode', array($date_start, $date_end))
            ->where('status_rekanan', 'Unregistered')
            ->count();

        //REALISASI PR (ITEM)
        $grafik_rekanan_baru_tahun = DB::table('rekanan')->select(DB::raw('DISTINCT MONTH(periode) as month, YEAR(periode) as year'))
            ->whereBetween('periode', array($date_start, $date_end))
            ->orderBy(DB::raw("Month(periode)"), 'asc')
            ->orderBy(DB::raw("Year(periode)"), 'asc')
            ->get();

        $month_arr_rekanan = [];
        foreach ($grafik_rekanan_baru_tahun as $months) {
            switch ($months->month) {
                case 1:
                    $month = 'Jan';
                    break;
                case 2:
                    $month = 'Feb';
                    break;
                case 3:
                    $month = 'Mar';
                    break;
                case 4:
                    $month = 'Apr';
                    break;
                case 5:
                    $month = 'Mei';
                    break;
                case 6:
                    $month = 'Jun';
                    break;
                case 7:
                    $month = 'Jul';
                    break;
                case 8:
                    $month = 'Agu';
                    break;
                case 9:
                    $month = 'Sep';
                    break;
                case 10:
                    $month = 'Okt';
                    break;
                case 11:
                    $month = 'Nov';
                    break;
                case 12:
                    $month = 'Des';
                    break;
            };
            $month_arr_rekanan[] = $month . ' ' . $months->year;
        };

        $grafik_rekanan_baru = Rekanan::select(DB::raw("count(periode) as count"))
            ->whereBetween('periode', array($date_start, $date_end))
            ->groupBy(DB::raw("Month(periode)"))
            ->groupBy(DB::raw("Year(periode)"))
            ->orderBy(DB::raw("Month(periode)"), 'asc')
            ->orderBy(DB::raw("Year(periode)"), 'asc')
            ->pluck('count');

        $rekanan_tabel = Rekanan::whereBetween('periode', array($date_start, $date_end))->get();
        $sos = Sos::all();

        return view('rekanan.dashboard', compact(
            'tahun',
            'suspend',
            'year',
            'blacklist',
            'vendor',
            'aktif',
            'nonaktif',
            'jumlah_rekanan_baru',
            'jumlah_rekanan_terdaftar',
            'jumlah_rekanan_onprogress',
            'month_arr_rekanan',
            'grafik_rekanan_baru',
            'rekanan_tabel',
            'sos',
            'date_start',
            'date_end',
        ));
    }

    public function pelayanan(Request $request)
    {
        //Sorting Tanggal
        $date_start = $request->tanggal_awal ?? date('Y-m-d', strtotime('first day of january this year'));
        $date_end = $request->tanggal_akhir ?? date('Y-m-d');

        $total_penyampaian = Keluhan::whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->count();
        $total_pelayanan = Keluhan::whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Pelayanan')
            ->count();
        $total_keluhan = Keluhan::whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Keluhan')
            ->count();

        //Jumlah Pelayanan
        $pelayanan_tahun = DB::table('keluhan')->select(DB::raw('DISTINCT MONTH(tanggal_pelaporan) as month, YEAR(tanggal_pelaporan) as year'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Pelayanan')
            ->orderBy(DB::raw("Month(tanggal_pelaporan)"), 'asc')
            ->orderBy(DB::raw("Year(tanggal_pelaporan)"), 'asc')
            ->get();

        $month_arr_pelayanan = [];
        foreach ($pelayanan_tahun as $months) {
            switch ($months->month) {
                case 1:
                    $month = 'Jan';
                    break;
                case 2:
                    $month = 'Feb';
                    break;
                case 3:
                    $month = 'Mar';
                    break;
                case 4:
                    $month = 'Apr';
                    break;
                case 5:
                    $month = 'Mei';
                    break;
                case 6:
                    $month = 'Jun';
                    break;
                case 7:
                    $month = 'Jul';
                    break;
                case 8:
                    $month = 'Agu';
                    break;
                case 9:
                    $month = 'Sep';
                    break;
                case 10:
                    $month = 'Okt';
                    break;
                case 11:
                    $month = 'Nov';
                    break;
                case 12:
                    $month = 'Des';
                    break;
            };
            $month_arr_pelayanan[] = $month . ' ' . $months->year;
        };

        $pelayanan_grafik = Keluhan::select(DB::raw("count(tanggal_pelaporan) as count"))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Pelayanan')
            ->groupBy(DB::raw("Month(tanggal_pelaporan)"))
            ->groupBy(DB::raw("Year(tanggal_pelaporan)"))
            ->orderBy(DB::raw("Month(tanggal_pelaporan)"), 'asc')
            ->orderBy(DB::raw("Year(tanggal_pelaporan)"), 'asc')
            ->pluck('count');

        //Kategori Pelayanan
        $pelayanan_tahun = DB::table('keluhan')->select(DB::raw('DISTINCT kategori as kat'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Pelayanan')
            ->orderBy('kategori', 'asc')
            ->pluck('kat');

        $pelayanan_tahun_data = DB::table('keluhan')->select(DB::raw('count(kategori) as count'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Pelayanan')
            ->groupBy('kategori')
            ->orderBy('kategori', 'asc')
            ->pluck('count');

        //Jumlah keluhan
        $keluhan_tahun = DB::table('keluhan')->select(DB::raw('DISTINCT MONTH(tanggal_pelaporan) as month, YEAR(tanggal_pelaporan) as year'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Keluhan')
            ->orderBy(DB::raw("Month(tanggal_pelaporan)"), 'asc')
            ->orderBy(DB::raw("Year(tanggal_pelaporan)"), 'asc')
            ->get();

        $month_arr_keluhan = [];
        foreach ($keluhan_tahun as $months) {
            switch ($months->month) {
                case 1:
                    $month = 'Jan';
                    break;
                case 2:
                    $month = 'Feb';
                    break;
                case 3:
                    $month = 'Mar';
                    break;
                case 4:
                    $month = 'Apr';
                    break;
                case 5:
                    $month = 'Mei';
                    break;
                case 6:
                    $month = 'Jun';
                    break;
                case 7:
                    $month = 'Jul';
                    break;
                case 8:
                    $month = 'Agu';
                    break;
                case 9:
                    $month = 'Sep';
                    break;
                case 10:
                    $month = 'Okt';
                    break;
                case 11:
                    $month = 'Nov';
                    break;
                case 12:
                    $month = 'Des';
                    break;
            };
            $month_arr_keluhan[] = $month . ' ' . $months->year;
        };

        $keluhan_grafik = Keluhan::select(DB::raw("count(tanggal_pelaporan) as count"))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Keluhan')
            ->groupBy(DB::raw("Month(tanggal_pelaporan)"))
            ->groupBy(DB::raw("Year(tanggal_pelaporan)"))
            ->orderBy(DB::raw("Month(tanggal_pelaporan)"), 'asc')
            ->orderBy(DB::raw("Year(tanggal_pelaporan)"), 'asc')
            ->pluck('count');

        //Kategori Pelayanan
        $keluhan_tahun = DB::table('keluhan')->select(DB::raw('DISTINCT kategori as kat'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Keluhan')
            ->orderBy('kategori', 'asc')
            ->pluck('kat');

        $keluhan_tahun_data = DB::table('keluhan')->select(DB::raw('count(kategori) as count'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->where('pelayanan_keluhan', 'Keluhan')
            ->groupBy('kategori')
            ->orderBy('kategori', 'asc')
            ->pluck('count');

        //Kategori Pelayanan
        $media_kat = DB::table('keluhan')->select(DB::raw('DISTINCT media_penyampaian_keluhan as kat'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->orderBy('media_penyampaian_keluhan', 'asc')
            ->pluck('kat');

        $media_count = DB::table('keluhan')->select(DB::raw('count(media_penyampaian_keluhan) as count'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->groupBy('media_penyampaian_keluhan')
            ->orderBy('media_penyampaian_keluhan', 'asc')
            ->pluck('count');

        //Rekanan
        $rekanan_gb = DB::table('keluhan')->select(DB::raw('DISTINCT nama_rekanan as nama'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->orderBy('nama_rekanan', 'asc')
            ->pluck('nama');

        $rekanan_gb_count = DB::table('keluhan')->select(DB::raw('count(nama_rekanan) as count'))
            ->whereBetween('tanggal_pelaporan', array($date_start, $date_end))
            ->groupBy('nama_rekanan')
            ->orderBy('nama_rekanan', 'asc')
            ->pluck('count');

        return view('laporan.pelayanan_rekanan', compact(
            'total_penyampaian',
            'total_pelayanan',
            'total_keluhan',
            'month_arr_pelayanan',
            'pelayanan_grafik',
            'pelayanan_tahun',
            'pelayanan_tahun_data',
            'month_arr_keluhan',
            'keluhan_grafik',
            'keluhan_tahun',
            'keluhan_tahun_data',
            'media_kat',
            'media_count',
            'date_start',
            'rekanan_gb',
            'rekanan_gb_count',
            'date_end'
        ));
    }
}
