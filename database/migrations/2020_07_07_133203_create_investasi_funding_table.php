<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestasiFundingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investasi_funding', function (Blueprint $table) {
            $table->id();
            $table->string('nama_investasi');
            $table->bigInteger('investee_id')->nullable()->unsigned();
            $table->string('status', 1)->default('0');
            $table->integer('donasi_target');
            $table->integer('donasi_masuk');
            $table->string('bank');
            $table->string('no_rekening');
            $table->string('atas_nama');
            $table->text('deskripsi_bisnis');
            $table->integer('target');
            $table->date('tgl_jatuh_tempo');
            $table->string('berkas_proposal_investasi');
            $table->string('berkas_laporan_keuangan');
            $table->bigInteger('admin_id')->nullable()->unsigned();

            $table->foreign('investee_id')->references('id')->on('investee')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('investasi_funding');
    }
}
