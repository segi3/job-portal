<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderGuestProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_guest_project', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('guest_id')->nullable()->unsigned();
            $table->bigInteger('project_id')->nullable()->unsigned();
            $table->string('status')->default('pending');
            $table->integer('lembar_beli');
            $table->decimal('total_harga', 20, 2)->default(0);
            $table->string('berkas_ktp');
            $table->timestamp('order_date', 0)->nullable();
            $table->timestamp('payment_due', 0)->nullable();
            $table->string('snap_token')->nullable();

            $table->timestamps();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('order_guest_project');
    }
}
