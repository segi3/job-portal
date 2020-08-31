<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default('0');
            $table->string('name');
            $table->string('description');
            $table->string('berkas_verifikasi');
            $table->string('poster');
            $table->string('profil_pembicara');
            $table->string('target');
            $table->string('materi');
            $table->integer('fee');
            $table->date('waktu');
            $table->string('location');
            $table->string('contact_person');
            $table->string('contact_no');
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
        Schema::dropIfExists('seminars');
    }
}
