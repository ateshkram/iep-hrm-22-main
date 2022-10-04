<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDCActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_c_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::table('d_c_activity_logs', function($table)
        {
            $table->foreign('case_id')
            ->references('id')
            ->on('disciplinary_case')
            ->OnDelete('cascade');  
            $table->foreign('user_id')
                ->references('id')
                ->on('staff')
                ->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_c_activity_logs');
    }
}
