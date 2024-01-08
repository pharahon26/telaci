<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_publicites', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tarif');
            $table->string('particularite');
            $table->string('visibilite');
            $table->string('observation');
            $table->text('avantage1')->nullable();
            $table->text('avantage2')->nullable();
            $table->text('avantage3')->nullable();
            $table->text('avantage4')->nullable();
            $table->text('avantage5')->nullable();
            $table->text('avantage6')->nullable();
            $table->text('avantage7')->nullable();
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
        Schema::dropIfExists('pack_publicites');
    }
};
