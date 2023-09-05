<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punishment extends Model
{
    protected $table = 'punishment';
    protected $fillable = ['id', 'rekanan_id', 'jenis_hukuman', 'jenis_tangguhan', 'catatan_hukuman', 'tanggal_mulai', 'tanggal_selesai', 'tanggal_dibuat', 'tanggal_diubah', 'status', 'keterangan', 'last_updated_by', 'created_at', 'updated_at'];

    public function rekanan()
    {
        return $this->belongsTo(Rekanan::class);
    }
}
