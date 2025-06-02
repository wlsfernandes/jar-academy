<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Drop morph columns and index from resources
        Schema::table('resources', function (Blueprint $table) {
            if (Schema::hasColumn('resources', 'resourceable_type') && Schema::hasColumn('resources', 'resourceable_id')) {
                $table->dropIndex(['resourceable_type', 'resourceable_id']);
                $table->dropColumn(['resourceable_type', 'resourceable_id']);
            }
        });

        // Add resource-related fields to tasks
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable(); // media type: pdf, video, etc.
            $table->string('url')->nullable();  // file URL or external link
        });
    }

    public function down()
    {
        // Add morph columns back to resources
        Schema::table('resources', function (Blueprint $table) {
            $table->string('resourceable_type')->nullable();
            $table->unsignedBigInteger('resourceable_id')->nullable();
            $table->index(['resourceable_type', 'resourceable_id'], 'resources_resourceable_type_resourceable_id_index');
        });

        // Drop the new columns from tasks
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'type', 'url']);
        });
    }
};
