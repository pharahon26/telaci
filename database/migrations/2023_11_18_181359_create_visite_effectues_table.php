<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisiteEffectuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visite_effectues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pass_visite_id');
            $table->unsignedBigInteger('place_id');

            $table->foreign('pass_visite_id')->references('id')->on('pass_visites')
                ->onDelete('cascade');

            $table->foreign('place_id')->references('id')->on('places')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visite_effectues');
    }
}
