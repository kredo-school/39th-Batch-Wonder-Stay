<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslationService;

class TranslationController extends Controller
{
    public function show(TranslationService $translator)
    {
        return $translator->translate(
            key: 'test.hello',
            text: 'Hello world',
            locale: app()->getLocale()
        );
    }
}

