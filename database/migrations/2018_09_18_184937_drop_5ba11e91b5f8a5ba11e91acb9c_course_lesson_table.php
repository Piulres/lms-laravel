<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5ba11e91b5f8a5ba11e91acb9cCourseLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('course_lesson');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('course_lesson')) {
            Schema::create('course_lesson', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id', 'fk_p_209353_209352_lesson_5ba11e24dd098')->references('id')->on('courses');
                $table->integer('lesson_id')->unsigned()->nullable();
            $table->foreign('lesson_id', 'fk_p_209352_209353_course_5ba11e24dbf0c')->references('id')->on('lessons');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
