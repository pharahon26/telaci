<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammeTvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programme_tvs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('type')->nullable();
            $table->date('date_tournage');
            $table->date('date_diffusion');
            $table->string('link');
            $table->longText('description');
            $table->integer('duree')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('categorie_programme_tv_id')->index()->nullable();
            $table->foreign('categorie_programme_tv_id')->references('id')
                ->on('categorie_programme_tvs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programme_tvs');
    }
}
