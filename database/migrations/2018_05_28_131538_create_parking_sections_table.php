<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('places');
            $table->integer('available');
            $table->integer('park_id');
            $table->integer('acc_id');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('park_id')->references('id')->on('parkings')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('acc_id')->references('acc_id')->on('accounts')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking_sections');
    }
}
