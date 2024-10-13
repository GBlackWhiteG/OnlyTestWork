<?php

session_start();

require_once dirname(__DIR__ ) . '/config/config.php';

require_once ROOT . '/vendor/classes/Db.php';
$db_config = require_once ROOT . '/config/db.php';
$db = new Db($db_config);

require_once ROOT . '/vendor/classes/Validator.php';
require_once ROOT . '/vendor/funcs.php';

require_once ROOT . '/vendor/router.php';
