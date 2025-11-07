<?php

// Router untuk PHP built-in server
// File ini menangani request dan mengarahkan ke folder public

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Jika request untuk file statis di public (css, js, dll)
if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|eot)$/', $uri)) {
    $file = __DIR__ . '/public' . $uri;
    if (file_exists($file)) {
        return false; // Biarkan PHP server menangani file statis
    }
}

// Semua request lainnya diarahkan ke public/index.php
$_GET['url'] = trim($uri, '/');
require_once __DIR__ . '/public/index.php';
