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

            $table->string('iyt_invoice');

            $table->string('bulan');
            $table->string('tahun');

            $table->string('berkas_laporan_rekapitulasi');
            $table->string('berkas_laporan_dokumentasi')->nullable();

            // * jawaban

            $table->string('indikator_1a');
            $table->string('nilai_1a');
            $table->text('komentar_1a');

            $table->string('indikator_1b');
            $table->string('nilai_1b');
            $table->text('komentar_1b');

            $table->string('indikator_2a');
            $table->string('nilai_2a');
            $table->text('komentar_2a');

            $table->string('indikator_2b');
            $table->string('nilai_2b');
            $table->text('komentar_2b');

            $table->string('indikator_2c');
            $table->string('nilai_2c');
            $table->text('komentar_2c');

            $table->string('indikator_2d');
            $table->string('nilai_2d');
            $table->text('komentar_2d');

            $table->string('indikator_3a');
            $table->string('nilai_3a');
            $table->text('komentar_3a');

            $table->string('indikator_3b');
            $table->string('nilai_3b');
            $table->text('komentar_3b');

            $table->string('rekomendasi_reviewer')->default('belum_review');
            $table->text('alasan_reviewer')->default('belum_review');
            $table->string('mentor_id')->nullable();

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
