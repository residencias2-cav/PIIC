<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string(
                'email_2fa_code_hash',
                255
            )->nullable();

            $table->timestamp(
                'email_2fa_expires_at'
            )->nullable();

            $table->unsignedTinyInteger(
                'email_2fa_attempts'
            )->default(0);

            $table->timestamp(
                'email_2fa_last_sent_at'
            )->nullable();

            $table->boolean(
                'email_2fa_enabled'
            )->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn([
                'email_2fa_code_hash',
                'email_2fa_expires_at',
                'email_2fa_attempts',
                'email_2fa_last_sent_at',
                'email_2fa_enabled',
            ]);
        });
    }
};