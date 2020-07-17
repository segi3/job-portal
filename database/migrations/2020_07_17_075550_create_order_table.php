<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('nama_investor');
            $table->string('email_investor');
            $table->string('id_investor');
            $table->string('role');
            $table->string('tipe_investasi');
            $table->string('nama_investasi');
            $table->string('nama_investee');
            $table->string('id_investee');
            $table->integer('lembar_beli')->nullable();
            $table->string('status')->default('init');
            $table->decimal('total_harga', 20, 2)->default(0);
            $table->timestamp('order_date', 0)->nullable();
            $table->timestamp('payment_due', 0)->nullable();
            $table->string('snap_token')->nullable();

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
        Schema::dropIfExists('order');
    }
}
