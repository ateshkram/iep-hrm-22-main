<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('leave_type_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('leave_application_comment');
            $table->unsignedBigInteger('status_id');
            $table->string('leave_application_review');
            $table->string('leave_application_documents')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('staff')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->foreign('status_id')->references('id')->on('leave_statuses')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_applications');
    }
}
