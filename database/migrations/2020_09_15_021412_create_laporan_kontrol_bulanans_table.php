<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanKontrolBulanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_kontrol_bulanan', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('iyt_id')->nullable()->unsigned();
            $table->foreign('iyt_id')->references('id')->on('investasi_iyt')->onDelete('cascade')->onUpdate('cascade');

            $table->string('berkas_laporan_keuangan');
            $table->string('berkas_laporan_dokumentasi')->nullable();

            $table->string('bulan');
            $table->string('tahun');

            // * jawaban

            $table->string('indikator-1a');
            $table->string('nilai-1a');
            $table->text('komentar-1a');

            $table->string('indikator-1b');
            $table->string('nilai-1b');
            $table->text('komentar-1b');

            $table->string('indikator-2a');
            $table->string('nilai-2a');
            $table->text('komentar-2a');

            $table->string('indikator-2b');
            $table->string('nilai-2b');
            $table->text('komentar-2b');

            $table->string('indikator-2c');
            $table->string('nilai-2c');
            $table->text('komentar-2c');

            $table->string('indikator-2d');
            $table->string('nilai-2d');
            $table->text('komentar-2d');

            $table->string('indikator-3a');
            $table->string('nilai-3a');
            $table->text('komentar-3a');

            $table->string('indikator-3b');
            $table->string('nilai-3b');
            $table->text('komentar-3b');

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
        Schema::dropIfExists('laporan_kontrol_bulanan');
    }
}
