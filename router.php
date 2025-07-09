<?php
// Simple router for Render.com
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Remove trailing slash
$path = rtrim($path, '/');

// If empty path, serve index.php
if (empty($path) || $path === '/') {
    include 'index.php';
    exit;
}

// Check if file exists
$file = ltrim($path, '/');
if (file_exists($file)) {
    // Serve static files
    if (pathinfo($file, PATHINFO_EXTENSION)) {
        $mime_types = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon'
        ];
        
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if (isset($mime_types[$ext])) {
            header('Content-Type: ' . $mime_types[$ext]);
        }
        readfile($file);
        exit;
    }
}

// Fallback to index.php
include 'index.php';
?>
