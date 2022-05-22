<?php

require_once __DIR__ . '/../config/app.php';

require_once __DIR__ . '/../config/directory.php';

define('CONFIG_FOLDER', (DEBUG ? 'development' : 'production'));

require_once __DIR__ . '/../config/'.CONFIG_FOLDER.'/email.php';
require_once __DIR__ . '/../config/'.CONFIG_FOLDER.'/database.php';
