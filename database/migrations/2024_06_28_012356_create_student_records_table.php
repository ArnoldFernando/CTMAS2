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
        Schema::create('student_records', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 15); // Student ID as a string
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->timestamps();

            // Foreign key to students table
            $table->foreign('student_id')->references('student_id')->on('student_lists')->onDelete('cascade')->onUpdate('cascade');

            // $table->id();
            // $table->string('student_id');
            // $table->time('time_in')->nullable();
            // $table->time('time_out')->nullable();
            // $table->timestamps();

            // $table->foreign('student_id')
            //     ->references('student_id')
            //     ->on('student_lists')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_records');
    }
};
