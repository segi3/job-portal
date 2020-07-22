<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInvestasiFundingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investasi_funding', function (Blueprint $table) {
            $table->decimal('fund_target', 20, 2);
            $table->decimal('fund_sekarang', 20, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investasi_funding', function (Blueprint $table) {
            $table->dropColumn('fund_target');
            $table->dropColumn('fund_sekarang');
        });
    }
}

