<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day_id');
            $table->integer('hour_id');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('day_id')->references('id')->on('time_days')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('hour_id')->references('id')->on('time_hours')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_categories');
    }
}
