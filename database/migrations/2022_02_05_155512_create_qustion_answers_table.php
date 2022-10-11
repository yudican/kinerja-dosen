<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQustionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qustion_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->index();
            $table->foreignId('data_dosen_id');
            $table->foreignId('data_semester_id')->index()->nullable();
            $table->timestamps();
            $table->foreign('mahasiswa_id')->references('id')->on('data_mahasiswa')->onDelete('cascade');
            $table->foreign('data_dosen_id')->references('id')->on('data_dosen')->onDelete('cascade');
            $table->foreign('data_semester_id')->references('id')->on('data_semester')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qustion_answers');
    }
}
