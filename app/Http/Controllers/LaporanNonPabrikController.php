<?php

namespace App\Http\Controllers;

use App\PR;
use App\PO;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LaporanNonPabrikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approved');
        $this->middleware('role:Admin|Jasa Pabrik|Jasa Non Pabrik|Jasa Distribusi & Pemasaran|Jasa Investasi EPC');
    }
    
    public function non_pabrik(Request $request)
    {
        //Sorting Tanggal
        $date_start = $request->tanggal_awal ?? date('Y-m-d', strtotime('first day of january this year'));
        $date_end = $request->tanggal_akhir ?? date('Y-m-d');

        //LEAD TIME ALL PROCESS PR-PO DISTRIBUSI PEMASARAN (HARI)
        $lead_time_all_po = DB::table('pr')->select(DB::raw('ROUND(AVG(po.waktu_proses),0) as lead_time'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->whereNotNull('po.waktu_proses')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->pluck('lead_time');

        //LEAD TIME PROCESS PO EPROC DISTRIBUSI PEMASARAN (HARI)
        $lead_time_po_eproc = DB::table('pr')->select(DB::raw('ROUND(AVG(po.waktu_proses),0) as lead_time'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            // kontrak pake apa engga?
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.eprocsap', 'EPROC')
            ->where('po.no_po_sp', '!=', '')
            ->whereNotNull('po.waktu_proses')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->pluck('lead_time');

        //NILAI EFISIENSI PR-OK DISTRIBUSI PEMASARAN
        $total_nilai_po_efisiensi = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNotIn('pr.kontrak', ['Non Kontrak (Induk)', 'Kontrak'])
            ->whereNotNull('po.nilai_po')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->sum('po.nilai_po');

        $total_nilai_pr_efisiensi = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->whereNotIn('pr.kontrak', ['Non Kontrak (Induk)', 'Kontrak'])
            ->whereNotNull('po.nilai_po')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->sum('pr.oe_pr');

        $total_efisiensi_pr_ok = $total_nilai_pr_efisiensi - $total_nilai_po_efisiensi;


        //% EFISIENSI PR- OK 
        if ($total_nilai_pr_efisiensi != 0) {
            $before = round(($total_nilai_po_efisiensi * 100) / $total_nilai_pr_efisiensi, 2);
            $persen_efisiensi_pr_ok = 100 - $before;
        } else {
            $persen_efisiensi_pr_ok = 0;
        }

        //Chart
        //REALISASI PR-PO
        //PR-PO All
        $pr_item = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->get()->count();

        $item_pr = [$pr_item];

        $po_item = PR::leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->where('po.no_po_sp', '!=', '')
            ->get()->count();

        $item_po = [$po_item];

        //PR-PO Tahun
        $jumlah_pr = PR::select(DB::raw("count(tanggal_sr) as count"))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->groupBy(DB::raw("Month(tanggal_sr)"))
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('count');

        $jumlah_po = PR::select(DB::raw("count(pr.tanggal_sr) as count"))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('count');

        $get_month_pr = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $get_month_po = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('po.no_po_sp', '!=', '')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $data_pr = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
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
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('status', 'Delivered')
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->groupBy(DB::raw("Year(pr.tanggal_sr)"))
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Year(pr.tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('lead_time');

        //REALISASI EPROC (ITEM) (TAHUN)
        $jumlah_pr_spot = PR::select(DB::raw("count(tanggal_sr) as count"))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('status', 'Delivered')
            ->where('kontrak', 'Non Kontrak (Spot)')
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('count');

        $get_month_pr_spot = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $get_month_po_eproc = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereYear('tanggal_sr', $date_start)
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.no_po_sp', '!=', '')
            ->where('po.eprocsap', 'EPROC')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->orderBy(DB::raw("Month(tanggal_sr)"), 'asc')
            ->pluck('month');

        $data_pr_spot = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($get_month_pr_spot as $index => $month) {
            $data_pr_spot[$month - 1] =  $jumlah_pr_spot[$index];
        }

        $data_po_eproc = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($get_month_po_eproc as $index => $month) {
            $data_po_eproc[$month - 1] = $jumlah_po_eproc[$index];
        }

        //REALISASI EPROC (ITEM) 
        $get_month_pr_spot_in = DB::table('pr')->select(DB::raw('DISTINCT MONTH(tanggal_sr) as month, YEAR(tanggal_sr) as year'))
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('pr.status', 'Delivered')
            ->where('pr.kontrak', 'Non Kontrak (Spot)')
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->leftJoin('po', 'po.pr_id', '=', 'pr.id')
            ->whereBetween('tanggal_sr', array($date_start, $date_end))
            ->where('status', 'Delivered')
            ->where('kontrak', 'Non Kontrak (Spot)')
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->whereNotNull('po.waktu_proses')
            ->where('po.eprocsap', 'EPROC')
            ->where('po.bagian', 'Jasa Non Pabrik')
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
            ->whereNotNull('po.waktu_proses')
            ->where('po.eprocsap', 'EPROC')
            ->where('po.bagian', 'Jasa Non Pabrik')
            ->groupBy(DB::raw("Year(pr.tanggal_sr)"))
            ->groupBy(DB::raw("Month(pr.tanggal_sr)"))
            ->orderBy(DB::raw("Year(pr.tanggal_sr)"), 'asc')
            ->orderBy(DB::raw("Month(pr.tanggal_sr)"), 'asc')
            ->pluck('lead_time');

        //PR ON PROGRESS
        $pr_progress = DB::table('pr')->leftJoin('po', 'po.pr_id', '=', 'pr.id')
        ->whereBetween('pr.tanggal_sr', array($date_start, $date_end))
        ->where(function($query) {
            $query->where('pr.nomor_pr', null)
                  ->orWhere('po.no_po_sp', null);
        })
        ->where('pr.status', 'Delivered')
        ->where('po.bagian', 'Jasa Non Pabrik')
        ->get();



        return view('laporan.non_pabrik', compact(
            'date_start',
            'date_end',
            'lead_time_all_po',
            'lead_time_po_eproc',
            'total_efisiensi_pr_ok',
            'persen_efisiensi_pr_ok',

            'item_pr',
            'item_po',

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

            'pr_progress'
        ));
    }
}
