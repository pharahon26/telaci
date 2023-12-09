<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbankProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebank_profils', function (Blueprint $table) {
            $table->id();
            $table->string('balance');
            $table->unsignedBigInteger('information_identity_id');
            $table->timestamps();

            $table->foreign('information_identity_id')->references('id')
                ->on('information_identies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebank_profils');
    }
}
