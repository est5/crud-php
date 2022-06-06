<?php
require_once '../vendor/autoload.php';

$cfg = require '../cfg/config.php';

App::register('template', new \Twig\Environment(
    new \Twig\Loader\FilesystemLoader('../app/views')));
App::register('config', $cfg);
App::register('queryBuilder',
    new QueryBuilder(Connection::connect($cfg['database'])));