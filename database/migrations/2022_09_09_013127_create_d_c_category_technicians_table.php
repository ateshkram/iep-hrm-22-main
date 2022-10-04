<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDCCategoryTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_c_category_technicians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('category_id')->unsigned();
            $table->unsignedBiginteger('committee_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('d_c_category_technicians', function($table)
        {
            $table->foreign('category_id')
                ->references('id')
                ->on('d_c_categories')
                ->OnDelete('cascade');
            $table->foreign('committee_id')
                ->references('id')
                ->on('d_c_committee')
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
        Schema::dropIfExists('d_c_category_technicians');
    }
}
