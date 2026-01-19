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
        Schema::table('translations', function (Blueprint $table) {

            // ① 外部キー制約を削除
            $table->dropForeign(['language_id']);

            // ② 古い unique を削除
            $table->dropUnique('translations_key_language_id_unique');

            // ③ 新しいカラムを追加
            $table->string('locale', 10)->after('key');
            $table->text('text')->after('locale');

            // ④ 不要カラム削除
            $table->dropColumn(['language_id', 'value']);

            // ⑤ 新しい unique 制約
            $table->unique(['key', 'locale'], 'translations_key_locale_unique');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // このmigrationはrollback不可とする
    }

};
