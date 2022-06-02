<div class="row row-cols-auto gap-2">
    <?php foreach ($data as $row): ?>
    <div class="card" id="<?php echo $row['id']; ?>" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"> <?php echo $row['author']; ?> </h5>
            <h6 class="card-subtitle mb-2 text-muted"> <?php echo $row['title']; ?> </h6>
            <p class="card-text ">
                <?php echo $row['content']; ?>
            </p>
            <div class="d-flex justify-content-evenly align-items-center">
                <a href="../create.php?id=<?php echo $row['id'] ?>" class="card-link">Update</a>
                <form method="post" action="<?php echo '?id=' . $row['id'] ?>"> <input type="submit"
                        class="btn btn-danger" name="delete" value='Delete'></form>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>