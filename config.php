<?php

require_once 'vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__)->load();

define('SLASH', DIRECTORY_SEPARATOR);
define('VIEW_FOLDER', __DIR__ . SLASH . "app" . SLASH . 'view' . SLASH);
define('DATA_LOCATION', __DIR__ . SLASH . 'app' . SLASH . 'data' . SLASH . 'users.json');

define('MAIL_HOST', $_ENV['MAIL_HOST']);
define('MAIL_USERNAME', $_ENV['MAIL_USERNAME']);
define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD']);
define('MAIL_PORT', $_ENV['MAIL_PORT']);
