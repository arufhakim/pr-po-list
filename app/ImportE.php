<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportE extends Model
{
    protected $table = 'importe';
    protected $fillable = ['id', 'file', 'created_by', 'tanggal'];
}
