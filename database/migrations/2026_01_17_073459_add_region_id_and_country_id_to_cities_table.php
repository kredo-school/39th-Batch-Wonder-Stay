<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This migration updates the cities table
     */

    // Add region_id and country_id columns to cities table
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table) {

            // Add region_id column / This links a city to a region
            $table->foreignId('region_id')
            ->after('id')
            ->constrained() // references regions.id
            ->cascadeOnDelete();  // delete city if region is deleted

            // Add county_id column / This links a city to a country
            $table->foreignId('country_id')
            ->after('region_id')
            ->constrained() // references countries.id
            ->cascadeOnDelete(); //delete city if country is deleted
        });
    }

    /**
     * Reverse the migrations.
     * Remove added columns if rollback
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropConstrainedForeignId('country_id'); //Remove country_id foreign key and column
            $table->dropConstrainedForeignId('region_id'); //Remove region_id foreign key and column
        });
    }
};
