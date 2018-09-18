<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5ba11e91bb5a15ba11e91acb9cCourseCoursecategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('course_coursecategory');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('course_coursecategory')) {
            Schema::create('course_coursecategory', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id', 'fk_p_209353_209345_course_5ba11e2595f5e')->references('id')->on('courses');
                $table->integer('coursecategory_id')->unsigned()->nullable();
            $table->foreign('coursecategory_id', 'fk_p_209345_209353_course_5ba11e2594db3')->references('id')->on('coursecategories');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
