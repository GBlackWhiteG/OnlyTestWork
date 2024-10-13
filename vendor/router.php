<?php

$routes = require_once ROOT . '/config/routes.php';

$uri = trim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

foreach ($routes as $key => $value) {
    if ($uri == $key) {
        require_once $value;
        exit;
    }
}

echo 'Error 404';
