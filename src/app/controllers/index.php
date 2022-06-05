<?php

$data = $query->selectAll('haiku');

if (array_key_exists('delete', $_POST)) {
    function del()
    {
        $id = htmlspecialchars($_POST['id']);
        global $conn;
        $conn->query("DELETE FROM haiku WHERE id=$id");
        header("Location: /");
    }
    del();
}

$template = $twig->load('index.view.twig');
echo $template->render(['data' => $data]);