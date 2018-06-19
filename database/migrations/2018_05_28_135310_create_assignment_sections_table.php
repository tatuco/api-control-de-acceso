<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place');
            $table->integer('available');
            $table->integer('par_sec');
            $table->string('use_nic');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('par_sec')->references('id')->on('parking_sections')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_sections');
    }
}
