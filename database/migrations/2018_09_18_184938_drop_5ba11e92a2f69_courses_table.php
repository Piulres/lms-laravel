<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5ba11e92a2f69CoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('courses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('courses')) {
            Schema::create('courses', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('order')->nullable();
                $table->string('title')->nullable();
                $table->string('slug')->nullable();
                $table->text('description')->nullable();
                $table->text('introduction')->nullable();
                $table->string('featured_image')->nullable();
                $table->integer('duration')->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->tinyInteger('approved')->nullable()->default('0');
                
                $table->timestamps();
                $table->softDeletes();

            $table->index(['deleted_at']);
            });
        }
    }
}
