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
        Schema::create('faculty_lists', function (Blueprint $table) {
                $table->string('faculty_id', 15)->primary();
                $table->string('first_name', 50);
                $table->string('middle_initial', 10)->nullable();
                $table->string('last_name', 50);
                $table->string('image', 255)->nullable();
                $table->string('college_id', 15)->nullable(); // Set college_id as string with a length of 10 characters
                $table->timestamps();

                // Foreign keys
                $table->foreign('college_id')->references('college_id')->on('colleges')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_lists');
    }
};
