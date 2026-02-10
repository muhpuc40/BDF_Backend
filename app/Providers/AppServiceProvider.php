<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Nothing needed here
    }

    public function boot(): void
    {
        // Register SMTP2GO mailer
        Mail::extend('smtp2go', function (array $config) {
            $apiKey = config('services.smtp2go.api_key');
            
            if (empty($apiKey)) {
                throw new \RuntimeException('SMTP2GO API key not configured. Set SMTP2GO_API_KEY in .env');
            }
            
            return new \App\Mail\Transport\Smtp2goTransport($apiKey);
        });
    }
}