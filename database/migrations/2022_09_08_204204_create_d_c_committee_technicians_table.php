<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDCCommitteeTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_c_committee_technicians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('committee_id')->unsigned();
            $table->unsignedBiginteger('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('d_c_committee_technicians', function($table)
        {
            $table->foreign('committee_id')
                ->references('id')
                ->on('d_c_committee')
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
        Schema::dropIfExists('d_c_committee_technicians');
    }
}
