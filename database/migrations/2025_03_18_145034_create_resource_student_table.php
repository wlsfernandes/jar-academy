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
        Schema::create('resource_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('resource_id')->constrained()->cascadeOnDelete();
            $table->integer('views')->default(0);
            $table->timestamp('last_viewed_at')->nullable();
            $table->unsignedBigInteger('task_or_test_id')->default(0); // Store either StudentTask or StudentTest ID
            $table->timestamps();

            $table->unique(['student_id', 'resource_id']); // Ensure uniqueness
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_student');
    }
};
