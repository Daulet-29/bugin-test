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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('test_id')->index();
            $table->foreign('test_id')->references('id')->on('tests')->nullOnDelete();;
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
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign('questions_test_id_foreign');
            $table->dropIndex('questions_test_id_index');
        });
        Schema::dropIfExists('questions');
    }
};
