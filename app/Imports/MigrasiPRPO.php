<?php

namespace App\Imports;

use App\PR;
use App\PO;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MigrasiPRPO implements ToModel,  WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //PR
        $row['tanggal_sr'] = date('Y-m-d', ($row['tanggal_sr'] - 25569) * 86400);

        if (isset($row['tanggal_sr_verifikasi'])) {
            $row['tanggal_sr_verifikasi'] = date('Y-m-d', ($row['tanggal_sr_verifikasi'] - 25569) * 86400);
        } else {
            $row['tanggal_sr_verifikasi'] = null;
        }

        if (isset($row['tanggal_delivered'])) {
            $row['tanggal_delivered'] = date('Y-m-d', ($row['tanggal_delivered'] - 25569) * 86400);
        } else {
            $row['tanggal_delivered'] = null;
        }

        $row['oe_pr'] = floatval($row['oe_pr']);

        //PO
        if (isset($row['tanggal_terima_pr'])) {
            $row['tanggal_terima_pr'] = date('Y-m-d', ($row['tanggal_terima_pr'] - 25569) * 86400);
        } else {
            $row['tanggal_terima_pr'] = null;
        }

        if (isset($row['po_date'])) {
            $row['po_date'] = date('Y-m-d', ($row['po_date'] - 25569) * 86400);
        } else {
            $row['po_date'] = null;
        }

        if (isset($row['due_date_po'])) {
            $row['due_date_po'] = date('Y-m-d', ($row['due_date_po'] - 25569) * 86400);
        } else {
            $row['due_date_po'] = null;
        }

        $row['nilai_po'] = floatval($row['nilai_po']);
        $row['invoicing_padi'] = floatval($row['invoicing_padi']);
        $row['waktu_proses'] = (int) $row['waktu_proses'];

        $pr = PR::create([
            'tanggal_sr' => $row['tanggal_sr'],
            'tanggal_sr_verif' => $row['tanggal_sr_verifikasi'],
            'tim' => $row['tim'],
            'unit' => $row['user'],
            'nomor_sr' => $row['nomor_sr'],
            'gl_account' => $row['gl_account'],
            'cost_center' => $row['cost_center'],
            'uraian_pekerjaan' => $row['uraian_pekerjaan'],
            'pipg' => $row['pi/pg'],
            'prioritas' => $row['prioritas'],
            'nomor_pr' => $row['nomor_pr'],
            'line_pr' => $row['line_pr'],
            'oe_pr' => $row['oe_pr'] ?? 0,
            'kontrak' => $row['kontrak/non-kontrak'],
            'status' => $row['status'],
            'tanggal_deliv' => $row['tanggal_delivered'],
            'last_update_by' => Auth::user()->name,
            'bagian_last_update' => Auth::user()->roles->first()->name,
        ]);

        PO::create([
            'pr_id' => $pr['id'],
            'tanggal_terima_pr' => $row['tanggal_terima_pr'],
            'pic' => $row['pic'],
            'bagian' => $row['bagian'],
            'eprocsap' => $row['eproc/sap'],
            'progress' => $row['progress'],
            'no_po_sp' => $row['no_po/agreement/sp'],
            'nilai_po' => $row['nilai_po'] ?? 0,
            'tanggal_po' => $row['po_date'],
            'vendor' => $row['vendor'],
            'due_date_po' => $row['due_date_po'],
            'waktu_proses' => $row['waktu_proses'],
            'sinergi' => $row['sinergi'],
            'padi' => $row['padi_umkm'],
            'invoicing' => $row['invoicing_padi'] ?? 0,
            'delivered' => $row['delivered'],
            'stb_delivered' => $row['still_to_be_delivered'],
            'invoiced' => $row['invoiced'],
            'keterangan' => $row['keterangan'],
            'last_update_by' => Auth::user()->name,
            'bagian_last_update' => Auth::user()->roles->first()->name,
        ]);

        return $pr;
    }

    public function rules(): array
    {
        return [
            //PR
            '*.tanggal_sr' => 'required|numeric',
            '*.tanggal_sr_verif' => 'nullable|numeric',
            '*.tim' => 'max:100',
            '*.unit' => 'max:100',
            '*.nomor_sr' => 'required|max:100',
            '*.gl_account' => 'max:100',
            '*.cost_center' => 'max:100',
            '*.uraian_pekerjaan' => 'required|max:255',
            '*.pipg' => 'max:100',
            '*.prioritas' => 'max:100',
            '*.nomor_pr' => 'max:100',
            '*.line_pr' => 'max:100',
            '*.oe_pr' => 'nullable|numeric',
            '*.kontrak' => 'max:100',
            '*.status' => 'max:100',
            '*.tanggal_deliv' => 'nullable|numeric',
            //PO
            '*.tanggal_terima_pr' => 'nullable|numeric',
            '*.pic' => 'max:100',
            '*.bagian' => 'max:100',
            '*.eprocsap' => 'max:100',
            '*.progress' => 'max:255',
            '*.no_po_sp' => 'max:100',
            '*.nilai_po' => 'nullable|numeric',
            '*.tanggal_po' => 'nullable|numeric',
            '*.vendor' => 'max:100',
            '*.due_date_po' => 'nullable|numeric',
            '*.waktu_proses' => 'nullable|numeric',
            '*.sinergi' => 'max:100',
            '*.padi' => 'max:100',
            '*.invoicing' => 'nullable|numeric',
            '*.delivered' => 'max:100',
            '*.stb_delivered' => 'max:100',
            '*.invoiced' => 'max:100',
            '*.keterangan' => 'max:100',
            '*.last_update_by' => 'max:100',
            '*.bagian_last_update' => 'max:100',
        ];
    }

    public function customValidationMessages()
    {
        return [
            //PR
            'tanggal_sr.required' => 'Kolom tanggal SR tidak boleh kosong',
            'tanggal_sr.numeric' => 'Format cells Excel harus "Date"',
            'tanggal_sr_verif.numeric' => 'Format cells Excel "Date"',
            'tim.max' => 'Tim tidak boleh lebih dari 100 karakter',
            'unit.max' => 'Unit tidak boleh lebih dari 100 karakter',
            'nomor_sr.required' => 'Kolom nomor SR tidak boleh kosong',
            'nomor_sr.max' => 'Nomor SR tidak boleh lebih dari 100 karakter',
            'gl_account.max' => 'GL Account tidak boleh lebih dari 100 karakter',
            'cost_center.max' => 'Cost Center tidak boleh lebih dari 100 karakter',
            'uraian_pekerjaan.required' => 'Kolom uraian pekerjaan tidak boleh kosong',
            'uraian_pekerjaan.max' => 'Uraian pekerjaan tidak boleh lebih dari 255 karakter',
            'pipg.max' => 'PI/PG tidak boleh lebih dari 100 karakter',
            'prioritas.max' => 'Prioritas tidak boleh lebih dari 100 karakter',
            'nomor_pr.max' => 'Nomor PR tidak boleh lebih dari 100 karakter',
            'line_pr.max' => 'Line PR tidak boleh lebih dari 100 karakter',
            'oe_pr.numeric' => 'OE SR harus berupa angka',
            'kontrak.max' => 'Kontrak tidak boleh lebih dari 100 karakter',
            'status.max' => 'Status tidak boleh lebih dari 100 karakter',
            'tanggal_deliv.numeric' => 'Format cells Excel "Date"',
            //PO
            'tanggal_terima_pr.numeric' => 'Format cells Excel harus "Date"',
            'pic.max' => 'PIC tidak boleh lebih dari 100 karakter',
            'bagian.max' => 'Bagian tidak boleh lebih dari 100 karakter',
            'eprocsap.max' => 'EPROC/SAP tidak boleh lebih dari 100 karakter',
            'progress.max' => 'Progress tidak boleh lebih dari 255 karakter',
            'no_po_sp.max' => 'Nomor PO/Agreement/SP tidak boleh lebih dari 100 karakter',
            'nilai_po.numeric' => 'Nilai PO harus berupa angka',
            'tanggal_po.numeric' => 'Format cells Excel harus "Date"',
            'vendor.max' => 'Vendor tidak boleh lebih dari 100 karakter',
            'due_date_po.numeric' => 'Format cells Excel harus "Date"',
            'waktu_proses.numeric' => 'Waktu proses harus berupa angka',
            'sinergi.max' => 'Sinergi tidak boleh lebih dari 100 karakter',
            'padi.max' => 'PaDi UMKM tidak boleh lebih dari 100 karakter',
            'invoicing.numeric' => 'Invoicing harus berupa angka',
            'delivered.max' => 'Delivered tidak boleh lebih dari 100 karakter',
            'stb_delivered.max' => 'Still To Be Delivered tidak boleh lebih dari 100 karakter',
            'invoiced.max' => 'Invoiced tidak boleh lebih dari 100 karakter',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 100 karakter',
            'last_update_by' => 'Diupload oleh tidak boleh lebih dari 100 karakter',
            'bagian_last_update' => 'Bagian tidak boleh lebih dari 100 karakter',
        ];
    }

}
            
