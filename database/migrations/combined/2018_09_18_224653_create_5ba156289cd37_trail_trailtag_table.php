<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba156289cd37TrailTrailtagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('trail_trailtag')) {
            Schema::create('trail_trailtag', function (Blueprint $table) {
                $table->integer('trail_id')->unsigned()->nullable();
                $table->foreign('trail_id', 'fk_p_209355_209351_trailt_5ba156289cea3')->references('id')->on('trails')->onDelete('cascade');
                $table->integer('trailtag_id')->unsigned()->nullable();
                $table->foreign('trailtag_id', 'fk_p_209351_209355_trail__5ba156289cf5c')->references('id')->on('trailtags')->onDelete('cascade');
                
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
        Schema::dropIfExists('trail_trailtag');
    }
}
