<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('locality_id')->constrained('localities')->comment('The locality where the user lives');
            $table->boolean('is_councillor')->default(false)->comment('Whether the user is a councillor of their Locality');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['locality_id']);
            $table->dropColumn(['locality_id', 'is_councillor']);
        });
    }
};
