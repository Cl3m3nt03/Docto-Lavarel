<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->dropColumn('time');
            $table->time('start_time')->after('date');
            $table->time('end_time')->after('start_time');
        });
    }

    public function down()
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->time('time')->after('date');
            $table->dropColumn(['start_time', 'end_time']);
        });
    }
};
