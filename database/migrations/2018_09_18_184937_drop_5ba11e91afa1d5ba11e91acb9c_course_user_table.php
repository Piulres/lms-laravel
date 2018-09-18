<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5ba11e91afa1d5ba11e91acb9cCourseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('course_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('course_user')) {
            Schema::create('course_user', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id', 'fk_p_209353_208952_user_c_5ba11e243627c')->references('id')->on('courses');
                $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id', 'fk_p_208952_209353_course_5ba11e2435317')->references('id')->on('users');
                
                $table->timestamps();
                
            });
        }
    }
}
