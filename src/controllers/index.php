<?php

$data = $conn->query("SELECT * FROM haiku")->fetchAll();

if (array_key_exists('delete', $_POST)) {
    function del()
    {
        $id = htmlspecialchars($_POST['id']);
        global $conn;
        $conn->query("DELETE FROM haiku WHERE id=$id");
        echo '<script type="text/JavaScript"> window.location.href="/"; </script>';
    }
    del();
}

$template = $twig->load('index.view.twig');
echo $template->render(['data' => $data]);