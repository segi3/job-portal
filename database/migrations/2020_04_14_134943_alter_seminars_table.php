<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seminars', function (Blueprint $table) {
            $table->bigInteger('employer_id')->after('id')->nullable()->unsigned();
            $table->bigInteger('seminar_category_id')->after('description')->nullable()->unsigned();
            $table->bigInteger('admin_id')->after('contact_no')->nullable()->unsigned();

            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('seminar_category_id')->references('id')->on('seminar_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('seminars', function (Blueprint $table) {
            $table->dropForeign('seminars_employer_id_foreign');
            $table->dropColumn('employer_id');
            $table->dropForeign('seminars_seminar_category_id_foreign');
            $table->dropColumn('seminar_category_id');
            $table->dropForeign('seminars_admin_id_foreign');
            $table->dropColumn('admin_id');
        });
    }
}
