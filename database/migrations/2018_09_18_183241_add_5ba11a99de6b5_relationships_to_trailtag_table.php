<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ba11a99de6b5RelationshipsToTrailtagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trailtags', function(Blueprint $table) {
            if (!Schema::hasColumn('trailtags', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '209351_5ba11a99109dd')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('trailtags', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '209351_5ba11a9922fae')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('trailtags', function(Blueprint $table) {
            
        });
    }
}
