<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('qualification_type');
            $table->string('qualification_name');
            $table->string('institution_name');
            $table->string('additional_information');
            $table->timestamp('start_date');
            $table->string('end_date');
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
        Schema::dropIfExists('candidate_qualifications');
    }
}
