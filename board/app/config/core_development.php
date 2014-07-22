<?php
define('ENV_PRODUCTION', false);
define('APP_HOST', 'hello.example.com');
define('APP_BASE_PATH', '/');
define('APP_URL', 'http://hello.example.com/');

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
ini_set('error_log', LOGS_DIR.'php.log');
ini_set('session.auto_start', 0);

// MySQL: board
define('DB_DSN', 'mysql:host=localhost;dbname=board');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'klabklab');
define('DB_ATTR_TIMEOUT', 3);

//for validation
define('MIN_USER_LENGTH', 5);
define('MAX_USER_LENGTH', 20);
define('MIN_PASS_LENGTH', 5);
define('MAX_PASS_LENGTH', 20);
define('MIN_THREAD_LENGTH', 1);
define('MAX_THREAD_LENGTH', 30);
define('MIN_COM_USERNAME', 1);
define('MAX_COM_USERNAME', 16);
define('MIN_COM_BODY', 1);
define('MAX_COM_BODY', 200);
?>