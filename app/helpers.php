<?php

use App\Models\Language;
use App\Services\TranslationService;

if (!function_exists('languages')) {
    function languages() {
        return Language::where('is_active', true)->get();
    }
}

if (!function_exists('currentLanguage')) {
    function currentLanguage() {
        return Language::where('code', app()->getLocale())->first();
    }
}

if (! function_exists('t')) {
    function t(string $text): string 
    {
        $locale = app()->getLocale();

        try {
            return app(TranslationService::class)->translate($text, $text, $locale);
        } catch (\Throwable $e) {
            return $text;
        }
    }
}