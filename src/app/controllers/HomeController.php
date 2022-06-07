<?php

namespace App\Controllers;

class HomeController
{
    public function home()
    {
        $data = \App::get('queryBuilder')->selectAll('haiku');
        $template = \App::get('template')->load('index.view.twig');
        echo $template->render(['data' => $data]);
    }

    public function delete()
    {
        $id = htmlspecialchars($_POST['id']);
        \App::get('queryBuilder')->deleteById('haiku', $id);
        header("Location: /");
    }
}