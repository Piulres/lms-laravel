<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba120abcd052TrailTrailcategoryTable extends Migration
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
                $table->foreign('trail_id', 'fk_p_209355_209346_trailc_5ba120abcd1b0')->references('id')->on('trails')->onDelete('cascade');
                $table->integer('trailcategory_id')->unsigned()->nullable();
                $table->foreign('trailcategory_id', 'fk_p_209346_209355_trail__5ba120abcd26f')->references('id')->on('trailcategories')->onDelete('cascade');
                
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
