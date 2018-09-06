<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b91846560620CourseCoursescategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('course_coursescategory')) {
            Schema::create('course_coursescategory', function (Blueprint $table) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', 'fk_p_205141_205092_course_5b918465607ec')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('coursescategory_id')->unsigned()->nullable();
                $table->foreign('coursescategory_id', 'fk_p_205092_205141_course_5b918465608cf')->references('id')->on('coursescategories')->onDelete('cascade');
                
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
        Schema::dropIfExists('course_coursescategory');
    }
}
