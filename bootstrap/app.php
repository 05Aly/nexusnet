<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Facade;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
   ->withExceptions(function (Exceptions $exceptions) {
    //
    })->create();

// 1. ربط الـ Facades فوراً بالحاوية لمنع خطأ Facade root
Facade::setFacadeApplication($app);

// 2. توجيه مجلد التخزين إلى /tmp في بيئة Vercel
if (is_dir('/tmp')) {
    $app->useStoragePath('/tmp/storage');
}

return $app;