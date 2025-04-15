<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToDisciplinesTable extends Migration
{
    public function up()
    {
        Schema::table('disciplines', function (Blueprint $table) {
            $table->unsignedInteger('order')->default(1)->after('certification_id');
        });
    }

    public function down()
    {
        Schema::table('disciplines', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
