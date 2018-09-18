<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba1562895c82CourseCoursecategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('course_coursecategory')) {
            Schema::create('course_coursecategory', function (Blueprint $table) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', 'fk_p_209354_209345_course_5ba1562895e2f')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('coursecategory_id')->unsigned()->nullable();
                $table->foreign('coursecategory_id', 'fk_p_209345_209354_course_5ba1562895f13')->references('id')->on('coursecategories')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_coursecategory');
    }
}
