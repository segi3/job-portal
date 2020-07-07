<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStudentProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_student_project', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->nullable()->unsigned();
            $table->bigInteger('project_id')->nullable()->unsigned();
            $table->string('status')->default('pending');
            $table->integer('lembar_beli');
            $table->decimal('total_harga', 20, 2)->default(0);
            $table->string('berkas_ktp');
            $table->timestamp('order_date', 0)->nullable();
            $table->timestamp('payment_due', 0)->nullable();
            $table->string('snap_token')->nullable();

            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('project_id')->references('id')->on('investasi_project')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_student_project');
    }
}
