<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->bigInteger('employer_id')->after('id')->nullable()->unsigned();
            $table->bigInteger('job_category_id')->after('position')->nullable()->unsigned();
            $table->bigInteger('admin_id')->after('location')->nullable()->unsigned();

            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('job_category_id')->references('id')->on('job_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign('jobs_employer_id_foreign');
            $table->dropColumn('employer_id');
            $table->dropForeign('jobs_job_category_id_foreign');
            $table->dropColumn('job_category_id');
            $table->dropForeign('jobs_admin_id_foreign');
            $table->dropColumn('admin_id');
        });
    }
}
