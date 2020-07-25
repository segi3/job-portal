<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progres_project', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('investee_id')->nullable()->unsigned();
            $table->bigInteger('project_id')->nullable()->unsigned();
            $table->date('tgl');
            $table->string('berkas_laporan');
            $table->text('deskripsi_laporan');
            $table->string('keterangan_tambahan');
            $table->timestamps();
            $table->foreign('investee_id')->references('id')->on('investee')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('project_id')->references('id')->on('investasi_project')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progres_project');
    }
}
