<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba11e27dd752CourseLessonTable extends Migration
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
                $table->foreign('course_id', 'fk_p_209353_209352_lesson_5ba11e27dd8e8')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('lesson_id')->unsigned()->nullable();
                $table->foreign('lesson_id', 'fk_p_209352_209353_course_5ba11e27dd9d2')->references('id')->on('lessons')->onDelete('cascade');
                
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
