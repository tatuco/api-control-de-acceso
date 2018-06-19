<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BrandsVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_vehicles', function (Blueprint $table) {
            $table->increments('bra_id');
            $table->string('bra_des');
            $table->string('use_nic', 50)->unsigned()->index();
            $table->timestamps();
            $table->boolean('active')->default(true);
            $table->integer('acc_id')->unsigned()->index();

            $table->foreign('acc_id')->references('acc_id')->on('accounts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands_vehicles');
    }
}
