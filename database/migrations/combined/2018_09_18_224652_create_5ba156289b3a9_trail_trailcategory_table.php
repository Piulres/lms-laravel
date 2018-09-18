<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba156289b3a9TrailTrailcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('trail_trailcategory')) {
            Schema::create('trail_trailcategory', function (Blueprint $table) {
                $table->integer('trail_id')->unsigned()->nullable();
                $table->foreign('trail_id', 'fk_p_209355_209346_trailc_5ba156289b54d')->references('id')->on('trails')->onDelete('cascade');
                $table->integer('trailcategory_id')->unsigned()->nullable();
                $table->foreign('trailcategory_id', 'fk_p_209346_209355_trail__5ba156289b627')->references('id')->on('trailcategories')->onDelete('cascade');
                
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
        Schema::dropIfExists('trail_trailcategory');
    }
}
