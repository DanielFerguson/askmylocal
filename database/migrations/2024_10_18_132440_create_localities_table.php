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
        Schema::create('localities', function (Blueprint $table) {
            $table->id();
            $table->string('state')->comment('The state of the locality, e.g. Victoria, Tasmania');
            $table->string('name')->comment('The name of the locality, e.g. Pyrenees Shire');
            $table->string('slug')->virtualAs("LOWER(state || '-' || name)")->comment('The slug of the locality, e.g. victoria-pyrenees-shire');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localities');
    }
};
