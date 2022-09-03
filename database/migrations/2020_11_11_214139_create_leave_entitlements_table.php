<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveEntitlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_entitlements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_type_id');
            $table->unsignedBigInteger('employee_class_id');
            $table->integer('leave_availability')->nullable();
            $table->string('leave_eligibility')->nullable();
            $table->integer('leave_carry_over')->nullable();
            $table->integer('leave_entitlement')->nullable();
            $table->timestamps();

            $table->foreign('leave_type_id')->references('id')->on('leave_types')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_entitlements');
    }
}
