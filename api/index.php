<?php

define('LARAVEL_START', microtime(true));

// تجهيز مسارات /tmp للكتابة المؤقتة
$storagePath = '/tmp/storage';
$dirs = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// ضبط بيئة العمل إجبارياً
putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');
putenv('LOG_CHANNEL=stderr');
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_STORE=array');

$_ENV['LOG_CHANNEL'] = 'stderr';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['CACHE_STORE'] = 'array';

// استدعاء autoload والإقلاع
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath($storagePath);

// معالجة الطلب
$request = Illuminate\Http\Request::capture();
$response = $app->handleRequest($request);
$response->send();