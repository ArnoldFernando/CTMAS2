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
        Schema::create('student_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->unsigned()->unique();
            $table->string('name');
            $table->string('course');
            $table->string('college')->nullable();
            $table->string('image', 300)->nullable();
            $table->timestamps();

            $table->index('student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_lists');
    }
};
