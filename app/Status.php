<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = ['id', 'status', 'last_updated_by', 'created_at', 'update_at'];
}
