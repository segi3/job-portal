<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanBulananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_bulanan', function (Blueprint $table) {
            $table->id();

            $table->string('iyt_invoice');

            $table->string('bulan');
            $table->string('tahun');

            $table->string('berkas_laporan_keuangan');
            $table->string('berkas_kwitansi');

            $table->text('indikator_1a');
            $table->text('indikator_1b');
            $table->text('indikator_1c');

            $table->text('indikator_2a');
            $table->text('indikator_2b');
            $table->text('indikator_2c');

            $table->text('indikator_3a');
            $table->text('indikator_3b');
            $table->text('indikator_3c');

            $table->text('indikator_4a');
            $table->text('indikator_4b');
            $table->text('indikator_4c');

            $table->text('indikator_5a');
            $table->text('indikator_5b');
            $table->text('indikator_5c');

            $table->text('indikator_6a');
            $table->text('indikator_6b');
            $table->text('indikator_6c');

            $table->text('indikator_7a');
            $table->text('indikator_7b');
            $table->text('indikator_7c');

            $table->text('indikator_8a');
            $table->text('indikator_8b');
            $table->text('indikator_8c');

            $table->text('indikator_9a');
            $table->text('indikator_9b');
            $table->text('indikator_9c');

            $table->text('indikator_10a');
            $table->text('indikator_10b');
            $table->text('indikator_10c');

            $table->text('indikator_11a');
            $table->text('indikator_11b');
            $table->text('indikator_11c');

            $table->text('indikator_12a');
            $table->text('indikator_12b');
            $table->text('indikator_12c');

            $table->text('indikator_13a');
            $table->text('indikator_13b');
            $table->text('indikator_13c');

            $table->text('indikator_14a');
            $table->text('indikator_14b');
            $table->text('indikator_14c');

            $table->text('indikator_15a');
            $table->text('indikator_15b');
            $table->text('indikator_15c');

            $table->text('indikator_16a');
            $table->text('indikator_16b');
            $table->text('indikator_16c');

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
        Schema::dropIfExists('laporan_bulanan');
    }
}
