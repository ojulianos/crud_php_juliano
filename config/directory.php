<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',  dirname(__DIR__) . DS );
define('APP', ROOT . 'App' . DS);
define('CORE', ROOT . 'Core' . DS);

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);

define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));

define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);