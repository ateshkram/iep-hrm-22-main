<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinaryCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplinary_case', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->string('case_subject');
            $table->text('case_description');
            $table->integer('case_severity');
            $table->string('case_attachment')->nullable();
            $table->date('case_created_date');
            $table->time('case_created_time');
            $table->text('case_created_comments');
            $table->unsignedBigInteger('case_status_id')->unsigned();
            $table->boolean('case_resolution')->default('0');
            $table->date('case_closure_date')->nullable();
            $table->time('case_closure_time')->nullable();
            $table->text('case_closure_comments')->nullable();
            $table->unsignedBigInteger('closure_code_id')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('disciplinary_case', function($table)
        {
            $table->foreign('user_id')
            ->references('id')
            ->on('staff')
            ->OnDelete('cascade');  
            $table->foreign('category_id')
                ->references('id')
                ->on('d_c_categories')
                ->onUpdate('cascade')
                ->OnDelete('cascade');
            $table->foreign('case_status_id')
                ->references('id')
                ->on('d_c_statuses')
                ->OnDelete('cascade');
            $table->foreign('closure_code_id')
                ->references('id')
                ->on('d_c_closure_codes')
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
        Schema::dropIfExists('disciplinary_case');
    }
}
