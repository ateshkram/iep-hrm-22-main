<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_number');
            $table->string('status')->default('Applied');
            $table->string('review')->nullable();
            $table->unsignedBigInteger('job_advertisement_id');
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('reviewer_id');
            $table->timestamps();

            $table->foreign('job_advertisement_id')->references('id')->on('job_advertisements')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('candidate_id')->references('id')->on('candidates')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('reviewer_id')->references('id')->on('staff')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
}
