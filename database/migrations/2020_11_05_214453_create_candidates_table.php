<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->nullable();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('lname')->nullable();
            $table->string('other_names')->nullable();
            $table->string('fname')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('photo_url')->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('gender')->nullable();
            $table->integer('work_phone')->nullable();
            $table->integer('home_phone')->nullable();
            $table->integer('mobile')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('postal_address')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('candidates');
    }
}
