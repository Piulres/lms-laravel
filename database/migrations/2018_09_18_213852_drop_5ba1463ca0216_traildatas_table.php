<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5ba1463ca0216TraildatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('traildatas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('traildatas')) {
            Schema::create('traildatas', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('view')->nullable();
                $table->float('progress')->nullable();
                $table->integer('rating')->nullable();
                $table->text('testimonal')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

            $table->index(['deleted_at']);
            });
        }
    }
}
