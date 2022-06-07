<?php

$router->get('', 'HomeController@home');
$router->post('delete', 'HomeController@delete');

$router->post('update', 'UpdateController@updatePage');
$router->post('update/ok', 'UpdateController@update');

$router->get('create', 'CreateController@page');
$router->post('create', 'CreateController@create');