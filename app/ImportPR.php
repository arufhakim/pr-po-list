<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportPR extends Model
{
    protected $table = 'importpr';
    protected $fillable = ['id', 'file', 'created_by', 'tanggal'];
}
