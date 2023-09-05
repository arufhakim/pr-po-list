<?php

namespace App\Imports;

use App\PR;
use App\PO;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class PRImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
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
            'progress' => 'Belum Diproses',
        ]);

        return $pr;
    }
    public function rules(): array
    {
        return [
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
            '*.last_update_by' => 'max:100',
            '*.bagian_last_update' => 'max:100',
        ];
    }

    public function customValidationMessages()
    {
        return [
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
            'last_update_by' => 'Diupload oleh tidak boleh lebih dari 100 karakter',
            'bagian_last_update' => 'Bagian tidak boleh lebih dari 100 karakter',
        ];
    }
}
