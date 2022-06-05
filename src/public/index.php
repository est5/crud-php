<?php
require '../core/boot.php';

require Router::load('../routes/routes.php')
    ->direct(trim($_SERVER['REQUEST_URI'], '/'));