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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('key'); // login.title, register.button など
            $table->foreignId('language_id')
                  ->constrained('languages')
                  ->cascadeOnDelete();
            $table->text('value'); // 翻訳文
            $table->timestamps();

            $table->unique(['key', 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
