<?php

class Connection
{
    public static function connect()
    {
        $servername = "mysql";
        $username = "root";
        $password = "root";

        try {
            return new PDO("mysql:host=$servername;dbname=crud_db", $username, $password);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}