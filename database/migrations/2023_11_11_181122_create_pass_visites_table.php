<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassVisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass_visites', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->string('code')->unique();
            $table->dateTime('end_date');
            $table->integer('nb_visite');
            $table->boolean('is_expired')->nullable()->default(false);
            $table->boolean('is_confirmed')->nullable()->default(false);
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('pass_type_id');

            $table->timestamps();

            $table->foreign('pass_type_id')->references('id')
                ->on('pass_types')->onDelete('cascade');

            $table->foreign('transaction_id')->references('id')
                ->on('transactions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pass_visites');
    }
}
