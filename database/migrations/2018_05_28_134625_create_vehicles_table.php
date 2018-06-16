<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('plate',10)->unique();
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->integer('bra_id')->nullable();
            $table->integer('mod_id')->nullable();
            $table->string('owner_nic')->nullable();
            $table->integer('cod_id')->nullable();
            $table->integer('typ_id')->nullable();
            $table->integer('sta_id')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('acc_id')->nullable();
            $table->timestamps();

            $table->primary('plate');
            $table->foreign('sta_id')->references('sta_id')->on('status')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('mod_id')->references('bra_id')->on('brands_vehicles')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('bra_id')->references('mod_id')->on('models_vehicles')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('owner_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
           // $table->foreign('code_id')->references('id')->on('codes')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('typ_id')->references('id')->on('types')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('vehicles');
    }
}
