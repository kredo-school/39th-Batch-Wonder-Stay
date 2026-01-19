<?php

namespace App\Translation;

use Illuminate\Translation\Translator;
use App\Services\TranslationService;

class DatabaseTranslator extends Translator
{
    protected TranslationService $translatorService;

    public function __construct($loader, $locale, TranslationService $translatorService)
    {
        parent::__construct($loader, $locale);
        $this->translatorService = $translatorService;
    }

    public function get($key, array $replace = [], $locale = null, $fallback = true)
    {
        $locale = $locale ?? $this->locale;

        // 翻訳キーをそのまま英語文として扱う
        $text = parent::get($key, $replace, 'en', false);

        // lang/en に無ければ key を英語文として使う
        if ($text === $key) {
            $text = str_replace('.', ' ', $key);
        }

        return $this->translatorService->translate(
            $key,
            $text,
            $locale
        );
    }
}
