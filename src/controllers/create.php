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
    return empty(($contentError) && empty($titleErr) && empty($authorErr));
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
        $sql = "UPDATE haiku SET author='{$data['author']}', title='{$data['title']}', content='{$data['content']}' WHERE id='$id'";
        $conn->query($sql);
        echo '<script type="text/JavaScript"> window.location.href="/"; </script>';
    }
} elseif (isset($_POST['ok'])) {
    if (check()) {
        $data = sanitize();
        $sql = "INSERT INTO haiku(author,title,content) VALUES('{$data['author']}','{$data['title']}','{$data['content']}')";
        $conn->query($sql);
        echo '<script type="text/JavaScript"> window.location.href="/"; </script>';
    }
}

$template = $twig->load('create.view.twig');
echo $template->render(['data' => $data, 'update' => $update, 'id' => $id]);