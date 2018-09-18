<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ba13850ab7bfRelationshipsToCoursesdatumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coursesdatas', function(Blueprint $table) {
            if (!Schema::hasColumn('coursesdatas', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '209358_5ba125a3606a2')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('coursesdatas', 'course_id')) {
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', '209358_5ba125a374715')->references('id')->on('courses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('coursesdatas', 'certificate_id')) {
                $table->integer('certificate_id')->unsigned()->nullable();
                $table->foreign('certificate_id', '209358_5ba125a38b782')->references('id')->on('coursescertificates')->onDelete('cascade');
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
        Schema::table('coursesdatas', function(Blueprint $table) {
            if(Schema::hasColumn('coursesdatas', 'user_id')) {
                $table->dropForeign('209358_5ba125a3606a2');
                $table->dropIndex('209358_5ba125a3606a2');
                $table->dropColumn('user_id');
            }
            if(Schema::hasColumn('coursesdatas', 'course_id')) {
                $table->dropForeign('209358_5ba125a374715');
                $table->dropIndex('209358_5ba125a374715');
                $table->dropColumn('course_id');
            }
            if(Schema::hasColumn('coursesdatas', 'certificate_id')) {
                $table->dropForeign('209358_5ba125a38b782');
                $table->dropIndex('209358_5ba125a38b782');
                $table->dropColumn('certificate_id');
            }
            
        });
    }
}
