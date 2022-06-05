<?php

$update = false;
$data = null;
$id = null;
if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    $sql = "SELECT * FROM haiku WHERE id=$id;";
    $data = $conn->query($sql)->fetch();
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
        $query->update("haiku", $data, $id);
        echo '<script type="text/JavaScript"> window.location.href="/"; </script>';
    }
} elseif (isset($_POST['ok'])) {
    if (check()) {
        $data = sanitize();
        $query->insert("haiku", $data);
        echo '<script type="text/JavaScript"> window.location.href="/"; </script>';
    }
}

$template = $twig->load('create.view.twig');
echo $template->render(['data' => $data, 'update' => $update, 'id' => $id]);