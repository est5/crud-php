<?php
require '../core/boot.php';

Router::load('../routes/routes.php')
    ->direct(trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), $_SERVER['REQUEST_METHOD']);