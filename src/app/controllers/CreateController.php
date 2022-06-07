<?php

namespace App\Controllers;

class CreateController
{

    public function page()
    {
        $template = \App::get('template')->load('create.view.twig');
        echo $template->render();
    }

    public function create()
    {
        if ($this->check()) {
            $data = $this->sanitize();
            \App::get('queryBuilder')->insert("haiku", $data);
            header("Location: /");
        }
    }

    private function sanitize()
    {
        return [
            'author' => filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'title' => filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'content' => filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ];
    }

    private function check(): bool
    {
        if (empty($_POST['author'])) {
            $authorErr = 'Author is required';
        }
        if (empty($_POST['title'])) {
            $titleErr = 'Title is required';
        }
        if (empty($_POST['content'])) {
            $contentError = 'Content is required';
        }
        return (empty($contentError) && empty($titleErr) && empty($authorErr));
    }

}
