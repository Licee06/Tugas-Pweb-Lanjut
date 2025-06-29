<?php
if (!function_exists('getPDO')) {
    function getPDO(): \PDO {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_NAME);
        $opts = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        static $pdo = null;
        if ($pdo === null) {
            $pdo = new \PDO($dsn, DB_USER, DB_PASS, $opts);
        }
        return $pdo;
    }
}
?>