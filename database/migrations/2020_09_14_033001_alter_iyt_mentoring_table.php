<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterIytMentoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('iyt_mentorings', function (Blueprint $table) {
            $table->bigInteger('investasi_iyt_id')->after('id')->nullable()->unsigned();
            $table->foreign('investasi_iyt_id')->references('id')->on('investasi_iyt')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('mentor_id')->after('id')->nullable()->unsigned();
            $table->foreign('mentor_id')->references('id')->on('mentors')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
