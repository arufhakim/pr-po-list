<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $table = 'keluhan';
    protected $fillable = ['id', 'tanggal_pelaporan', 'nama_rekanan', 'deskripsi', 'media_penyampaian_keluhan', 'evidence', 'tanggal_close', 'keterangan', 'kategori', 'pelayanan_keluhan', 'last_updated_by', 'created_at', 'updated_at'];
}
