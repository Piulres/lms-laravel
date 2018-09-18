<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba138520f3efCourseLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('course_lesson')) {
            Schema::create('course_lesson', function (Blueprint $table) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', 'fk_p_209354_209352_lesson_5ba138520f585')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('lesson_id')->unsigned()->nullable();
                $table->foreign('lesson_id', 'fk_p_209352_209354_course_5ba138520f61a')->references('id')->on('lessons')->onDelete('cascade');
                
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
        Schema::dropIfExists('course_lesson');
    }
}
