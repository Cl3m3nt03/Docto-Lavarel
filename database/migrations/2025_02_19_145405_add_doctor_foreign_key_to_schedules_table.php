<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->change(); // 🛠️ S'assure que doctor_id est de type BigInt
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
        });
    }
};
