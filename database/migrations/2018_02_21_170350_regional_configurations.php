<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegionalConfigurations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regional_configurations', function (Blueprint $table) {
            $table->increments('rco_id');
            $table->integer('acc_id')->unsigned()->index();
            $table->integer('cou_id')->unsigned()->index();
            $table->string('use_nic', 50)->unsigned()->index();
            $table->timestamps();
            $table->string('rco_mon', 130);
            $table->string('rco_umv', 130);
            $table->string('rco_ump', 130);
            $table->string('rco_uml', 130);
            $table->boolean('active')->default(true);

            //fk
            $table->foreign('acc_id')->references('acc_id')->on('accounts')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('cou_id')->references('cou_id')->on('countries')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regional_configurations');
    }
}
