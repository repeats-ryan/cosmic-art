<?= $this->extend('admin/layouts/master'); ?>
<?php
helper('form');
?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $edit ? 'Edit category' : 'Add category'; ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">

        <div class="btn-group">
            <a href="/admin/category" class="btn btn-sm btn-warning">
                <span data-feather="x"></span>
                Cancel
            </a>
        </div>

    </div>
</div>

<?= form_open_multipart('admin/category/' . ($edit ? 'edit' : 'add')); ?>
<?php if ($edit) : ?>
    <input type="hidden" name="id" value="<?= $edit['id']; ?>">
<?php endif; ?>

<label for="nameForm" class="form-label">Category name</label>
<div class="mb-3">
  <input type="text" name="name" class="form-control" id="nameForm" required<?= $edit ? (' value="' . $edit['name'] . '"') : ''; ?>>
</div>

<label for="descriptionForm" class="form-label">Description</label>
<div class="mb-3">
  <textarea name="description" class="form-control" id="descriptionForm" rows="3"><?= $edit ? $edit['description'] : ''; ?></textarea>
</div>

<?php if ($errors) : ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $key => $message) : ?>
            <?= $message; ?>

            <?php if ($key !== array_key_last($errors)) : ?>
                <hr>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<button type="submit" class="btn btn-primary">Submit</button>

</form>

<?= $this->endSection(); ?>
