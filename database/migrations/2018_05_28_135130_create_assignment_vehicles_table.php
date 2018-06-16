<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_sta');
            $table->date('date_end')->nullable();
            $table->string('veh_pla');
            $table->string('use_nic');
            $table->integer('acc_id');
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->foreign('veh_pla')->references('plate')->on('vehicles')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('assignment_vehicles');
    }
}
