<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1537287298CoursescertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('coursescertificates')) {
            Schema::create('coursescertificates', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('order')->nullable();
                $table->string('title')->nullable();
                $table->string('slug')->nullable();
                $table->string('image')->nullable();
                
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
        Schema::dropIfExists('coursescertificates');
    }
}
