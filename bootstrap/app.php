<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class
        ]);
        
        // If you want to add it to a middleware group instead:
        // $middleware->group('web', [
        //     AdminMiddleware::class,
        // ]);
        
        // Note: The except() functionality would need to be handled in your route definitions
        // or within the middleware itself
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withProviders([
        App\Providers\SiteInfoServiceProvider::class,
    ])->create();
