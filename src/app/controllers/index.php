<?php

$data = App::get('queryBuilder')->selectAll('haiku');

if (array_key_exists('delete', $_POST)) {
    function del()
    {
        $id = htmlspecialchars($_POST['id']);
        App::get('queryBuilder')->deleteById('haiku', $id);
        header("Location: /");
    }
    del();
}

// $template = $twig->load('index.view.twig');
$template = App::get('template')->load('index.view.twig');
echo $template->render(['data' => $data]);