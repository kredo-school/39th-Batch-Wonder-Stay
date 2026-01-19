<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // up() = Apply the change
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer'); // normal users = customer, admins are set manially

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // down() = Undo the change
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
