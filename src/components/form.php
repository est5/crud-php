<?php
$servername = "mysql";
$username = "root";
$password = "root";
$update = false;
$uri = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=crud_db", $username, $password);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_GET['id'])) {
    $uri = '?id=' . $_GET['id'] ?? null;
    $id = $_GET['id'];
    $sql = "SELECT * FROM haiku WHERE id=$id;";
    $data = $conn->query($sql)->fetch();
    $update = true;
}

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
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . $uri) ?>" method="POST">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input value="<?php echo $data['title'] ?? null; ?>" name="title" maxlength="50" required type="text" class="form-control" id="title" aria-describedby="title">
  </div>
  <div class="mb-3">
    <label for="author" class="form-label">Author</label>
    <input value="<?php echo $data['author'] ?? null; ?>" name='author' maxlength="80" required type="text" class="form-control" id="author">
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea class="form-control" id="content" name="content" rows="3"><?php echo $data['content'] ?? null; ?></textarea>
  </div>
  <input name="ok" value="Submit" type="submit" class="btn btn-primary">
</form>
