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
        Schema::create('recruitings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chief_id')->index()->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('name_of_post_id')->index()->nullable()->comment('Наименование вакансии')->references('id')->on('users')->onDelete('cascade');
            $table->integer('quantity_people')->nullable()->comment('количество');
            $table->foreignId('department_to')->index()->nullable()->references('id')->on('departments')->onDelete('cascade');
            $table->foreignId('reason_to_recruiting')->index()->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('desired_age')->index()->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('sex')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('education')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('functional_responsibilities')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('work_experience')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('is_he_was_boss')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('type_of_hire')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->string('request_to_candidate')->nullable();
            $table->foreignId('perspective_to_candidate')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('computer_knowing')->nullable()->index()->references('id')->on('dictis')->onDelete('cascade');
            $table->integer('salary')->nullable();
            $table->foreignId('motivation')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('job_chart')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('have_car')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('driver_category')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->string('candidates_trait')->nullable();
            $table->string('interview_stage')->nullable();
            $table->date('interview_date')->nullable();
            $table->dateTime('interview_time')->nullable();
            $table->foreignId('interview_result')->nullable()->index()->references('id')->on('dictis')->onDelete('cascade');
            $table->date('date_of_internship')->nullable();
            $table->date('date_of_conclusion_dou')->nullable();
            $table->text('commentary')->nullable();
            $table->string('application_status')->nullable();
            $table->foreignId('responsible_recruiter_id')->index()->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('application_status')->nullable();
            $table->foreignId('lang_kaz')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('lang_ru')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('lang_en')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->foreignId('social_packages')->nullable()->references('id')->on('dictis')->onDelete('cascade');
            $table->integer('salary_after_period')->comment('После испытательного срока')->nullable();
            $table->integer('reminder_quantity_people')->comment('Остаток количество')->nullable();
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
        Schema::dropIfExists('recruitings');
    }
};
