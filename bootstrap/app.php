<?php

use App\Http\Middleware\AdminAuthenticateMiddleware;
use App\Http\Middleware\AdminGuestMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,

        ]);


        // custom added for admin middleware
        $middleware->alias([
            'admin_guest' => AdminGuestMiddleware::class,
            'admin' => AdminAuthenticateMiddleware::class,

        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
