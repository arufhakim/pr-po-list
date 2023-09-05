<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTable extends Migration
{
    public function up()
    {
        Schema::create('po', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_id');
            $table->date('tanggal_terima_pr')->nullable();
            $table->string('pic', 100)->nullable();
            $table->string('bagian', 100)->nullable();
            $table->string('eprocsap', 100)->nullable();
            $table->string('progress')->nullable();
            $table->string('no_po_sp', 100)->nullable();
            $table->double('nilai_po')->nullable();
            $table->date('tanggal_po')->nullable();
            $table->string('vendor', 100)->nullable();
            $table->date('due_date_po')->nullable();
            $table->string('waktu_proses', 100)->nullable();
            $table->string('sinergi', 100)->nullable();
            $table->string('padi', 100)->nullable();
            $table->double('invoicing')->nullable();
            $table->string('delivered', 100)->nullable();
            $table->string('stb_delivered', 100)->nullable();
            $table->string('invoiced', 100)->nullable();
            $table->string('keterangan')->nullable();
            $table->string('last_update_by', 100)->nullable();
            $table->string('bagian_last_update', 100)->nullable();
            $table->foreign('pr_id')->references('id')->on('pr')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('po');
    }
}
