<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_abonnement_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('transaction_id');
            $table->boolean('is_actif')->nullable()->default(false);
            $table->string('type')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('transaction_id')->references('id')
                ->on('transactions')->onDelete('cascade');

            $table->foreign('type_abonnement_id')->references('id')
                ->on('type_abonnements')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonnements');
    }
}
