<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPaidToDisciplineStudentTable extends Migration
{
    public function up()
    {
        Schema::table('discipline_student', function (Blueprint $table) {
            $table->boolean('is_paid')->default(false)->after('feedback'); // or after whatever makes sense
        });
    }

    public function down()
    {
        Schema::table('discipline_student', function (Blueprint $table) {
            $table->dropColumn('is_paid');
        });
    }
}
