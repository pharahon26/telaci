<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpargneAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epargne_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ebank_profil_id');
            $table->date('debut_epargne')->default(now());
            $table->date('fin_epargne')->default(now());
            $table->string('balance');
            $table->string('amount_freeze')->default(0);
            $table->timestamps();

            $table->foreign('ebank_profil_id')->references('id')
                ->on('ebank_profils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epargne_account');
    }
}
