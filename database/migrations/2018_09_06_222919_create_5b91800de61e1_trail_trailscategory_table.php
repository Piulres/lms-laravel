<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b91800de61e1TrailTrailscategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('trail_trailscategory')) {
            Schema::create('trail_trailscategory', function (Blueprint $table) {
                $table->integer('trail_id')->unsigned()->nullable();
                $table->foreign('trail_id', 'fk_p_205150_205093_trails_5b91800de6345')->references('id')->on('trails')->onDelete('cascade');
                $table->integer('trailscategory_id')->unsigned()->nullable();
                $table->foreign('trailscategory_id', 'fk_p_205093_205150_trail__5b91800de641e')->references('id')->on('trailscategories')->onDelete('cascade');
                
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
        Schema::dropIfExists('trail_trailscategory');
    }
}
