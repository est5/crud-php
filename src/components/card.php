<?php

$servername = "mysql";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=crud_db", $username, $password);
    $data = $conn->query("SELECT * FROM haiku")->fetchAll();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (array_key_exists('delete', $_POST)) {
    function kekw()
    {
        $id = htmlspecialchars($_GET['id']);
        global $conn;
        $conn->query("DELETE FROM haiku WHERE id=$id");
        echo '<script type="text/JavaScript"> window.location.href="index.php"; </script>';
    }
    kekw();
}
?>
<div class="row row-cols-auto gap-2">
  <?php foreach ($data as $row): ?>
  <div class="card" id="<?php echo $row['id']; ?>" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title"> <?php echo $row['author']; ?> </h5>
      <h6 class="card-subtitle mb-2 text-muted">  <?php echo $row['title']; ?> </h6>
      <p class="card-text ">
        <?php echo $row['content']; ?>
      </p>
      <div class="d-flex justify-content-evenly align-items-center">
        <a href="../create.php?id=<?php echo $row['id'] ?>" class="card-link">Update</a>
        <form method="post" action="<?php echo '?id=' . $row['id'] ?>"> <input type="submit" class="btn btn-danger" name="delete"value='Delete'></form>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
