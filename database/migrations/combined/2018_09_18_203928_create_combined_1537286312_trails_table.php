<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1537286312TrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('trails')) {
            Schema::create('trails', function (Blueprint $table) {
                $table->increments('id');
                $table->string('order')->nullable();
                $table->string('title')->nullable();
                $table->string('slug')->nullable();
                $table->text('description')->nullable();
                $table->text('introduction')->nullable();
                $table->string('featured_image')->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->tinyInteger('approved')->nullable()->default('0');
                
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
        Schema::dropIfExists('trails');
    }
}
