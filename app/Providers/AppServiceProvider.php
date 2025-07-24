<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Auth\IAuthService;
use App\Services\Mail\IMailService;
use App\Services\Mail\MailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IMailService::class, MailService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
