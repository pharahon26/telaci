<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationIdentiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_identies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lieu_naissance')->nullable();
            $table->string('date_naissance')->nullable();
            $table->string('genre')->nullable();
            $table->string('pays')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('domicile')->nullable();
            $table->string('cni_recto')->nullable();
            $table->string('cni_verso')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone1')->unique();
            $table->string('phone2')->nullable();
            $table->boolean('is_validated')->default(false);
            $table->boolean('encours')->default(false);
            $table->string('resultat_validation')->default(false);
            $table->string('numero_cni')->nullable();

            $table->timestamps();
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('information_identies');
    }
}
