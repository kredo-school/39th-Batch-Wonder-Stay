<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Translation;

class TranslationService
{
    public function translate(string $key, string $text,string $locale): string
    {
        $key = $text;

        $cached = Translation::where('key', $key)
            ->where('locale', $locale)
            ->first();

        if ($cached) {
            return $cached->text;
        }
        $response = Http::post('http://localhost:5001/translate', [
            'q' => $text,
            'source' => 'en',
            'target' => $locale,
            'format' => 'text',
        ]);

        $translated = $response->json('translatedText') ?? $text;
            Translation::updateOrCreate(
            [
                'key' => $key,
                'locale' => $locale,
            ], 
            [
                'text' => $translated,
            ]
       );

        return $translated;
    }
}
