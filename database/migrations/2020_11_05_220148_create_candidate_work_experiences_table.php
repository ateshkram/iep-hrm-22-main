<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('position_title');
            $table->timestamp('date_joined');
            $table->timestamp('date_left')->nullable();
            $table->boolean('currently_working')->default(false);
            $table->timestamp('duration');
            $table->string('job_description');
            $table->unsignedBigInteger('candidate_id');
            $table->timestamps();

            $table->foreign('candidate_id')->references('id')->on('candidates')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_work_experiences');
    }
}
