<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ba11b5f09116RelationshipsToLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function(Blueprint $table) {
            if (!Schema::hasColumn('lessons', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '209352_5ba11b5dcc5c7')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('lessons', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '209352_5ba11b5de366a')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('lessons', function(Blueprint $table) {
            
        });
    }
}
