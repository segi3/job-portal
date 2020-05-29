<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nrp', 14);
            $table->string('mobile_no');
            $table->string('email')->unique();;
            $table->string('password');
            $table->string('hobby');
            $table->string('skill');
            $table->string('achievment');
            $table->string('experience');
            $table->string('gender', 1);
            $table->date('birthdate');
            $table->string('address');
            $table->string('city');
            $table->string('province');

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
        Schema::dropIfExists('students');
    }
}
