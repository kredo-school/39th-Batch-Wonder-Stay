<?php

use App\Models\Language;

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