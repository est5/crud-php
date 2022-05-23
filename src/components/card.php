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
      <a href="../create.php" class="card-link">Update</a>
      <a href="#" class="card-link">Delete</a>
    </div>
  </div>
  <?php endforeach;?>
</div>
