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
        Schema::table('hotel_details', function (Blueprint $table) {
            // すでにカラムがある前提で「空OK」に変更
            $table->decimal('size_area', 10, 2)->nullable()->change();

            // amenities が string なら string のまま nullable に
            // json なら json->nullable()->change() にする
            $table->json('amenities')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_details', function (Blueprint $table) {
            $table->decimal('size_area', 10, 2)->nullable(false)->change();
            $table->json('amenities')->nullable(false)->change();
        });
    }
};
