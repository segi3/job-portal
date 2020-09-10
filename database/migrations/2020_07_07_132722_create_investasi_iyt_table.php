<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestasiIytTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investasi_iyt', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ketua');
            $table->string('invoice_iyt');
            $table->bigInteger('student_id')->nullable()->unsigned();
            $table->string('status', 1)->default('0');
            $table->string('nama_kelompok');
            $table->string('berkas_pitch_desk');
            $table->string('berkas_proposal_bisnis');
            $table->string('tahun_masuk');
            $table->string('tahun_keluar');
            $table->string('kategori');
            $table->integer('semester');
            $table->bigInteger('admin_id')->nullable()->unsigned();
            $table->bigInteger('batch_id')->nullable()->unsigned();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('investasi_iyt');
    }
}
