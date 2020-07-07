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
            $table->bigInteger('admin_id')->after('id')->nullable()->unsigned();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('fax', 15)->nullable();
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('berkas_verifikasi');
            
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
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
