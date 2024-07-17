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
        Schema::create('graduate_school_records', function (Blueprint $table) {

            $table->id();
            $table->unsignedInteger('graduate_id');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->timestamps();

            $table->foreign('graduate_id')
                ->references('graduate_id')
                ->on('graduate_id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduate_school_records');
    }
};
