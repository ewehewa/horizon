<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\BlockIpAddressMiddleware::class,
            \App\Http\Middleware\AppearanceSettingsMiddleware::class,
        ]);
        
        $middleware->alias([
            '2fa' =>  \App\Http\Middleware\TwoFactorVerify::class,
            'isadmin' => \App\Http\Middleware\EnsureIsAdmin::class,
            'adminguest' => \App\Http\Middleware\RedirectIfAdminIsLoggedIIn::class,
            'complete.kyc' => \App\Http\Middleware\EnsureKycIsCompleted::class,
            'check.frozen' => \App\Http\Middleware\CheckAccountFrozen::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
