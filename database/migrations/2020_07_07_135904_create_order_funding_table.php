<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderFundingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_funding', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->nullable()->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('status')->default('pending');
            $table->decimal('total_harga', 20, 2)->default(0);
            $table->timestamp('order_date', 0)->nullable();
            $table->timestamp('payment_due', 0)->nullable();
            $table->string('snap_token')->nullable();

            $table->timestamps();
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
        Schema::dropIfExists('order_funding');
    }
}
