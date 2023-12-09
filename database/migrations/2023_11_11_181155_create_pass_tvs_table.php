<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassTvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass_tvs', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->string('code')->unique();
            $table->boolean('is_actif')->nullable()->default(false);
            $table->unsignedBigInteger('programme_tv_id');
            $table->unsignedBigInteger('pass_type_id');
            $table->unsignedBigInteger('transaction_id');

            $table->dateTime('end_date')->nullable();
            $table->boolean('is_expired')->nullable()->default(false);
            $table->boolean('is_confirmed')->nullable()->default(false);

            $table->timestamps();

            $table->foreign('programme_tv_id')->references('id')
                ->on('programme_tvs')->onDelete('cascade');

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
        Schema::dropIfExists('pass_tvs');
    }
}
