<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDCLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_c_level', function (Blueprint $table) {
            $table->id();
            $table->string('level_name');
            $table->integer('level_max');
            $table->integer('level_min');
            $table->integer('level_predecessor_id')->nullable();
            $table->integer('level_successor_id')->nullable();            
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
        Schema::dropIfExists('d_c_level');
    }
}
