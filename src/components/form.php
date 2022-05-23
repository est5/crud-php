<?php
$servername = "mysql";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=crud_db", $username, $password);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$author = $title = $s1 = $s2 = $s3 = '';

if (isset($_POST['ok'])) {
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
    if (empty($_POST['s1'])) {
        $s1Err = 's1 is required';
    } else {
        $s1 = filter_input(INPUT_POST, 's1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST['s2'])) {
        $s2Err = 's2 is required';
    } else {
        $s2 = filter_input(INPUT_POST, 's2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST['s3'])) {
        $s3Err = 's3 is required';
    } else {
        $s3 = filter_input(INPUT_POST, 's3', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (empty($s1Err) && empty($s2Err) && empty($s3Err) && empty($titleErr) && empty($authorErr)) {
        $content = "$s1 $s2 $s3";
        $sql = "INSERT INTO haiku(title,author,content) VALUES('$title','$author','$content')";
        $conn->query($sql);
        echo 'Created';
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
  <div class="mb-3">
    <label for="author-input" class="form-label">Author</label>
    <input name="author" maxlength="50" required type="text" class="form-control" id="author-input" aria-describedby="author">
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input name='title' maxlength="80" required type="text" class="form-control" id="title">
  </div>
  <div class="input-group gap-1">
    <div class="mb-3">
      <input name="s1"required maxlength="50" class="form-control" id="s1" type="text"></textarea>
      <span class="input-group-text">first sentence</span>
    </div>
    <div class="mb-3">
      <input name="s2" required maxlength="50" class="form-control" id="s2" type="text"></textarea>
      <span class="input-group-text">second sentence</span>
    </div>
    <div class="mb-3">
      <input name="s3" required maxlength="50" class="form-control" id="s3" type="text"></textarea>
      <span class="input-group-text">third sentence</span>
    </div>
  </div>
  <input name="ok" value="Submit" type="submit" class="btn btn-primary">
</form>
