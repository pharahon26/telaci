<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpargneTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epargne_transactions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_retrait')->nullable()->default(false);
            $table->unsignedBigInteger('epargne_account_id');
            $table->unsignedBigInteger('transaction_id');

            $table->foreign('epargne_account_id')->references('id')->on('epargne_accounts')
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
        Schema::dropIfExists('epargne_transactions');
    }
}
