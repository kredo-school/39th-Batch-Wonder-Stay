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
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('continent')->nullable(); // 'Asia','Europe'...
            $table->decimal('map_x', 5, 2)->nullable(); // 0〜100 (%)
            $table->decimal('map_y', 5, 2)->nullable(); // 0〜100 (%)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn(['continent', 'map_x', 'map_y']);
        });
    }
};
