<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvesteeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investee', function (Blueprint $table) {
            $table->id();
            $table->string('status', 1)->default('0');
            $table->bigInteger('admin_id')->nullable()->unsigned();
            $table->bigInteger('student_id')->nullable()->unsigned()->unique();
            $table->string('nama');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('fax', 15)->nullable();
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('email');
            
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investee');
    }
}
