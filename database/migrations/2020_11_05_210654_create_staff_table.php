<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('photo_url')->nullable();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('position')->nullable();
            $table->string('employee_class')->nullable();
            $table->string('gender')->nullable();
            $table->string('department')->nullable();
            $table->string('section')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('contract_start_date')->nullable();
            $table->string('contract_end_date')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
