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
        Schema::create('graduate_school_lists', function (Blueprint $table) {
            $table->id();
            $table->string('graduateschool_id')->unique();
            $table->string('name');
            $table->string('course')->nullable();
            $table->string('image', 300)->nullable();
            $table->timestamps();

            $table->index('graduateschool_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduate_school_lists');
    }
};
