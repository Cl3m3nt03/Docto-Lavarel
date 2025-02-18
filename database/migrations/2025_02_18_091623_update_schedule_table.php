<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->dropColumn('time'); // Supprime la colonne existante
            $table->time('start_time')->after('date'); // Ajoute start_time
            $table->time('end_time')->after('start_time'); // Ajoute end_time
        });
    }

    public function down()
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->time('time')->after('date'); // Ajoute de nouveau time si rollback
            $table->dropColumn(['start_time', 'end_time']); // Supprime start_time et end_time si rollback
        });
    }
};
