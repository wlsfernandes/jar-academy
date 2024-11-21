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

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('institution_id')->nullable()->constrained()->onDelete('cascade');
        });
        DB::table('users')->update(['institution_id' => 1]);
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('institution_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['institution_id']);
            $table->dropColumn('institution_id');
        });
    }
};
