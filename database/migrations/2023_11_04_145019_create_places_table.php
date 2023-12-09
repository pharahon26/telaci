<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('price');
            $table->string('proprio_name')->nullable();
            $table->string('proprio_telephone')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->string('photo_couverture')->nullable();
            $table->string('ref')->nullable();
            $table->longText('description');
            $table->boolean('is_Studio')->nullable()->default(false);
            $table->boolean('is_Chambre')->nullable()->default(false);
            $table->boolean('is_Residence')->nullable()->default(false);
            $table->boolean('is_Appartment')->nullable()->default(false);
            $table->boolean('is_Bureau')->nullable()->default(false);
            $table->boolean('is_MAISON_BASSE')->nullable()->default(false);
            $table->boolean('is_DUPLEX')->nullable()->default(false);
            $table->boolean('has_PISCINE')->nullable()->default(false);
            $table->boolean('is_HAUT_STANDING')->nullable()->default(false);
            $table->boolean('has_COUR_AVANT')->nullable()->default(false);
            $table->boolean('has_COUR_ARRIERE')->nullable()->default(false);
            $table->boolean('has_GARDIEN')->nullable()->default(false);
            $table->boolean('has_GARAGE')->nullable()->default(false);
            $table->boolean('has_balcon_avant')->nullable()->default(false);
            $table->boolean('has_balcon_arriere')->nullable()->default(false);
            $table->integer('nombre_piece');
            $table->integer('nombre_salle_eau');
            $table->boolean('is_validated')->nullable()->default(false);
            $table->boolean('is_occupe')->nullable()->default(false);
            $table->boolean('is_rejected')->nullable()->default(false);
            $table->timestamps();

            $table->unsignedBigInteger('commune_id')->index()->nullable();
            $table->foreign('commune_id')->references('id')
                ->on('communes')->onDelete('cascade');

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
