<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeAbonnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_abonnements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->string('type')->nullable();
            $table->integer('tarif_stategique')->nullable();
            $table->integer('pourcentage_demarcheur')->nullable();
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
        Schema::dropIfExists('type_abonnements');
    }
}
