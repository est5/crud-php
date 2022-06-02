<?php

class Connection
{
    public static function connect($cfg)
    {
        try {
            return new PDO(
                $cfg['connection'] . ';dbname=' . $cfg['name'],
                $cfg['username'],
                $cfg['password'],
                $cfg['options']);
        } catch (PDOException $e) {
            die(var_dump("Connection failed: " . $e->getMessage()));
        }
    }
}