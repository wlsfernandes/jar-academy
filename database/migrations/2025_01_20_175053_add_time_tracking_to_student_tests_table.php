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
        Schema::table('student_tests', function (Blueprint $table) {
            $table->timestamp('start_time')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->boolean('submitted_within_time')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_tests', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('submitted_at');
            $table->dropColumn('submitted_within_time');
        });
    }
};
