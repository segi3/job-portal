<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIytMentoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iyt_mentorings', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->default('Topik Mentoring');
            $table->date('tgl_mentoring');
            $table->string('dokumentasi')->nullable();
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
        Schema::dropIfExists('iyt_mentorings');
    }
}
