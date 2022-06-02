<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . $uri) ?>" method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input value="<?php echo $data['title'] ?? null; ?>" name="title" maxlength="50" required type="text"
            class="form-control" id="title" aria-describedby="title">
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input value="<?php echo $data['author'] ?? null; ?>" name='author' maxlength="80" required type="text"
            class="form-control" id="author">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content"
            rows="3"><?php echo $data['content'] ?? null; ?></textarea>
    </div>
    <input name="ok" value="Submit" type="submit" class="btn btn-primary">
</form>