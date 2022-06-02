<?php

require_once '../database/Connection.php';

$conn = Connection::connect();
$data = $conn->query("SELECT * FROM haiku")->fetchAll();

if (array_key_exists('delete', $_POST)) {
    function del()
    {
        $id = htmlspecialchars($_GET['id']);
        global $conn;
        $conn->query("DELETE FROM haiku WHERE id=$id");
        echo '<script type="text/JavaScript"> window.location.href="index.php"; </script>';
    }
    del();
}

require '../view/card.view.php';