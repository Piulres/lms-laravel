<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b918137d75dbRelationshipsToDatacourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datacourses', function(Blueprint $table) {
            if (!Schema::hasColumn('datacourses', 'course_id')) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', '205151_5b9180e0b143c')->references('id')->on('courses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('datacourses', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '205151_5b9180e0cdab5')->references('id')->on('users')->onDelete('cascade');
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
