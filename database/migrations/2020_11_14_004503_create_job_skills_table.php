<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_id');
            $table->unsignedBigInteger('job_description_id');
            $table->timestamps();

            $table->foreign('skill_id')->references('id')->on('skills')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('job_description_id')->references('id')->on('job_descriptions')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_skills');
    }
}
