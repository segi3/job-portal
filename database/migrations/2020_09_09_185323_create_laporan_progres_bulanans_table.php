<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanProgresBulanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_progres_bulanan', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('iyt_id')->nullable()->unsigned();
            $table->string('berkas_laporan_keuangan');
            $table->string('bulan');
            $table->string('tahun');

            // * jawaban

            $table->text('1a');
            $table->text('1b');
            $table->text('1c');

            $table->text('2a');
            $table->text('2b');
            $table->text('2c');

            $table->text('3a');
            $table->text('3b');
            $table->text('3c');

            $table->text('4a');
            $table->text('4b');
            $table->text('4c');

            $table->text('5a');
            $table->text('5b');
            $table->text('5c');

            $table->text('6a');
            $table->text('6b');
            $table->text('6c');

            $table->text('7a');
            $table->text('7b');
            $table->text('7c');

            $table->text('8a');
            $table->text('8b');
            $table->text('8c');

            $table->text('9a');
            $table->text('9b');
            $table->text('9c');

            $table->text('10a');
            $table->text('10b');
            $table->text('10c');

            $table->text('11a');
            $table->text('11b');
            $table->text('11c');

            $table->text('12a');
            $table->text('12b');
            $table->text('12c');

            $table->text('13a');
            $table->text('13b');
            $table->text('13c');

            $table->text('14a');
            $table->text('14b');
            $table->text('14c');

            $table->text('15a');
            $table->text('15b');
            $table->text('15c');

            $table->text('16a');
            $table->text('16b');
            $table->text('16c');


            $table->foreign('iyt_id')->references('id')->on('investasi_iyt')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('laporan_progres_bulanan');
    }
}
