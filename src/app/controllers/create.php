<?php

$update = false;
$data = null;
$id = null;
if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    $data = App::get('queryBuilder')->selectById('haiku', $id);
    $update = true;
}
$author = $title = $content = '';
function check(): bool
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

function sanitize()
{
    return [
        'author' => filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        'title' => filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        'content' => filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    ];
}

if (isset($_POST['update'])) {
    if (check()) {
        $data = sanitize();
        $id = $_POST['update'];
        App::get('queryBuilder')->update("haiku", $data, $id);
        echo '<script type="text/JavaScript"> window.location.href="/"; </script>';
    }
} elseif (isset($_POST['ok'])) {
    if (check()) {
        $data = sanitize();
        App::get('queryBuilder')->insert("haiku", $data);
        echo '<script type="text/JavaScript"> window.location.href="/"; </script>';
    }
}

$template = App::get('template')->load('create.view.twig');
echo $template->render(['data' => $data, 'update' => $update, 'id' => $id]);