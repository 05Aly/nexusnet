<?php

// 1. تجهيز مجلدات التخزين المؤقتة المسموح بالكتابة فيها داخل /tmp
$storageDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// 2. توجيه المسارات إلى /tmp قبل استدعاء Laravel
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('LOG_CHANNEL=stderr');
$_ENV['LOG_CHANNEL'] = 'stderr';
$_SERVER['LOG_CHANNEL'] = 'stderr';

// 3. استدعاء ملف الدخول الرسمي لمشروع Laravel
require __DIR__ . '/../public/index.php';