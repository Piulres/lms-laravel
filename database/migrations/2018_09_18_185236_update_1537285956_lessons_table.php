<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1537285956LessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            if(Schema::hasColumn('lessons', 'created_by_id')) {
                $table->dropForeign('209352_5ba11b5dcc5c7');
                $table->dropIndex('209352_5ba11b5dcc5c7');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('lessons', 'created_by_team_id')) {
                $table->dropForeign('209352_5ba11b5de366a');
                $table->dropIndex('209352_5ba11b5de366a');
                $table->dropColumn('created_by_team_id');
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
        Schema::table('lessons', function (Blueprint $table) {
                        
        });

    }
}
