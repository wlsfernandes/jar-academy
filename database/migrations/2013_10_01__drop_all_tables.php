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
       // Get all table names in the current schema
       $tables = DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");

       // Loop through and drop each table
       foreach ($tables as $table) {
           $tableName = $table->tablename;
           DB::statement("DROP TABLE IF EXISTS \"$tableName\" CASCADE");
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
