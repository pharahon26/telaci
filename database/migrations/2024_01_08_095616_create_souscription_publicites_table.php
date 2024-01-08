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
        Schema::create('souscription_publicites', function (Blueprint $table) {
            $table->id();
            $table->text('nom');
            $table->text('entreprise')->nullable();
            $table->text('cni')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('pack_publicite_id');
            $table->foreign('pack_publicite_id')->references('id')->on('pack_publicites')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('souscription_publicites');
    }
};
