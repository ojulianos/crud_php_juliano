<?php
date_default_timezone_set('America/Sao_Paulo');

define('APP_TITTLE', 'MVC - Juliano');
define('DEFAULT_CONTROLLER', 'Default');
define('DEBUG', true);

if(DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ .'/../tmp/logs/errors.log');
}

