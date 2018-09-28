<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ba154b492cf0RelationshipsToDatalessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datalessons', function(Blueprint $table) {
            if (!Schema::hasColumn('datalessons', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '209379_5ba1465a6e8d3')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('datalessons', 'course_id')) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', '209379_5ba1465a8371g')->references('id')->on('courses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('datalessons', 'lesson_id')) {
                $table->integer('lesson_id')->unsigned()->nullable();
                $table->foreign('lesson_id', '209379_5ba1465a8371h')->references('id')->on('courses')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datalessons', function(Blueprint $table) {
            
        });
    }
}
