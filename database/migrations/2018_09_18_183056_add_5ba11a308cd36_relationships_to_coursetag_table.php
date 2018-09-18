<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ba11a308cd36RelationshipsToCoursetagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coursetags', function(Blueprint $table) {
            if (!Schema::hasColumn('coursetags', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '209350_5ba11a2f7451e')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('coursetags', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '209350_5ba11a2f8ceb7')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('coursetags', function(Blueprint $table) {
            
        });
    }
}
