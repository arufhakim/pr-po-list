<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentasi', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_vendor', 50);
            $table->string('nama_vendor', 100);
            $table->string('email_vendor', 100)->nullable();
            $table->string('website_vendor', 100)->nullable();
            $table->string('bidang_usaha');
            $table->string('merk', 100)->nullable();
            $table->string('nama_pic', 100);
            $table->string('email_pic', 100);
            $table->string('no_hp_pic', 13);
            $table->string('company_profile')->nullable();
            $table->string('katalog')->nullable();
            $table->string('surat_permohonan')->nullable();
            $table->string('pengalaman_kerja')->nullable();
            $table->string('status', 100)->default('Proses');
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->string('tempat', 100)->nullable();
            $table->time('waktu_pelaksanaan')->nullable();
            $table->string('user', 100)->nullable();
            $table->string('keterangan')->nullable();
            $table->longText('email')->nullable();
            $table->date('tanggal_diajukan')->nullable();
            $table->date('tanggal_disetujui')->nullable();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentasi');
    }
}
