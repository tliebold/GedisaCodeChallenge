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
        Schema::table('movie_ratings', function (Blueprint $table) {
            $table->unique(['imdb_id', 'user_id'], 'movie_ratings_imdb_id_user_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movie_ratings', function (Blueprint $table) {
            $table->dropUnique('movie_ratings_imdb_id_user_id_unique');
        });
    }
};
