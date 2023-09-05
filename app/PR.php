<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PR extends Model
{
    protected $table = 'pr';
    protected $fillable = ['id', 'tanggal_sr', 'tanggal_sr_verif', 'tim', 'unit', 'nomor_sr', 'gl_account', 'cost_center', 'uraian_pekerjaan', 'pipg', 'prioritas', 'nomor_pr', 'line_pr', 'oe_pr', 'kontrak', 'status', 'tanggal_deliv', 'last_update_by', 'bagian_last_update', 'created_at', 'update_at'];

    public function po()
    {
        return $this->hasOne(PO::class, 'pr_id');
    }
}
