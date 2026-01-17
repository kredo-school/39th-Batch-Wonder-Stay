<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 外部キーが存在するか MySQL から確認して、あれば drop
        $fk = DB::selectOne("
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'translations'
              AND COLUMN_NAME = 'language_id'
              AND REFERENCED_TABLE_NAME IS NOT NULL
            LIMIT 1
        ");

        if ($fk) {
            Schema::table('translations', function (Blueprint $table) use ($fk) {
                $table->dropForeign($fk->CONSTRAINT_NAME);
            });
        }

        Schema::table('translations', function (Blueprint $table) {
            // 古い unique が残ってる場合もあるので、あれば落とす（存在しないときに落ちないよう try/catch は不要な構成にするならSQL確認が必要）
            // ここは一旦「language_id/value を削除して locale/text を足す」だけに集中

            if (Schema::hasColumn('translations', 'language_id')) {
                $table->dropColumn('language_id');
            }

            if (Schema::hasColumn('translations', 'value')) {
                $table->dropColumn('value');
            }

            if (!Schema::hasColumn('translations', 'locale')) {
                $table->string('locale', 10)->after('key');
            }

            if (!Schema::hasColumn('translations', 'text')) {
                $table->text('text')->after('locale');
            }
        });

        // unique(key, locale) を追加（すでにあればエラーになるので、事前にチェックしてから追加）
        $idx = DB::selectOne("
            SELECT INDEX_NAME
            FROM information_schema.STATISTICS
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'translations'
              AND INDEX_NAME = 'translations_key_locale_unique'
            LIMIT 1
        ");

        if (!$idx) {
            Schema::table('translations', function (Blueprint $table) {
                $table->unique(['key', 'locale'], 'translations_key_locale_unique');
            });
        }
    }

    public function down(): void
    {
        // 今回は rollback 不要（空でOK）
    }
};
