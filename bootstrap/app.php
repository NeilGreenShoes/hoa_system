<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware; // Ensure this import matches your exact namespace

return Application::configure(basePath: dirname(__DIR__))
    ->registered(function ($app) {
        if (env('APP_ENV') === 'production') {
            $app->usePublicPath(base_path('./'));
        }
    }) // Removed the trailing semicolon here
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
