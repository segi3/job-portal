<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotulensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notulensi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('iyt_id')->nullable()->unsigned();
            $table->foreign('iyt_id')->references('id')->on('investasi_iyt')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('mentoring_id')->nullable()->unsigned();
            $table->foreign('mentoring_id')->references('id')->on('iyt_mentorings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('dokumentasi')->nullable();
            $table->text('notulensi')->nullable()->default('Belum ada Notulensi');
            $table->text('komentar')->nullable()->default('Belum ada Komentar');
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
        Schema::dropIfExists('notulensi');
    }
}
