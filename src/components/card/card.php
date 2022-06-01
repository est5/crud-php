<?php

$servername = "mysql";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=crud_db", $username, $password);
    $data = $conn->query("SELECT * FROM haiku")->fetchAll();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (array_key_exists('delete', $_POST)) {
    function update()
    {
        $id = htmlspecialchars($_GET['id']);
        global $conn;
        $conn->query("DELETE FROM haiku WHERE id=$id");
        echo '<script type="text/JavaScript"> window.location.href="index.php"; </script>';
    }
    update();
}

require 'card.view.php';