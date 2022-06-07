<?php

namespace App\Controllers;

class UpdateController
{

    public function updatePage()
    {
        $id = htmlspecialchars($_POST['id']);
        $data = \App::get('queryBuilder')->selectById('haiku', $id);
        $template = \App::get('template')->load('update.view.twig');
        echo $template->render(['data' => $data, 'id' => $id]);
    }

    public function update()
    {
        if ($this->check()) {
            $id = htmlspecialchars($_POST['id']);
            $data = $this->sanitize();
            \App::get('queryBuilder')->update("haiku", $data, $id);
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