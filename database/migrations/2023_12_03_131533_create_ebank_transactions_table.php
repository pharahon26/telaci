<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebank_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ebank_profil_id');
            $table->unsignedBigInteger('transaction_id');            
            $table->boolean('is_retrait')->nullable()->default(false);

            $table->foreign('ebank_profil_id')->references('id')->on('ebank_profils')
                ->onDelete('cascade');

            $table->foreign('transaction_id')->references('id')->on('transactions')
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
        Schema::dropIfExists('ebank_transactions');
    }
}
