<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQustionAnswerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qustion_answer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->index();
            $table->foreignId('data_jadwal_id')->index();
            $table->foreignId('option_question_id')->index();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('data_jadwal_id')->references('id')->on('data_jadwal')->onDelete('cascade');
            $table->foreign('option_question_id')->references('id')->on('option_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qustion_answer_details');
    }
}
