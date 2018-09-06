<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1536262367DatacoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('datacourses')) {
            Schema::create('datacourses', function (Blueprint $table) {
                $table->increments('id');
                $table->tinyInteger('view')->nullable()->default('0');
                $table->integer('progress')->nullable();
                $table->integer('rating')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('datacourses');
    }
}
