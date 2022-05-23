<form>
  <div class="mb-3">
    <label for="author-input" class="form-label">Author</label>
    <input maxlength="50" required type="text" class="form-control" id="author-input" aria-describedby="author">
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input maxlength="80" required type="text" class="form-control" id="title">
  </div>
  <div class="input-group gap-1">
    <div class="mb-3">
      <input required maxlength="50" class="form-control" id="content" type="text"></textarea>
      <span class="input-group-text">first sentence</span>
    </div>
    <div class="mb-3">
      <input required maxlength="50" class="form-control" id="content" type="text"></textarea>
      <span class="input-group-text">second sentence</span>
    </div>
    <div class="mb-3">
      <input required maxlength="50" class="form-control" id="content" type="text"></textarea>
      <span class="input-group-text">third sentence</span>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
