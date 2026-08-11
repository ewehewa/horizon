<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    $filePath = __DIR__.'/public'.$uri;
    if (is_file($filePath)) {
        // Map common file extensions to MIME types
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'css'   => 'text/css',
            'js'    => 'application/javascript',
            'json'  => 'application/json',
            'png'   => 'image/png',
            'jpg'   => 'image/jpeg',
            'jpeg'  => 'image/jpeg',
            'gif'   => 'image/gif',
            'svg'   => 'image/svg+xml',
            'ico'   => 'image/x-icon',
            'webp'  => 'image/webp',
            'woff'  => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf'   => 'font/ttf',
            'eot'   => 'application/vnd.ms-fontobject',
            'otf'   => 'font/otf',
            'map'   => 'application/json',
            'xml'   => 'application/xml',
            'pdf'   => 'application/pdf',
            'mp4'   => 'video/mp4',
            'webm'  => 'video/webm',
        ];
        $mime = $mimeTypes[$ext] ?? (mime_content_type($filePath) ?: 'application/octet-stream');
        header("Content-Type: $mime");
        readfile($filePath);
        exit;
    }
    // If it's a directory, fall through to Laravel
}

// Serve files from storage/app/public directly for php artisan serve
if (str_starts_with($uri, '/storage/app/public/')) {
    $filePath = __DIR__ . $uri;
    if (file_exists($filePath) && is_file($filePath)) {
        $mime = mime_content_type($filePath) ?: 'application/octet-stream';
        header("Content-Type: $mime");
        readfile($filePath);
        exit;
    }
}

require_once __DIR__.'/public/index.php';

