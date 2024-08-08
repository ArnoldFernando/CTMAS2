<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('computer_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('faculty_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('graduateschool_id')->nullable();
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('faculty_id')
                ->references('faculty_id')
                ->on('faculty_and_staffs')
                ->onDelete('cascade');

            $table->foreign('student_id')
                ->references('student_id')
                ->on('student_lists')
                ->onDelete('cascade');

            $table->foreign('graduateschool_id')
                ->references('graduateschool_id')
                ->on('graduate_school_lists')
                ->onDelete('cascade');
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computer_records');
    }
};
