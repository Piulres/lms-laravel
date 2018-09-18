<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba1385214165CourseTrailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('course_trail')) {
            Schema::create('course_trail', function (Blueprint $table) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', 'fk_p_209354_209355_trail__5ba1385214264')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('trail_id')->unsigned()->nullable();
                $table->foreign('trail_id', 'fk_p_209355_209354_course_5ba13852144d2')->references('id')->on('trails')->onDelete('cascade');
                
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
        Schema::dropIfExists('course_trail');
    }
}
