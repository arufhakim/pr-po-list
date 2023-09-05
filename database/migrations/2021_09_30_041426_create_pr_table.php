<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_sr');
            $table->date('tanggal_sr_verif')->nullable();
            $table->string('tim', 100)->nullable();
            $table->string('unit', 100)->nullable();
            $table->string('nomor_sr', 100);
            $table->string('gl_account', 100)->nullable();
            $table->string('cost_center', 100)->nullable();
            $table->string('uraian_pekerjaan');
            $table->string('pipg', 100)->nullable();
            $table->string('prioritas', 100)->nullable();
            $table->string('nomor_pr', 100)->nullable();
            $table->string('line_pr', 100)->nullable();
            $table->double('oe_pr')->nullable();
            $table->string('kontrak', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->date('tanggal_deliv')->nullable();
            $table->string('last_update_by', 100)->nullable();
            $table->string('bagian_last_update', 100)->nullable();
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
        Schema::dropIfExists('pr');
    }
}
