<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ba1562752035RelationshipsToDatatrailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datatrails', function(Blueprint $table) {
            if (!Schema::hasColumn('datatrails', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '209378_5ba14611f2209')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('datatrails', 'trail_id')) {
                $table->integer('trail_id')->unsigned()->nullable();
                $table->foreign('trail_id', '209378_5ba146121451b')->references('id')->on('trails')->onDelete('cascade');
                }
                if (!Schema::hasColumn('datatrails', 'certificate_id')) {
                $table->integer('certificate_id')->unsigned()->nullable();
                $table->foreign('certificate_id', '209378_5ba146122fbe2')->references('id')->on('trailscertificates')->onDelete('cascade');
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
        Schema::table('datatrails', function(Blueprint $table) {
            if(Schema::hasColumn('datatrails', 'user_id')) {
                $table->dropForeign('209378_5ba14611f2209');
                $table->dropIndex('209378_5ba14611f2209');
                $table->dropColumn('user_id');
            }
            if(Schema::hasColumn('datatrails', 'trail_id')) {
                $table->dropForeign('209378_5ba146121451b');
                $table->dropIndex('209378_5ba146121451b');
                $table->dropColumn('trail_id');
            }
            if(Schema::hasColumn('datatrails', 'certificate_id')) {
                $table->dropForeign('209378_5ba146122fbe2');
                $table->dropIndex('209378_5ba146122fbe2');
                $table->dropColumn('certificate_id');
            }
            
        });
    }
}
