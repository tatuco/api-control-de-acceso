<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('use_dni', 15)->nullable();
            $table->string('use_nam', 50)->nullable();
            $table->string('use_lna', 50)->nullable();
            $table->string('use_nic', 50)->unique();
            $table->string('email', 130)->unique();
            $table->string('password', 250);
            //news
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->integer('typ_id')->nullable();
            $table->integer('cod_id')->nullable();
            //fin news
            $table->timestamps();
            $table->boolean('use_act')->default(true);
            $table->integer('sta_id')->nullable();//->unsigned()->index();
            $table->integer('acc_id')->unsigned()->index();

            //fk
            $table->foreign('typ_id')->references('id')->on('types')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('cod_id')->references('id')->on('codes')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sta_id')->references('sta_id')->on('status')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('users');
    }
}
