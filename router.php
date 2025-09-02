<?php
// router.php di pusdahamnas/

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

// Path ke Laravel root (tanpa public)
$laravelRoot = __DIR__ . '/api-pusdahamnas';

// 1) Semua request ke /v1/... diarahkan ke Laravel
if (strpos($uri, '/v1/') === 0) {
    $forwardPath = substr($uri, 3); // hapus "/v1"

    // Kalau file statis Laravel ada (opsional, tergantung struktur)
    if (is_file($laravelRoot . '/' . $forwardPath)) {
        return false;
    }

    // Set server vars agar Laravel bisa jalan
    $_SERVER['SCRIPT_FILENAME'] = $laravelRoot . '/index.php';
    $_SERVER['SCRIPT_NAME']     = '/index.php';
    $_SERVER['PHP_SELF']        = '/index.php';
    $_SERVER['REQUEST_URI']     = $forwardPath .
        (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '' 
            ? '?' . $_SERVER['QUERY_STRING'] 
            : ''
        );

    chdir($laravelRoot);

    require $laravelRoot . '/index.php';
    exit;
}

// 2) Selain /v1 -> arahkan ke CI3 (pusdahamnas)
if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false; // file statis CI3
}

$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';
$_SERVER['SCRIPT_NAME']     = '/index.php';
$_SERVER['PHP_SELF']        = '/index.php';

require __DIR__ . '/index.php';
