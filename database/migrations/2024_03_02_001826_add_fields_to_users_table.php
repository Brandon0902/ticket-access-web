<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_token')->nullable();
            $table->string('avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
            $table->dropColumn('provider_token');
            $table->dropColumn('avatar');
        });
    }
};
