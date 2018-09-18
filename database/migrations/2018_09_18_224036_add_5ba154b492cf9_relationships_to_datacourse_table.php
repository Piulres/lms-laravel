<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ba154b492cf9RelationshipsToDatacourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datacourses', function(Blueprint $table) {
            if (!Schema::hasColumn('datacourses', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '209379_5ba1465a6e8d2')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('datacourses', 'course_id')) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', '209379_5ba1465a8371f')->references('id')->on('courses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('datacourses', 'certificate_id')) {
                $table->integer('certificate_id')->unsigned()->nullable();
                $table->foreign('certificate_id', '209379_5ba1465a9717b')->references('id')->on('coursescertificates')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datacourses', function(Blueprint $table) {
            
        });
    }
}
