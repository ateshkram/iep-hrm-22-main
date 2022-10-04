<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDCUserLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_c_user_level', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('disciplinary_case_level_id')->unsigned();
            $table->integer('level_count');
            $table->timestamps();
        });
        Schema::table('d_c_user_level', function($table)
        {
            $table->foreign('user_id')
                ->references('id')
                ->on('staff')
                ->OnDelete('cascade');
            $table->foreign('disciplinary_case_level_id')
                ->references('id')
                ->on('d_c_level')
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
        Schema::dropIfExists('d_c_user_level');
    }
}
