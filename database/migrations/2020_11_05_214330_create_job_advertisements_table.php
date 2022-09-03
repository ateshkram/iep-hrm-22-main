<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('position_number')->unique();
            $table->string('purpose',2000);
            $table->string('position_title');
            $table->string('employee_class');
            $table->string('salary_range');
            $table->string('grade');
            $table->float('FTE');
            $table->string('location');
            $table->string('reports_to');
            $table->string('supervised_by');
            $table->string('nature_scope',2000);
            $table->string('key_responsibilities',2000);
            $table->string('minimum_qualifications',2000);
            $table->string('preferred_qualifications',2000);
            $table->string('contract_length');
            $table->timestamp('opening_date');
            $table->timestamp('closing_date');
            $table->string('contact_person');
            $table->string('status');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('reviewer_id');
            $table->unsignedBigInteger('job_description_id');
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('staff')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('reviewer_id')->references('id')->on('staff')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('job_description_id')->references('id')->on('job_descriptions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('department_id')->references('id')->on('departments')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_advertisements');
    }
}
