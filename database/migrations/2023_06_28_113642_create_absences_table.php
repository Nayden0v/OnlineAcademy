<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('absences'))
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->integer('lecture_id');
            $table->integer('module_id');
            $table->integer('training_id');
            $table->integer('student_id')->nullable();
            $table->string('attendance_status')->nullable();
            $table->boolean('disregarded')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();

            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
