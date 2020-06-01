<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default('2');
            $table->string('name');
            $table->string('website')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('fax', 15)->nullable();
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('email')->unique();
            $table->string('password');
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
        Schema::dropIfExists('employers');
    }
}
