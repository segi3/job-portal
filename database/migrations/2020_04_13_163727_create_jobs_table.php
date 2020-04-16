<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->string('name');
            $table->string('position');
            $table->text('description');
            $table->string('job_type');
            $table->string('location');
            $table->string('required_skill');
            $table->string('minimal_qualification');
            $table->string('extra_skill')->nullable();
            $table->integer('expected_salary');
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
        Schema::dropIfExists('jobs');
    }
}
