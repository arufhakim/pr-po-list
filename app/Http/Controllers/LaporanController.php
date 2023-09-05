<?php

namespace App\Http\Controllers;

use App\PR;
use App\PO;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approved');
        $this->middleware('role:Admin|Jasa Pabrik|Jasa Non Pabrik|Jasa Distribusi & Pemasaran|Jasa Investasi EPC');
    }

    public function keluhan()
    {
        $date_start = date('Y-m-d', strtotime('first day of january this year'));
        $date_end = date('Y-m-d');

        //REALISASI PR-PO (ITEM) (TAHUN)
        $jumlah_pr = PR::select(DB::raw("count(tanggal_sr) as count"))
            ->whereYear('tanggal_sr', $date_start)
            ->where('status', 'Delivered')
            ->groupBy(DB::raw("Month(tanggal_sr)"))
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('count');

        $jumlah_po = PR::select(DB::raw("count(pr.tanggal_sr) as count"))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('count');

        $get_month_pr = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $get_month_po = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $data_pr = array(null, null, null, null, null, null, null, null, null, null, null, null);
        foreach ($get_month_pr as $index => $month) {
            $data_pr[$month - 1] = $jumlah_pr[$index];
        }

        $data_po = array(null, null, null, null, null, null, null, null, null, null, null, null);
        foreach ($get_month_po as $index => $month) {
            $data_po[$month - 1] = $jumlah_po[$index];
        }

        $tahun = date('Y', strtotime($date_start));
        return view('laporan.keluhan', compact('data_pr', 'data_po'));
    }

    public function pengadaan_jasa(Request $request)
    {
        //Sorting Tanggal
        $date_start = $request->tanggal_awal ?? date('Y-m-d', strtotime('first day of january this year'));
        $date_end = $request->tanggal_akhir ?? date('Y-m-d');

        //Total Nilai PO Sinergi BUMN
        $total_po_bumn = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            //no
            ->where('po.no_po_sp', '!=', '')
            ->where('po.sinergi', 'BUMN')
            ->sum('po.nilai_po');

        //Total Nilai PO Sinergi PI
        $total_po_pi = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            //no
            ->where('po.no_po_sp', '!=', '')
            ->where('po.sinergi', 'PI GROUP')
            ->sum('po.nilai_po');

        //Total Nilai PO Sinergi PG
        $total_po_pg = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            //no
            ->where('po.no_po_sp', '!=', '')
            ->where('po.sinergi', 'PG GROUP')
            ->sum('po.nilai_po');

        //REALISASI NILAI PO PENGADAAN INTERNAL UMKM
        $realisasi_po_internal_umkm = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            //no
            ->where('po.no_po_sp', '!=', '')
            ->where('po.padi', 'Pengadaan Internal UMKM')
            ->sum('po.nilai_po');

        //% REALISASI INTERNAL UMKM TERHADAP KPI CORPORATE //BEDA
        $persen_realisasi_po_internal_umkm = round(($realisasi_po_internal_umkm / 690000000000) * 100, 1);

        //REALISASI NILAI PO PENGADAAN JASA PADI UMKM
        $realisasi_po_padi_umkm = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            //no
            ->where('pr.status', 'Delivered')
            //no
            ->where('po.no_po_sp', '!=', '')
            //no
            ->where('po.padi', 'Pengadaan B2B PaDi UMKM')
            ->sum('po.invoicing');

        //% REALISASI PADI UMKM TERHADAP KPI CORPORATE
        $persen_realisasi_po_padi_umkm = round(($realisasi_po_padi_umkm / 36000000000) * 100, 1);

        //JUMLAH TOTAL ITEM PR
        $item_pr = PR::whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('status', 'Delivered')
            ->count('nomor_pr');

        //JUMLAH TOTAL ITEM PO
        $item_po = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.nomor_pr', '!=', '')
            ->count('po.no_po_sp');

        //% ITEM PR - OK
        if ($item_pr != 0) {
            $persen_item_pr_ok = round(($item_po * 100) / $item_pr, 1);
        } else {
            $persen_item_pr_ok = 0;
        }

        //LEAD TIME ALL PROCESS PO (HARI)
        $lead_time_all_po = DB::table('pr')->select(DB::raw('ROUND(AVG(po.waktu_proses),0) as lead_time'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNotNull('po.waktu_proses')
            //no
            ->where('po.no_po_sp', '!=', '')
            ->pluck('lead_time');

        //LEAD TIME PROCESS PO NON KONTRAK (HARI)
        $lead_time_po_non_kontrak = DB::table('pr')->select(DB::raw('ROUND(AVG(po.waktu_proses),0) as lead_time'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where(function ($query) {
                $query->where('pr.kontrak', 'Non Kontrak (Spot)');
            })
            ->whereNotNull('po.waktu_proses')
            //no
            ->where('po.no_po_sp', '!=', '')
            ->pluck('lead_time');

        //TOTAL NILAI PO
        $total_nilai_po = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.nomor_pr', '!=', '')
            ->sum('po.nilai_po');

        //NILAI EFISIENSI PR-OK
        $total_nilai_po_efisiensi = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNotIn('pr.kontrak', ['Non Kontrak (Induk)', 'Kontrak'])
            ->whereNotNull('po.nilai_po')
            ->sum('po.nilai_po');

        $total_nilai_pr_efisiensi = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNotIn('pr.kontrak', ['Non Kontrak (Induk)', 'Kontrak'])
            ->whereNotNull('po.nilai_po')
            ->sum('pr.oe_pr');

        $total_efisiensi_pr_ok = $total_nilai_pr_efisiensi - $total_nilai_po_efisiensi;


        //% EFISIENSI PR- OK   
        if ($total_nilai_pr_efisiensi != 0) {
            $before = round(($total_nilai_po_efisiensi * 100) / $total_nilai_pr_efisiensi, 2);
            $persen_efisiensi_pr_ok = 100 - $before;
        } else {
            $persen_efisiensi_pr_ok = 0;
        }

        //JUMLAH ITEM PR (NON SP)
        $item_pr_no_sp = PR::whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('status', 'Delivered')
            ->where('kontrak', 'Non Kontrak (Spot)')
            ->count('nomor_pr');

        //JUMLAH ITEM PO (NON SP)
        $item_po_no_sp = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            //no
            ->where('po.no_po_sp', '!=', '')
            ->count('po.no_po_sp');

        //JUMLAH ITEM PO EPROC
        $item_po_no_sp_eproc = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            //no
            ->where('po.no_po_sp', '!=', '')
            ->where('po.eprocsap', 'EPROC')
            ->count('po.no_po_sp');

        //% ITEM PO EPROC
        if ($item_pr_no_sp != 0) {
            $persen_item_po_no_sp_eproc = round(($item_po_no_sp_eproc / $item_pr_no_sp) * 100, 0);
        } else {
            $persen_item_po_no_sp_eproc = 0;
        }

        //LEAD TIME PROCESS PO EPROC (HARI)
        $lead_time_po_eproc = DB::table('pr')->select(DB::raw('ROUND(AVG(po.waktu_proses),0) as lead_time'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.eprocsap', 'EPROC')
            ->whereNotNull('po.waktu_proses')
            ->where('po.no_po_sp', '!=', '')
            ->pluck('lead_time');

        //NILAI PO EPROC
        $nilai_po_eproc = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            //no
            ->where('po.no_po_sp', '!=', '')
            ->where('po.eprocsap', 'EPROC')
            ->sum('po.nilai_po');


        //Tabel
        //Jasa Pabrik
        //JUMLAH PR
        $item_pr_pabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Pabrik')
            ->get()->count();

        //JUMLAH PO
        $item_po_pabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR KONTRAK
        $item_pr_pabrik_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->where('po.bagian', 'Jasa Pabrik')
            ->get()->count();

        //PO KONTRAK
        $item_po_pabrik_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->where('po.bagian', 'Jasa Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (INDUK)
        $item_pr_pabrik_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->where('po.bagian', 'Jasa Pabrik')
            ->get()->count();

        //PO NON KONTRAK (INDUK)
        $item_po_pabrik_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->where('po.bagian', 'Jasa Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (SPOT)
        $item_pr_pabrik_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->where('po.bagian', 'Jasa Pabrik')
            ->get()->count();

        //PO NON KONTRAK (SPOT)
        $item_po_pabrik_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->where('po.bagian', 'Jasa Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //STATUS BLANK
        $status_blank_pabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('pr.kontrak')
            ->whereNull('po.no_po_sp')
            ->where('po.bagian', 'Jasa Pabrik')
            ->count();

        //PR ONPROGRESS
        $no_pr_pabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Pabrik')
            ->count('pr.nomor_pr');

        $no_po_pabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Pabrik')
            ->whereNotNull('po.no_po_sp')
            ->count('po.no_po_sp');

        $pr_on_progress_pabrik = $no_pr_pabrik - $no_po_pabrik;

        //NILAI PO
        $nilai_po_pabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->sum('po.nilai_po');


        //Jasa Non Pabrik
        //JUMLAH PR
        $item_pr_nonpabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->get()->count();

        //JUMLAH PO
        $item_po_nonpabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR KONTRAK
        $item_pr_nonpabrik_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->get()->count();

        //PO KONTRAK
        $item_po_nonpabrik_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (INDUK)
        $item_pr_nonpabrik_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->get()->count();

        //PO NON KONTRAK (INDUK)
        $item_po_nonpabrik_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (SPOT)
        $item_pr_nonpabrik_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->get()->count();

        //PO NON KONTRAK (SPOT)
        $item_po_nonpabrik_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //STATUS BLANK
        $status_blank_nonpabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('pr.kontrak')
            ->whereNull('po.no_po_sp')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->count();

        //PR ONPROGRESS
        $no_pr_nonpabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->count('pr.nomor_pr');

        $no_po_nonpabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->whereNotNull('po.no_po_sp')
            ->count('po.no_po_sp');

        $pr_on_progress_nonpabrik = $no_pr_nonpabrik - $no_po_nonpabrik;

        //NILAI PO
        $nilai_po_nonpabrik = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->sum('po.nilai_po');


        //Jasa Investasi EPC
        //JUMLAH PR
        $item_pr_investasiepc = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->get()->count();

        //JUMLAH PO
        $item_po_investasiepc = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR KONTRAK
        $item_pr_investasiepc_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->get()->count();

        //PO KONTRAK
        $item_po_investasiepc_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (INDUK)
        $item_pr_investasiepc_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->get()->count();

        //PO NON KONTRAK (INDUK)
        $item_po_investasiepc_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (SPOT)
        $item_pr_investasiepc_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->get()->count();

        //PO NON KONTRAK (SPOT)
        $item_po_investasiepc_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //STATUS BLANK
        $status_blank_investasiepc = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('pr.kontrak')
            ->whereNull('po.no_po_sp')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->count();

        //PR ONPROGRESS
        $no_pr_investasiepc = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->count('pr.nomor_pr');

        $no_po_investasiepc = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->whereNotNull('po.no_po_sp')
            ->count('po.no_po_sp');

        $pr_on_progress_investasiepc = $no_pr_investasiepc - $no_po_investasiepc;

        //NILAI PO
        $nilai_po_investasiepc = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Investasi EPC')
            ->where('po.no_po_sp', '!=', '')
            ->sum('po.nilai_po');


        //Jasa Distribusi & Pemasaran
        //JUMLAH PR
        $item_pr_distribusipemasaran = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->get()->count();

        //JUMLAH PO
        $item_po_distribusipemasaran = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR KONTRAK
        $item_pr_distribusipemasaran_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->get()->count();

        //PO KONTRAK
        $item_po_distribusipemasaran_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (INDUK)
        $item_pr_distribusipemasaran_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->get()->count();

        //PO NON KONTRAK (INDUK)
        $item_po_distribusipemasaran_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (SPOT)
        $item_pr_distribusipemasaran_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->get()->count();

        //PO NON KONTRAK (SPOT)
        $item_po_distribusipemasaran_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //STATUS BLANK
        $status_blank_distribusipemasaran = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('pr.kontrak')
            ->whereNull('po.no_po_sp')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->count();

        //PR ONPROGRESS
        $no_pr_distribusipemasaran = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->count('pr.nomor_pr');

        $no_po_distribusipemasaran = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->whereNotNull('po.no_po_sp')
            ->count('po.no_po_sp');

        $pr_on_progress_distribusipemasaran = $no_pr_distribusipemasaran - $no_po_distribusipemasaran;

        //NILAI PO
        $nilai_po_distribusipemasaran = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Distribusi & Pemasaran')
            ->where('po.no_po_sp', '!=', '')
            ->sum('po.nilai_po');


        //Belum Terproses
        //JUMLAH PR
        $item_pr_belumterproses = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('po.bagian')
            ->get()->count();

        //JUMLAH PO
        $item_po_belumterproses = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('po.bagian')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR KONTRAK
        $item_pr_belumterproses_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->whereNull('po.bagian')
            ->get()->count();

        //PO KONTRAK
        $item_po_belumterproses_kontrak = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Kontrak')
            ->whereNull('po.bagian')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (INDUK)
        $item_pr_belumterproses_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->whereNull('po.bagian')
            ->get()->count();

        //PO NON KONTRAK (INDUK)
        $item_po_belumterproses_non_kontrak_induk = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Induk)')
            ->whereNull('po.bagian')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //PR NON KONTRAK (SPOT)
        $item_pr_belumterproses_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->whereNull('po.bagian')
            ->get()->count();

        //PO NON KONTRAK (SPOT)
        $item_po_belumterproses_non_kontrak_spot = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereIn('pr.kontrak', ['Non Kontrak (Spot)', 'SPMK'])
            ->whereNull('po.bagian')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        //STATUS BLANK
        $status_blank_belumterproses = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('pr.kontrak')
            ->whereNull('po.no_po_sp')
            ->whereNull('po.bagian')
            ->count();;

        //PR ONPROGRESS
        $no_pr_belumterproses = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('po.bagian')
            ->count('pr.nomor_pr');

        $no_po_belumterproses = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('po.bagian')
            ->whereNotNull('po.no_po_sp')
            ->count('po.no_po_sp');

        $pr_on_progress_belumterproses = $no_pr_belumterproses - $no_po_belumterproses;

        //NILAI PO
        $nilai_po_belumterproses = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNull('po.bagian')
            ->where('po.no_po_sp', '!=', '')
            ->sum('po.nilai_po');


        //Keseluruhan
        //JUMLAH PR
        $item_pr_keseluruhan = $item_pr_pabrik + $item_pr_nonpabrik + $item_pr_investasiepc + $item_pr_distribusipemasaran + $item_pr_belumterproses;

        //JUMLAH PO
        $item_po_keseluruhan = $item_po_pabrik + $item_po_nonpabrik + $item_po_investasiepc + $item_po_distribusipemasaran + $item_po_belumterproses;

        //PR KONTRAK
        $item_pr_keseluruhan_kontrak =   $item_pr_pabrik_kontrak +  $item_pr_nonpabrik_kontrak +  $item_pr_investasiepc_kontrak +  $item_pr_distribusipemasaran_kontrak + $item_pr_belumterproses_kontrak;

        //PO KONTRAK
        $item_po_keseluruhan_kontrak =  $item_po_pabrik_kontrak +  $item_po_nonpabrik_kontrak +  $item_po_investasiepc_kontrak +  $item_po_distribusipemasaran_kontrak + $item_po_belumterproses_kontrak;

        //PR NON KONTRAK (INDUK)
        $item_pr_keseluruhan_non_kontrak_induk = $item_pr_pabrik_non_kontrak_induk + $item_pr_nonpabrik_non_kontrak_induk + $item_pr_investasiepc_non_kontrak_induk + $item_pr_distribusipemasaran_non_kontrak_induk + $item_pr_belumterproses_non_kontrak_induk;

        //PO NON KONTRAK (INDUK)
        $item_po_keseluruhan_non_kontrak_induk = $item_po_pabrik_non_kontrak_induk + $item_po_nonpabrik_non_kontrak_induk + $item_po_investasiepc_non_kontrak_induk + $item_po_distribusipemasaran_non_kontrak_induk + $item_po_belumterproses_non_kontrak_induk;

        //PR NON KONTRAK (SPOT)
        $item_pr_keseluruhan_non_kontrak_spot = $item_pr_pabrik_non_kontrak_spot + $item_pr_nonpabrik_non_kontrak_spot + $item_pr_investasiepc_non_kontrak_spot + $item_pr_distribusipemasaran_non_kontrak_spot + $item_pr_belumterproses_non_kontrak_spot;

        //PO NON KONTRAK (SPOT)
        $item_po_keseluruhan_non_kontrak_spot = $item_po_pabrik_non_kontrak_spot + $item_po_nonpabrik_non_kontrak_spot + $item_po_investasiepc_non_kontrak_spot + $item_po_distribusipemasaran_non_kontrak_spot + $item_po_belumterproses_non_kontrak_spot;

        //STATUS BLANK
        $status_blank_keseluruhan =  $status_blank_pabrik +  $status_blank_nonpabrik + $status_blank_investasiepc + $status_blank_distribusipemasaran + $status_blank_belumterproses;

        //PR ONPROGRESS
        $pr_on_progress_keseluruhan = $pr_on_progress_pabrik + $pr_on_progress_nonpabrik + $pr_on_progress_investasiepc + $pr_on_progress_distribusipemasaran + $pr_on_progress_belumterproses;

        //NILAI PO
        $nilai_po_keseluruhan =  $nilai_po_pabrik +  $nilai_po_nonpabrik +  $nilai_po_investasiepc +  $nilai_po_distribusipemasaran + $nilai_po_belumterproses;


        //Chart
        //REALISASI PR-PO (ITEM) (TAHUN)
        $jumlah_pr = PR::select(DB::raw("count(tanggal_sr) as count"))
            ->whereYear('tanggal_sr', $date_start)
            ->where('status', 'Delivered')
            ->groupBy(DB::raw("Month(tanggal_sr)"))
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('count');

        $jumlah_po = PR::select(DB::raw("count(pr.tanggal_sr) as count"))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('count');

        $get_month_pr = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $get_month_po = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $data_pr = array(null, null, null, null, null, null, null, null, null, null, null, null);
        foreach ($get_month_pr as $index => $month) {
            $data_pr[$month - 1] = $jumlah_pr[$index];
        }

        $data_po = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($get_month_po as $index => $month) {
            $data_po[$month - 1] = $jumlah_po[$index];
        }

        $tahun = date('Y', strtotime($date_start));

        //REALISASI PR (ITEM)
        $get_month_pr_in = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month, YEAR(tanggal_sr) as year'))
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->get();

        $month_arr_pr = [];
        foreach ($get_month_pr_in as $months) {
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
            $month_arr_pr[] = $month . ' ' . $months->year;
        };

        $jumlah_pr_in = PR::select(DB::raw("count(tanggal_sr) as count"))
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('status', 'Delivered')
            ->groupBy(DB::raw("Year(pr.tanggal_sr)"))
            ->groupBy(DB::raw("Month(tanggal_sr)"))
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('count');

        //REALISASI PO (ITEM)
        $get_month_po_in = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month, YEAR(tanggal_sr) as year'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->get();

        $month_arr_po = [];
        foreach ($get_month_po_in as $months) {
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
            $month_arr_po[] = $month . ' ' . $months->year;
        };

        $jumlah_po_in = PR::select(DB::raw("count(tanggal_sr) as count"))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->groupBy(DB::raw("Year(pr.tanggal_sr)"))
            ->groupBy(DB::raw("Month(tanggal_sr)"))
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('count');

        //REALISASI PR-PO (ITEM) KUMULATIF (TAHUN) 
        $jumlah_pr_cumulative = [];
        $i = 0;
        foreach ($data_pr as $pr) {
            $i += $pr;
            $jumlah_pr_cumulative[] = $i;
        }

        $jumlah_po_cumulative = [];
        $j = 0;
        foreach ($data_po as $po) {
            $j += $po;
            $jumlah_po_cumulative[] = $j;
        }

        //REALISASI PR (ITEM) KUMULATIF    
        $jumlah_pr_cumulative_in = [];
        $x = 0;
        foreach ($jumlah_pr_in as $pr) {
            $x += $pr;
            $jumlah_pr_cumulative_in[] = $x;
        }

        //REALISASI PO (ITEM) KUMULATIF    
        $jumlah_po_cumulative_in = [];
        $y = 0;
        foreach ($jumlah_po_in as $po) {
            $y += $po;
            $jumlah_po_cumulative_in[] = $y;
        }

        //OVERALL LEAD TIME PROCESS PR-PO (HARI)
        $get_month_overall_lead_time = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month, YEAR(tanggal_sr) as year'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->whereNotNull('po.waktu_proses')
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->get();

        $month_arr_overall_lead_time = [];
        foreach ($get_month_overall_lead_time as $months) {
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
            $month_arr_overall_lead_time[] = $month . ' ' . $months->year;
        };

        $lead_time_overall = DB::table('pr')->select(DB::raw('CAST(ROUND(AVG(po.waktu_proses),0) AS INT) as lead_time'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->whereNotNull('po.waktu_proses')
            ->groupBy(DB::raw("Year(pr.tanggal_sr)"))
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Year(pr.tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('lead_time');

        //LEAD TIME PROCESS PR-PO SPOT (HARI)
        $get_month_spot_lead_time = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month, YEAR(tanggal_sr) as year'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.no_po_sp', '!=', '')
            ->whereNotNull('po.waktu_proses')
            ->whereNotNull('po.waktu_proses')
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->get();

        $month_arr_spot_lead_time = [];
        foreach ($get_month_spot_lead_time as $months) {
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
            $month_arr_spot_lead_time[] = $month . ' ' . $months->year;
        };

        $lead_time_spot = DB::table('pr')->select(DB::raw('CAST(ROUND(AVG(po.waktu_proses),0) AS INT) as lead_time'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.no_po_sp', '!=', '')
            ->whereNotNull('po.waktu_proses')
            ->groupBy(DB::raw("Year(pr.tanggal_sr)"))
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Year(pr.tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('lead_time');

        //REALISASI EPROC (ITEM) (TAHUN)
        $jumlah_pr_spot = PR::select(DB::raw("count(tanggal_sr) as count"))
            ->whereYear('tanggal_sr', $date_start)
            ->where('status', 'Delivered')
            ->where('kontrak', 'Non Kontrak (Spot)')
            ->groupBy(DB::raw("Month(tanggal_sr)"))
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('count');

        $jumlah_po_eproc = PR::select(DB::raw("count(pr.tanggal_sr) as count"))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.no_po_sp', '!=', '')
            ->where('po.eprocsap', 'EPROC')
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('count');

        $get_month_pr_spot = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $get_month_po_eproc = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.no_po_sp', '!=', '')
            ->where('po.eprocsap', 'EPROC')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $data_pr_spot = array(null, null, null, null, null, null, null, null, null, null, null, null);
        foreach ($get_month_pr_spot as $index => $month) {
            $data_pr_spot[$month - 1] =  $jumlah_pr_spot[$index];
        }

        $data_po_eproc = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($get_month_po_eproc as $index => $month) {
            $data_po_eproc[$month - 1] = $jumlah_po_eproc[$index];
        }

        //REALISASI EPROC (ITEM) 
        $get_month_pr_spot_in = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month, YEAR(tanggal_sr) as year'))
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->get();

        $month_arr_pr_spot_in = [];
        foreach ($get_month_pr_spot_in as $months) {
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
            $month_arr_pr_spot_in[] = $month . ' ' . $months->year;
        };

        $jumlah_pr_spot_in = PR::select(DB::raw("count(tanggal_sr) as count"))
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('status', 'Delivered')
            ->where('kontrak', 'Non Kontrak (Spot)')
            ->groupBy(DB::raw("Year(pr.tanggal_sr)"))
            ->groupBy(DB::raw("Month(tanggal_sr)"))
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('count');

        //REALISASI EPROC (ITEM) 
        $get_month_po_eproc_in = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month, YEAR(tanggal_sr) as year'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.no_po_sp', '!=', '')
            ->where('po.eprocsap', 'EPROC')
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->get();

        $month_arr_po_eproc_in = [];
        foreach ($get_month_po_eproc_in as $months) {
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
            $month_arr_po_eproc_in[] = $month . ' ' . $months->year;
        };

        $jumlah_po_eproc_in = PR::select(DB::raw("count(pr.tanggal_sr) as count"))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.no_po_sp', '!=', '')
            ->where('po.eprocsap', 'EPROC')
            ->groupBy(DB::raw("Year(pr.tanggal_sr)"))
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('count');

        //LEAD TIME PROCESS PR-PO EPROC (HARI)
        $get_month_eproc_lead_time = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month, YEAR(tanggal_sr) as year'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.no_po_sp', '!=', '')
            ->where('po.eprocsap', 'EPROC')
            ->whereNotNull('po.waktu_proses')
            ->orderBy(DB::raw("Year(tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->get();

        $month_arr_eproc_lead_time = [];
        foreach ($get_month_eproc_lead_time as $months) {
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
            $month_arr_eproc_lead_time[] = $month . ' ' . $months->year;
        };

        $lead_time_eproc = DB::table('pr')->select(DB::raw('CAST(ROUND(AVG(po.waktu_proses),0) AS INT) as lead_time'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.no_po_sp', '!=', '')
            ->where('po.eprocsap', 'EPROC')
            ->whereNotNull('po.waktu_proses')
            ->groupBy(DB::raw("Year(pr.tanggal_sr)"))
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Year(pr.tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('lead_time');

        return view('laporan.pengadaan_jasa', compact(
            'date_start',
            'date_end',
            'total_po_bumn',
            'total_po_pi',
            'total_po_pg',
            'realisasi_po_internal_umkm',
            'persen_realisasi_po_internal_umkm',
            'realisasi_po_padi_umkm',
            'persen_realisasi_po_padi_umkm',
            'item_pr',
            'item_po',
            'persen_item_pr_ok',
            'lead_time_all_po',
            'lead_time_po_non_kontrak',
            'total_nilai_po',
            'total_efisiensi_pr_ok',
            'persen_efisiensi_pr_ok',
            'item_pr_no_sp',
            'item_po_no_sp',
            'item_po_no_sp_eproc',
            'persen_item_po_no_sp_eproc',
            'lead_time_po_eproc',
            'nilai_po_eproc',

            'item_pr_pabrik',
            'item_po_pabrik',
            'item_pr_pabrik_kontrak',
            'item_po_pabrik_kontrak',
            'item_pr_pabrik_non_kontrak_induk',
            'item_po_pabrik_non_kontrak_induk',
            'item_pr_pabrik_non_kontrak_spot',
            'item_po_pabrik_non_kontrak_spot',
            'status_blank_pabrik',
            'pr_on_progress_pabrik',
            'nilai_po_pabrik',

            'item_pr_nonpabrik',
            'item_po_nonpabrik',
            'item_pr_nonpabrik_kontrak',
            'item_po_nonpabrik_kontrak',
            'item_pr_nonpabrik_non_kontrak_induk',
            'item_po_nonpabrik_non_kontrak_induk',
            'item_pr_nonpabrik_non_kontrak_spot',
            'item_po_nonpabrik_non_kontrak_spot',
            'status_blank_nonpabrik',
            'pr_on_progress_nonpabrik',
            'nilai_po_nonpabrik',

            'item_pr_investasiepc',
            'item_po_investasiepc',
            'item_pr_investasiepc_kontrak',
            'item_po_investasiepc_kontrak',
            'item_pr_investasiepc_non_kontrak_induk',
            'item_po_investasiepc_non_kontrak_induk',
            'item_pr_investasiepc_non_kontrak_spot',
            'item_po_investasiepc_non_kontrak_spot',
            'status_blank_investasiepc',
            'pr_on_progress_investasiepc',
            'nilai_po_investasiepc',

            'item_pr_distribusipemasaran',
            'item_po_distribusipemasaran',
            'item_pr_distribusipemasaran_kontrak',
            'item_po_distribusipemasaran_kontrak',
            'item_pr_distribusipemasaran_non_kontrak_induk',
            'item_po_distribusipemasaran_non_kontrak_induk',
            'item_pr_distribusipemasaran_non_kontrak_spot',
            'item_po_distribusipemasaran_non_kontrak_spot',
            'status_blank_distribusipemasaran',
            'pr_on_progress_distribusipemasaran',
            'nilai_po_distribusipemasaran',

            'item_pr_belumterproses',
            'item_po_belumterproses',
            'item_pr_belumterproses_kontrak',
            'item_po_belumterproses_kontrak',
            'item_pr_belumterproses_non_kontrak_induk',
            'item_po_belumterproses_non_kontrak_induk',
            'item_pr_belumterproses_non_kontrak_spot',
            'item_po_belumterproses_non_kontrak_spot',
            'status_blank_belumterproses',
            'pr_on_progress_belumterproses',
            'nilai_po_belumterproses',

            'item_pr_keseluruhan',
            'item_po_keseluruhan',
            'item_pr_keseluruhan_kontrak',
            'item_po_keseluruhan_kontrak',
            'item_pr_keseluruhan_non_kontrak_induk',
            'item_po_keseluruhan_non_kontrak_induk',
            'item_pr_keseluruhan_non_kontrak_spot',
            'item_po_keseluruhan_non_kontrak_spot',
            'status_blank_keseluruhan',
            'pr_on_progress_keseluruhan',
            'nilai_po_keseluruhan',

            'status_blank_keseluruhan',
            'status_blank_pabrik',
            'status_blank_nonpabrik',
            'status_blank_investasiepc',
            'status_blank_distribusipemasaran',
            'status_blank_belumterproses',

            'data_pr',
            'data_po',
            'tahun',

            'month_arr_pr',
            'jumlah_pr_in',

            'month_arr_po',
            'jumlah_po_in',

            'jumlah_pr_cumulative',
            'jumlah_po_cumulative',

            'jumlah_pr_cumulative_in',
            'jumlah_po_cumulative_in',

            'month_arr_overall_lead_time',
            'lead_time_overall',

            'month_arr_spot_lead_time',
            'lead_time_spot',

            'data_pr_spot',
            'data_po_eproc',

            'month_arr_pr_spot_in',
            'jumlah_pr_spot_in',

            'month_arr_po_eproc_in',
            'jumlah_po_eproc_in',

            'month_arr_eproc_lead_time',
            'lead_time_eproc',
        ));
    }
}
