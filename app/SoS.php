<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoS extends Model
{
    protected $table = 'sos';
    protected $fillable = ['id', 'deskripsi', 'kode_sos', 'deskripsi_sos', 'last_updated_by', 'created_at', 'updated_at'];
}
