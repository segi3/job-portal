<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_investasi');
            $table->bigInteger('employer_id')->nullable()->unsigned();
            $table->string('status', 1)->default('0');
            $table->string('status_tempo', 1)->default('0');
            $table->string('bank');
            $table->string('no_rekening');
            $table->text('deskripsi_bisnis');
            $table->integer('roi_top');
            $table->integer('roi_bot');
            $table->integer('lembar_total');
            $table->integer('lembar_terbeli');
            $table->integer('harga_saham');
            $table->date('tgl_jatuh_tempo');
            $table->string('berkas_proposal_investasi');
            $table->string('berkas_laporan_keuangan');
            $table->bigInteger('admin_id')->nullable()->unsigned();

            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('investasi');
    }
}
