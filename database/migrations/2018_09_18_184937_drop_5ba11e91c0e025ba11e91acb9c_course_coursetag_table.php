<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5ba11e91c0e025ba11e91acb9cCourseCoursetagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('course_coursetag');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('course_coursetag')) {
            Schema::create('course_coursetag', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id', 'fk_p_209353_209350_course_5ba11e26548e6')->references('id')->on('courses');
                $table->integer('coursetag_id')->unsigned()->nullable();
            $table->foreign('coursetag_id', 'fk_p_209350_209353_course_5ba11e26538be')->references('id')->on('coursetags');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
