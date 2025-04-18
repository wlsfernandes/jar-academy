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
        Schema::table('certification_student', function (Blueprint $table) {
            Schema::table('certification_student', function (Blueprint $table) {
                $table->boolean('is_completed')->default(false);
                $table->timestamp('completed_at')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certification_student', function (Blueprint $table) {
            //
        });
    }
};
