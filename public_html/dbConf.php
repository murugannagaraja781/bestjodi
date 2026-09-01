<?php
error_reporting(0);

// Helper to load .env file if available and env vars not already in getenv()
if (!function_exists('loadEnvVariables')) {
    function loadEnvVariables($envPath) {
        if (file_exists($envPath)) {
            $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '' || strpos($line, '#') === 0) {
                    continue;
                }
                if (strpos($line, '=') !== false) {
                    list($key, $value) = explode('=', $line, 2);
                    $key = trim($key);
                    $value = trim($value, " \t\n\r\0\x0B\"'");
                    if (getenv($key) === false && !isset($_ENV[$key])) {
                        putenv("$key=$value");
                        $_ENV[$key] = $value;
                        $_SERVER[$key] = $value;
                    }
                }
            }
        }
    }
}

// Load from parent directory .env or current directory .env
loadEnvVariables(__DIR__ . '/../.env');
loadEnvVariables(__DIR__ . '/.env');

// Read database parameters with environment variables priority and fallback
$db_host = getenv('DB_HOST') ?: (isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : 'localhost');
$db_user = getenv('DB_USER') ?: (isset($_ENV['DB_USER']) ? $_ENV['DB_USER'] : 'best_jodi_user');
$db_pass = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : (isset($_ENV['DB_PASSWORD']) ? $_ENV['DB_PASSWORD'] : '3hJ+ZMUZgE}Z');
$db_name = getenv('DB_DATABASE') ?: (isset($_ENV['DB_DATABASE']) ? $_ENV['DB_DATABASE'] : 'bestjodi');
$db_port = getenv('DB_PORT') ?: (isset($_ENV['DB_PORT']) ? (int)$_ENV['DB_PORT'] : 3306);

if (!defined('DB_HOST')) define('DB_HOST', $db_host);
if (!defined('DB_USER')) define('DB_USER', $db_user);
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', $db_pass);
if (!defined('DB_DATABASE')) define('DB_DATABASE', $db_name);
if (!defined('DB_PORT')) define('DB_PORT', (int)$db_port);

$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);
if (!$db) {
    // Fallback attempt without port
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
}
$connection = $db ? mysqli_select_db($db, DB_DATABASE) : false;

date_default_timezone_set("Asia/Kolkata");
?>