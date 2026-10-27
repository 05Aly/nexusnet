<?php

// كتم تحذيرات الـ Deprecation حتى لا ترسل Headers قبل الأوان
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '1');

define('LARAVEL_START', microtime(true));

// إنشاء المسارات المؤقتة
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

// ضبط بيئة التشغيل
putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');
putenv('LOG_CHANNEL=stderr');
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_STORE=array');
putenv('APP_DEBUG=true');

$_ENV['LOG_CHANNEL'] = 'stderr';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['APP_DEBUG'] = 'true';

require __DIR__ . '/../vendor/autoload.php';

/** @var \Illuminate\Foundation\Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

// استخدام الـ Kernel القياسي لمعالجة الـ Request وإرجاع الـ Response بشكل سليم
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$request = \Illuminate\Http\Request::capture();
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);