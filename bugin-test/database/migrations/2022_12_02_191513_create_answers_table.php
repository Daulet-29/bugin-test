<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('test_id');
            $table->foreign('test_id')->references('id')->on('questions')->nullOnDelete();
            $table->foreign('question_id')->references('id')->on('questions')->nullOnDelete();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign('answers_test_id_foreign');
            $table->dropForeign('answers_question_id_foreign');
        });
        Schema::dropIfExists('answers');
    }
};
