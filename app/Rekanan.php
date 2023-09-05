<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekanan extends Model
{
    protected $table = 'rekanan';
    protected $fillable = ['id', 'periode', 'kode_rekanan', 'tipe_perusahaan', 'nama_rekanan', 'alamat', 'kota', 'email', 'no_telp', 'no_sos_barang', 'no_sos_jasa', 'status_rekanan', 'no_sap', 'khusus', 'tes_link', 'status', 'last_updated_by', 'created_at', 'updated_at'];

    protected $casts = [
        'no_sos_barang' => 'json',
        'no_sos_jasa' => 'json',
    ];

    public function punishment()
    {
        return $this->hasMany(Punishment::class);
    }
}
