<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Make city code nullable
     * 
     * We do not input city code manually.
     * 
     * City code will be generated automatically
     * from country code and city name later.
     * 
     * This change allows city data to be saved 
     * before implementing code generation.
     */
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->foreignId('region_id')->after('id')->constrained()->cascadeOnDelete();
            $table->foreignId('country_id')->after('region_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the change
     * Make city code required again
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropConstrainedForeignId('country_id');
            $table->dropConstrainedForeignId('region_id');
        });
    }
};
