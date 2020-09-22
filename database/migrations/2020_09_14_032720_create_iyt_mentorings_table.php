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

            $table->bigInteger('batch_id')->nullable()->unsigned();
            $table->foreign('batch_id')->references('id')->on('i_y_t_batches')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('mentor_id')->nullable()->unsigned();
            $table->foreign('mentor_id')->references('id')->on('mentors')->onDelete('cascade')->onUpdate('cascade');

            $table->string('judul')->default('Topik Mentoring');
            $table->date('tgl_mentoring');
            $table->string('dokumentasi')->nullable();
            $table->string('notulensi')->nullable();
            $table->string('link')->nullable();
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
