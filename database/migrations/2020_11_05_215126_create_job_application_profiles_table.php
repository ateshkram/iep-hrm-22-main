<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('fname');
            $table->string('lname');
            $table->string('other_names');
            $table->string('citizenship');
            $table->string('employment_type');
            $table->boolean('previously_employed')->default(false);
            $table->boolean('currently_employed')->default(false);
            $table->integer('employee_number')->nullable();
            $table->string('position_title')->nullable();
            $table->string('grade')->nullable();
            $table->string('department')->nullable();
            $table->string('section')->nullable();
            $table->string('photo_url')->nullable();
            $table->timestamp('dob');
            $table->string('gender');
            $table->integer('work_phone')->nullable();
            $table->integer('home_phone')->nullable();
            $table->integer('mobile')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('postal_address')->nullable();
            $table->unsignedBigInteger('job_application_id');
            $table->timestamps();

            $table->foreign('job_application_id')->references('id')->on('job_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_application_profiles');
    }
}
