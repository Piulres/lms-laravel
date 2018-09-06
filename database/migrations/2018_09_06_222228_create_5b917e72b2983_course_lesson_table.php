<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b917e72b2983CourseLessonTable extends Migration
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
                $table->foreign('course_id', 'fk_p_205141_205114_lesson_5b917e72b2ae4')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('lesson_id')->unsigned()->nullable();
                $table->foreign('lesson_id', 'fk_p_205114_205141_course_5b917e72b2bcd')->references('id')->on('lessons')->onDelete('cascade');
                
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
