<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    protected $table = 'po';
    protected $fillable = ['id', 'pr_id', 'tanggal_terima_pr', 'pic', 'bagian', 'eprocsap', 'progress', 'no_po_sp', 'nilai_po', 'tanggal_po', 'vendor', 'due_date_po', 'waktu_proses', 'sinergi', 'padi', 'invoicing', 'delivered', 'stb_delivered', 'invoiced', 'keterangan', 'last_update_by', 'bagian_last_update', 'created_at', 'update_at'];

    public function pr()
    {
        return $this->belongsTo(PR::class, 'pr_id');
    }
}
