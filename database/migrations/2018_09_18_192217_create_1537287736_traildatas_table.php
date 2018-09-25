<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1537287736TraildatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('traildatas')) {
            Schema::create('traildatas', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('view')->nullable();
                $table->decimal('progress', 5 , 4)->nullable();
                $table->integer('rating')->nullable();
                $table->text('testimonal')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traildatas');
    }
}
