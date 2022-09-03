<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('qualification_type');
            $table->string('qualification_name');
            $table->string('institution_name');
            $table->string('additional_information');
            $table->timestamp('start_date');
            $table->string('end_date');
            $table->unsignedBigInteger('job_application_id');
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
        Schema::dropIfExists('job_application_qualifications');
    }
}
