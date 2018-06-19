<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenberRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menber_relationship', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cont_id');
            $table->string('use_nic');
            $table->string('relationship');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('cont_id')->references('id')->on('contracts')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menber_relationship');
    }
}
