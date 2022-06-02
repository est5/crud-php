<?php

require_once '../database/Connection.php';

$update = false;
$uri = '';
$data = null;

$conn = Connection::connect();

if (isset($_GET['id'])) {
    $uri = '?id=' . htmlspecialchars($_GET['id']) ?? null;
    $id = htmlspecialchars($_GET['id']);
    $sql = "SELECT * FROM haiku WHERE id=$id;";
    $data = $conn->query($sql)->fetch();
    $update = true;
}

$post = htmlspecialchars($_SERVER['PHP_SELF'] . $uri);

$author = $title = $content = '';

if (isset($_POST['ok']) || $update) {
    if (empty($_POST['author'])) {
        $authorErr = 'Author is required';
    } else {
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST['title'])) {
        $titleErr = 'Title is required';
    } else {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST['content'])) {
        $contentError = 'Content is required';
    } else {
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (empty($contentError) && empty($titleErr) && empty($authorErr) && !$update) {
        $sql = "INSERT INTO haiku(author,title,content) VALUES('$author','$title','$content')";
        $conn->query($sql);
        echo '<script type="text/JavaScript"> window.location.href="index.php"; </script>';

    } elseif (empty($contentError) && empty($titleErr) && empty($authorErr) && $update) {
        $id = $_GET['id'];
        $sql = "UPDATE haiku SET author='$author', title='$title', content='$content' WHERE id='$id'";
        $conn->query($sql);
        echo '<script type="text/JavaScript"> window.location.href="index.php"; </script>';

    }
}

require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../view');
$twig = new \Twig\Environment($loader);
$template = $twig->load('form.view.twig');

echo $template->render(['data' => $data, 'post' => $post]);

// require '../view/form.view.php';