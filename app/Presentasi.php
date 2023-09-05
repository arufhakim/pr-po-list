<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentasi extends Model
{
    protected $table = 'presentasi';
    protected $fillable = ['id', 'tipe_perusahaan', 'nama_vendor', 'email_vendor', 'website_vendor','bidang_usaha', 'merk', 'nama_pic', 'email_pic', 'no_hp_pic', 'company_profile', 'katalog', 'surat_permohonan', 'pengalaman_kerja', 'status', 'tanggal_pelaksanaan', 'tempat', 'waktu_pelaksanaan', 'user', 'keterangan', 'body_email', 'tanggal_diajukan', 'tanggal_disetujui', 'created_by', 'created_at', 'updated_at'];
}
