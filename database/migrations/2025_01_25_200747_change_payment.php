<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['discipline_id']); // Drop foreign key
            $table->dropColumn('discipline_id');   // Drop the column

            $table->foreignId('certification_id')->constrained('certifications')->onDelete('cascade'); // Add discipline_id
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['certification_id']); // Drop foreign key
            $table->dropColumn('certification_id');   // Drop the column

            $table->foreignId('discipline_id')->constrained()->onDelete('cascade'); // Restore discipline_id
        });
    }
};
