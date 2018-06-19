<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sch_id');
            $table->integer('tmct_id');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('tmct_id')->references('id')->on('time_categories')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sch_id')->references('id')->on('schedules')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
