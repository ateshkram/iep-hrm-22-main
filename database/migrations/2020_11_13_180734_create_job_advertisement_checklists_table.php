<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAdvertisementChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_advertisement_checklists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_advertisement_id');
            $table->unsignedBigInteger('checklist_id');
            $table->timestamps();

            $table->foreign('checklist_id')->references('id')->on('checklists')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('job_advertisement_id')->references('id')->on('job_advertisements')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_advertisement_checklists');
    }
}
