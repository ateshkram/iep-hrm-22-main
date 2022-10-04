<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_url_link');
            $table->string('attachment_type');
            $table->unsignedBigInteger('job_application_id');
            $table->timestamps();

            $table->foreign('job_application_id')->references('id')->on('job_applications')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_application_attachments');
    }
}
