<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCourseIdToDisciplineIdInResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resources', function (Blueprint $table) {
            // Drop the old foreign key constraint
            $table->dropForeign(['course_id']);

            // Rename the column
            $table->renameColumn('course_id', 'discipline_id');
        });

        Schema::table('resources', function (Blueprint $table) {
            // Add the new foreign key constraint
            $table->foreign('discipline_id')->references('id')->on('disciplines')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function (Blueprint $table) {
            // Drop the updated foreign key
            $table->dropForeign(['discipline_id']);
            // Rename the column back to course_id
            $table->renameColumn('discipline_id', 'course_id');
        });

        Schema::table('resources', function (Blueprint $table) {
            // Restore the foreign key
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }
}
