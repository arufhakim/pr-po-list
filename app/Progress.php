<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';
    protected $fillable = ['id', 'progress', 'last_updated_by', 'created_at', 'update_at'];
}
