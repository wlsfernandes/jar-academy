<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('student_tests', function (Blueprint $table) {
            $table->decimal('grade', 4, 2)->nullable()->after('submitted_within_time');
        });
    }

    public function down(): void
    {
        Schema::table('student_tests', function (Blueprint $table) {
            $table->dropColumn('grade');
        });
    }
};
