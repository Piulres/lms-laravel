<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ba120abd070aTrailTrailtagTable extends Migration
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
                $table->foreign('trail_id', 'fk_p_209355_209351_trailt_5ba120abd086f')->references('id')->on('trails')->onDelete('cascade');
                $table->integer('trailtag_id')->unsigned()->nullable();
                $table->foreign('trailtag_id', 'fk_p_209351_209355_trail__5ba120abd0930')->references('id')->on('trailtags')->onDelete('cascade');
                
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
