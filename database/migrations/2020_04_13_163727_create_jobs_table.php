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
            $table->integer('status')->default('0');
            $table->string('name');
            $table->string('position');
            $table->string('kompesasi');
            $table->text('description');
            $table->string('job_type');
            $table->string('location');
            $table->string('required_skill');
            $table->string('minimal_qualification');
            $table->string('extra_skill')->nullable();
            $table->integer('expected_salary_high');
            $table->integer('expected_salary_low');
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
