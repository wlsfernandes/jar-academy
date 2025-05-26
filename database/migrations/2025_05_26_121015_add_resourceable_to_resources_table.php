<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('resources', function (Blueprint $table) {
            // Add polymorphic fields if they don't already exist
            if (!Schema::hasColumn('resources', 'resourceable_id')) {
                $table->unsignedBigInteger('resourceable_id')->nullable()->after('discipline_id');
            }

            if (!Schema::hasColumn('resources', 'resourceable_type')) {
                $table->string('resourceable_type', 191)->nullable()->after('resourceable_id');
            }

            $table->index(['resourceable_type', 'resourceable_id'], 'resources_resourceable_type_resourceable_id_index');
        });
    }

    public function down(): void
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropIndex('resources_resourceable_type_resourceable_id_index');
            $table->dropColumn(['resourceable_id', 'resourceable_type']);
        });
    }
};
