<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba11ec12a3b6CourseCoursetagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('course_coursetag')) {
            Schema::create('course_coursetag', function (Blueprint $table) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', 'fk_p_209354_209350_course_5ba11ec12a567')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('coursetag_id')->unsigned()->nullable();
                $table->foreign('coursetag_id', 'fk_p_209350_209354_course_5ba11ec12a661')->references('id')->on('coursetags')->onDelete('cascade');
                
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
        Schema::dropIfExists('course_coursetag');
    }
}
