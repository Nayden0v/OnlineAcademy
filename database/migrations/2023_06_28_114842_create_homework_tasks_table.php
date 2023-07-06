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
        if(!Schema::hasTable('homework_tasks'))
        Schema::create('homework_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('homework_id');
            $table->integer('lecture_id');
            $table->integer('module_id');
            $table->integer('training_id');
            $table->integer('student_id')->nullable();
            $table->string('status');
            $table->decimal('grade',8,2);
            $table->timestamps();

            $table->foreign('homework_id')->references('id')->on('homeworks')->onDelete('cascade');
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
        Schema::dropIfExists('homework_tasks');
    }
};
