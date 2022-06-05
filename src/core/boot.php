<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../app/views');
$twig = new \Twig\Environment($loader);
$cfg = require '../cfg/config.php';

$conn = Connection::connect($cfg['database']);
$query = new QueryBuilder($conn);