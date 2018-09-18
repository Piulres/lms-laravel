<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ba1263a80401RelationshipsToTraildatumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traildatas', function(Blueprint $table) {
            if (!Schema::hasColumn('traildatas', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '209360_5ba12639392d9')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('traildatas', 'trail_id')) {
                $table->integer('trail_id')->unsigned()->nullable();
                $table->foreign('trail_id', '209360_5ba1263954161')->references('id')->on('trails')->onDelete('cascade');
                }
                if (!Schema::hasColumn('traildatas', 'certificate_id')) {
                $table->integer('certificate_id')->unsigned()->nullable();
                $table->foreign('certificate_id', '209360_5ba1263967eec')->references('id')->on('trailscertificates')->onDelete('cascade');
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
        Schema::table('traildatas', function(Blueprint $table) {
            
        });
    }
}
