<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->decimal('amount', 20, 2)->default(0);
            $table->string('method');
            $table->string('status');
            $table->string('token');
            $table->string('payload');
            $table->string('payment_type');
            $table->string('va_number');
            $table->string('vendor_name');
            $table->string('biller_code');
            $table->string('bill_key');
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
        Schema::dropIfExists('payment_notifications');
    }
}
