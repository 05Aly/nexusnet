<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. إنشاء مسارات التخزين المؤقتة المسموح بالكتابة فيها داخل /tmp
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

// 2. ضبط المتغيرات الأساسية لمنع محاولة القراءة من disk logs وخطأ trim
putenv('LOG_CHANNEL=stderr');
putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_EVENTS_CACHE=/tmp/events.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');

$_ENV['LOG_CHANNEL'] = 'stderr';
$_SERVER['LOG_CHANNEL'] = 'stderr';

// 3. استدعاء autoload
require __DIR__ . '/../vendor/autoload.php';

// 4. إقلاع التطبيق الرسمي لـ Laravel 11 وتعيين مسار storage
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath($storagePath);

// 5. تهيئة الـ Facades رسمياً لمنع خطأ Facade root
\Illuminate\Support\Facades\Facade::setFacadeApplication($app);

// 6. معالجة الطلب عبر نمط Laravel 11 القياسي
$app->handleRequest(Request::capture());