<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba138520d359CourseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('course_user')) {
            Schema::create('course_user', function (Blueprint $table) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', 'fk_p_209354_208952_user_c_5ba138520d4dc')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', 'fk_p_208952_209354_course_5ba138520d5a5')->references('id')->on('users')->onDelete('cascade');
                
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
        Schema::dropIfExists('course_user');
    }
}
