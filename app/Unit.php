<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $fillable = ['id', 'unit', 'last_updated_by', 'created_at', 'update_at'];
}
