<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1536262601UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable();
                }
if (!Schema::hasColumn('users', 'website')) {
                $table->string('website')->nullable();
                }
if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('website');
            $table->dropColumn('avatar');
            
        });

    }
}
