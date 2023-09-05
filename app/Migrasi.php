<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Migrasi extends Model
{
    protected $table = 'migrasi';
    protected $fillable = ['id', 'file', 'created_by', 'tanggal'];
}
