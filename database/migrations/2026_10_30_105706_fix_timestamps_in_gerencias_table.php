<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gerencias', function (Blueprint $table) {
            $table->dropColumn('timestamps');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('gerencias', function (Blueprint $table) {
            $table->dropTimestamps();

            $table->dateTime('timestamps')->nullable();
        });
    }
};
