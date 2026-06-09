<?php

$local = file_exists(__DIR__ . '/local.php') ? require __DIR__ . '/local.php' : [];

define('DB_HOST', $local['db_host'] ?? 'localhost');
define('DB_NAME', $local['db_name'] ?? 'mpda_db');
define('DB_USER', $local['db_user'] ?? 'root');
define('DB_PASS', $local['db_pass'] ?? '');

function getDB(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    return $pdo;
}
