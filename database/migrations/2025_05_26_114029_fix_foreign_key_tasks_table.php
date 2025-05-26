<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Drop the old foreign key constraint manually
        DB::statement('ALTER TABLE tasks DROP CONSTRAINT IF EXISTS tasks_resource_id_foreign');

        Schema::table('tasks', function (Blueprint $table) {
            $table->renameColumn('resource_id', 'discipline_id');
        });
        // Add the correct constraint
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['discipline_id']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->renameColumn('discipline_id', 'resource_id');
        });
        // Optional: re-add old FK pointing to resources if you ever roll back
        DB::statement('ALTER TABLE tasks ADD CONSTRAINT tasks_resource_id_foreign FOREIGN KEY (discipline_id) REFERENCES resources(id)');
    }
};
