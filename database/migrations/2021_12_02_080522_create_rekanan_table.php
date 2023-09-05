<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekanan', function (Blueprint $table) {
            $table->id();
            $table->date('periode')->nullable();
            $table->string('kode_rekanan', 50)->nullable();
            $table->string('tipe_perusahaan', 50)->nullable();
            $table->string('nama_rekanan', 100);
            $table->string('alamat')->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('no_telp', 13)->nullable();
            $table->string('no_sos_barang', 100)->nullable();
            $table->string('no_sos_jasa', 100)->nullable();
            $table->string('status_rekanan', 100)->nullable();
            $table->string('no_sap', 50)->nullable();
            $table->string('khusus', 50)->nullable();
            $table->string('tes_link')->nullable();
            $table->string('status')->default('aktif');
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
        Schema::dropIfExists('rekanan');
    }
}
