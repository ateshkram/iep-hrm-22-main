<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->integer('requester_id');
            $table->integer('category_id');
            $table->integer('technician_id')->nullable();
            $table->integer('priority_id')->nullable();
            $table->string('request_subject');
            $table->string('request_description');
            $table->string('request_attachment')->nullable();
            $table->string('request_resolution')->nullable();
            $table->integer('request_status_id');
            $table->dateTime('request_created');
            $table->dateTime('request_closed')->nullable();
            $table->dateTime('request_resolved')->nullable();
            $table->boolean('requester_acknowledgemnt')->nullable();
            $table->string('requester_comment')->nullable();
            $table->integer('closure_code_id')->nullable();
            $table->string('request_closure_comment')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
