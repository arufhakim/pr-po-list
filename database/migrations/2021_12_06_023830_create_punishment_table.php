<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePunishmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punishment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rekanan_id');
            $table->string('jenis_hukuman', 50);
            $table->string('jenis_tangguhan', 50)->nullable();
            $table->string('catatan_hukuman');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->date('tanggal_dibuat')->nullable();
            $table->date('tanggal_diubah')->nullable();
            $table->string('status', 50)->default('Punished')->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->string('last_updated_by', 100)->nullable();
            $table->foreign('rekanan_id')->references('id')->on('rekanan')->onDelete('cascade');
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
        Schema::dropIfExists('punishment');
    }
}
