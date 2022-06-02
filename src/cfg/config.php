<?php

return [
    'database' => [
        'name' => 'crud_db',
        'username' => 'root',
        'password' => 'root',
        'connection' => 'mysql:host=mysql',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        ],
    ],
];