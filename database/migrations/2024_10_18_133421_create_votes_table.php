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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('voter_id')->constrained('users')->comment('The user who cast the vote');
            $table->morphs('voteable');
            $table->tinyInteger('direction')->comment('The value of the vote. Can be 1 for upvote or -1 for downvote');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
