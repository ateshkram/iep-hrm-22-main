<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('position_title');
            $table->timestamp('date_joined');
            $table->timestamp('date_left')->nullable();
            $table->boolean('currently_working')->default(false);
            $table->string('job_description');
            $table->unsignedBigInteger('job_application_id');
            $table->timestamps();

            $table->foreign('job_application_id')->references('id')->on('job_applications')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_application_work_experiences');
    }
}
