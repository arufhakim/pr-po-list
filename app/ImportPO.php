<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportPO extends Model
{
    protected $table = 'importpo';
    protected $fillable = ['id', 'file', 'created_by', 'tanggal'];
}
 