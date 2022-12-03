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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('test_id')->index();
            $table->json('question')->comment('list of questions');
            $table->json('answer')->comment('Answers for questions');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('test_id')->references('id')->on('tests')->nullOnDelete();
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
        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropForeign('user_answers_user_id_foreign');
            $table->dropForeign('user_answers_test_id_foreign');
            $table->dropIndex('user_answers_user_id_index');
            $table->dropIndex('user_answers_test_id_index');
        });
        Schema::dropIfExists('user_answers');
    }
};
