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
            $table->string('tier')->default('First-time')->after('password'); 
            $table->decimal('total_spend', 10, 2)->default(0)->after('tier');
            $table->string('status')->default('Active')->after('total_spend');
            $table->boolean('is_flagged')->default(false)->after('status');
            $table->text('admin_memo')->nullable()->after('is_flagged');
            $table->date('last_stay')->nullable()->after('admin_memo');
            $table->string('phone_number')->nullable()->after('last_stay');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tier', 'total_spend', 'status', 'is_flagged', 'admin_memo', 'last_stay', 'phone_number']);
        });
    }
};
