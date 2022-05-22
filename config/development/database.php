<?php

// MYSQLI or PGSQL
!defined('DB_TYPE') ? define('DB_TYPE', 'mysql') : null;

// HOSTNAME
!defined('DB_HOST') ? define('DB_HOST', '127.0.0.1') : null;

// DATABASE NAME
!defined('DB_NAME') ? define('DB_NAME', 'mvc') : null;

// DATABASE USERNAME
!defined('DB_USER') ? define('DB_USER', 'root') : null;

// DATABASE PASSWORD
!defined('DB_PASS') ? define('DB_PASS', 'root') : null;

// DATABASE PORT
!defined('DB_PORT') ? define('DB_PORT', '3306') : null;

// DATABASE CHARSET
!defined('DB_CHARSET') ? define('DB_CHARSET', 'utf8mb4') : null;