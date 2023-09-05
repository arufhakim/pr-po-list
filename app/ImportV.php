<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportV extends Model
{
    protected $table = 'importv';
    protected $fillable = ['id', 'file', 'created_by', 'tanggal'];
}
