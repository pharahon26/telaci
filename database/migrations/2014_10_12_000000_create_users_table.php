<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nom')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('photo_profil')->nullable();
            $table->boolean('is_staff')->nullable()->default(false);
            $table->boolean('is_demarcheur')->nullable()->nullable()->default(false);
            $table->boolean('is_suspended')->nullable()->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('balance')->nullable();
            $table->boolean('is_validated')->nullable()->default(false);
            $table->boolean('is_completed')->nullable()->default(false);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
