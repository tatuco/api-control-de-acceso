<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('camera')->nullable();
            $table->integer('code_id');
            $table->date('date_exe');
            $table->boolean('registered');
            $table->integer('typ_id');
            $table->integer('div_id');
            $table->string('use_nic');
            $table->boolean('permitted');
            $table->boolean('supervised');

            $table->timestamps();

            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('typ_id')->references('id')->on('types')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('div_id')->references('id')->on('divices')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
