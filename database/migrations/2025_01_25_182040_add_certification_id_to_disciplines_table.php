<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCertificationIdToDisciplinesTable extends Migration
{
    public function up()
    {
        Schema::table('disciplines', function (Blueprint $table) {
            $table->unsignedBigInteger('certification_id')->nullable()->after('currency');
            $table->foreign('certification_id')->references('id')->on('certifications')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('disciplines', function (Blueprint $table) {
            $table->dropForeign(['certification_id']);
            $table->dropColumn('certification_id');
        });
    }
}
