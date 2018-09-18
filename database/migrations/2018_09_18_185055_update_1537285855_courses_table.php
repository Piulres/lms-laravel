<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1537285855CoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            if(Schema::hasColumn('courses', 'created_by_id')) {
                $table->dropForeign('209354_5ba11ebfcf610');
                $table->dropIndex('209354_5ba11ebfcf610');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('courses', 'created_by_team_id')) {
                $table->dropForeign('209354_5ba11ebfe27ae');
                $table->dropIndex('209354_5ba11ebfe27ae');
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
        Schema::table('courses', function (Blueprint $table) {
                        
        });

    }
}
