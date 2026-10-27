<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. تجهيز مجلد التخزين المؤقت في /tmp المسموح بالقراءة والكتابة
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

// 2. تحميل ملفات composer
require __DIR__ . '/../vendor/autoload.php';

// 3. إقلاع التطبيق
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 4. إجبار لارافيل على استخدام /tmp لمسار storage بالكامل لمنع Read-only filesystem
$app->useStoragePath($storagePath);

// 5. ضبط قناة التسجيل الافتراضية لمنع خطأ trim(null)
putenv('LOG_CHANNEL=stderr');
$_ENV['LOG_CHANNEL'] = 'stderr';
$_SERVER['LOG_CHANNEL'] = 'stderr';

// 6. تشغيل ومعالجة الطلب
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);