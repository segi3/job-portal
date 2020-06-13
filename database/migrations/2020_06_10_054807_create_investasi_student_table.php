<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestasiStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investasi_student', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->nullable()->unsigned();
            $table->bigInteger('investasi_id')->nullable()->unsigned();
            $table->string('status_bayar', 1)->default('0');
            $table->string('status_uang_balik', 1)->default('2');
            $table->integer('lembar_beli');
            $table->string('berkas_ktp');
            $table->string('berkas_bukti_pembayaran');
            $table->date('expired_at');

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('investasi_id')->references('id')->on('investasi')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('investasi_student');
    }
}
