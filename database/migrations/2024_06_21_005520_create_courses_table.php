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
        Schema::create('courses', function (Blueprint $table) {
            $table->string('course_id', 15)->primary(); // Set course_id as string with a length of 10 characters
            $table->string('course_name', 100);
            $table->enum('type', ['undergraduateschool', 'graduateschool'])->default('undergraduateschool');
            $table->string('college_id', 15)->nullable(); // Set college_id as string with a length of 10 characters
            $table->timestamps();

            // Foreign key
            $table->foreign('college_id')->references('college_id')->on('colleges')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
