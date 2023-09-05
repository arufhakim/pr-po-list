<?php

namespace App\Imports;

use App\PR;
use App\PO;
use App\Unit;
use App\Status;
use App\Kontrak;
use App\Prioritas;
use App\Progress;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;


class POImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
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


        return new PO([
            'tanggal_terima_pr' => $row['tanggal_terima_pr'],
            'pic' => $row['pic'],
            'bagian' => $row['bagian'],
            'eprocsap' => $row['eprocsap'],
            'progress' => $row['progress'],
            'no_po_sp' => $row['no_po_sp'],
            'nilai_po' => $row['nilai_po'] ?? 0,
            'tanggal_po' => $row['tanggal_po'],
            'vendor' => $row['vendor'],
            'due_date_po' => $row['due_date_po'],
            'waktu_proses' => $row['waktu_proses'],
            'sinergi' => $row['sinergi'],
            'padi' => $row['padi'],
            'invoicing' => $row['invoicing'] ?? 0,
            'delivered' => $row['delivered'],
            'stb_delivered' => $row['stb_delivered'],
            'invoiced' => $row['invoiced'],
            'keterangan' => $row['keterangan'],
            'last_update_by' => Auth::user()->name,
            'bagian_last_update' => Auth::user()->roles->first()->name,
        ]);
    }

    public function rules(): array
    {
        return [
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
            'last_update_by.max' => 'Last update by tidak boleh lebih dari 100 karakter',
            'bagian_last_update.max' => 'Bagian last update tidak boleh lebih dari 100 karakter',
        ];
    }
}
