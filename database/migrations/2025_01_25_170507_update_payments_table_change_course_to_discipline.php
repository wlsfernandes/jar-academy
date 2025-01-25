<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentsTableChangeCourseToDiscipline extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['course_id']); // Drop foreign key
            $table->dropColumn('course_id');   // Drop the column

            $table->foreignId('discipline_id')->constrained('disciplines')->onDelete('cascade'); // Add discipline_id
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['discipline_id']); // Drop foreign key
            $table->dropColumn('discipline_id');   // Drop the column

            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // Restore course_id
        });
    }
}
