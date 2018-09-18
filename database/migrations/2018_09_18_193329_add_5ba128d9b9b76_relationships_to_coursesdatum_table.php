<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ba128d9b9b76RelationshipsToCoursesdatumTable extends Migration
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
            
        });
    }
}
