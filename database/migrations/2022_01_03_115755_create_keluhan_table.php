<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluhan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pelaporan');
            $table->string('nama_rekanan', 100);
            $table->string('deskripsi');
            $table->string('media_penyampaian_keluhan', 100);
            $table->string('evidence', 100);
            $table->date('tanggal_close')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('kategori', 100)->nullable();
            $table->string('pelayanan_keluhan', 100)->nullable();
            $table->string('last_updated_by', 100)->nullable();
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
        Schema::dropIfExists('keluhan');
    }
}
