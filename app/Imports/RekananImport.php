<?php

namespace App\Imports;

use App\Rekanan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class RekananImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['alamat']) {

            if (isset($row['periode'])) {
                $row['periode'] = date('Y-m-d', ($row['periode'] - 25569) * 86400);
            } else {
                $row['periode'] = null;
            }

            return new Rekanan([
                'periode' => $row['periode'],
                'kode_rekanan' => $row['kode_rekanan'],
                'tipe_perusahaan' => $row['tipe_perusahaan'],
                'nama_rekanan' => $row['nama_rekanan'],
                'alamat' => $row['alamat'],
                'kota' => $row['kota'],
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
                'no_sos_barang' => $row['no_sos_barang'],
                'no_sos_jasa' => $row['no_sos_jasa'],
                'status_rekanan' => $row['status_rekanan'],
                'no_sap' => $row['no_sap'],
                'khusus' => $row['rekanan_khusus'],
                'tes_link' => $row['tes_link'],
                'status' => $row['status'],
                'last_updated_by' => Auth::user()->name,
            ]);
        }else{
            return 'ok';
        }
    }

    public function rules(): array
    {
        return [
            '*.periode' => 'required|numeric',
            '*.kode_rekanan' => 'max:50',
            '*.tipe_perusahaan' => 'max:50',
            '*.nama_rekanan' => 'required|max:100',
            '*.alamat' => 'max:255',
            '*.kota' => 'max:100',
            '*.email' => 'max:100',
            '*.no_telp' => 'digits_between:7,13|numeric|nullable',
            '*.no_sos_barang' => 'max:100',
            '*.no_sos_jasa' => 'max:100',
            '*.status_rekanan' => 'max:100',
            '*.no_sap' => 'max:50',
            '*.khusus' => 'max:50',
            '*.tes_link' => 'max:255',
            '*.status' => 'required|max:50',
            '*.last_updated_by' => 'max:100',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'periode.required' => 'Kolom periode tidak boleh kosong',
            'periode.numeric' => 'Format cells Excel harus "Date"',
            'kode_rekanan.max' => 'Kolom kode rekanan tidak boleh lebih dari 50 karakter',
            'tipe_perusahaan.max' => 'Tipe perusahaan tidak boleh lebih dari 50 karakter',
            'nama_rekanan.required' => 'Kolom nama rekanan tidak boleh tidak boleh kosong',
            'nama_rekanan.max' => 'Nama rekanan tidak boleh lebih dari 100 karakter',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter',
            'kota.max' => 'Alamat tidak boleh lebih dari 100 karakter',
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
            'last_updated_by.max' => 'Last updated by tidak boleh lebih dari 100 karakter',
        ];
    }
    public function batchSize(): int
    {
        return 500;
    }
}
