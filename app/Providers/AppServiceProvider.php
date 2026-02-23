<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Translation\DatabaseTranslator;
use App\Services\TranslationService;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend('translator', function ($translator, $app) {
            return new DatabaseTranslator(
                $app['translation.loader'],
                $app['config']['app.locale'],
                $app->make(TranslationService::class)
            );
        });
    }

    public function boot()
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
