<?= $this->extend('admin/layouts/master'); ?>
<?php
helper('form');
?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $edit ? 'Edit product' : 'Add product'; ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">

        <div class="btn-group">
            <a href="/admin/product" class="btn btn-sm btn-warning">
                <span data-feather="x"></span>
                Cancel
            </a>
        </div>

    </div>
</div>

<?= form_open_multipart('admin/product/' . ($edit ? 'edit' : 'add')); ?>
<?php if ($edit) : ?>
    <input type="hidden" name="sku" value="<?= $edit['sku']; ?>">
<?php endif; ?>

<label for="skuForm" class="form-label">SKU</label>
<div class="mb-3">
    <input type="text" name="sku" class="form-control" id="skuForm" required<?= $edit ? (' disabled value="' . $edit['sku'] . '"') : ''; ?>>
    <div class="form-text">Cannot be changed later!</div>
</div>

<div class="mb-3">
    <label for="categoryForm" class="form-label">Category</label>
    <select name="category" class="form-select" id="categoryForm">
        <?php
        foreach (model('Category')->findAll() as $category) :
            $selected = $edit && $category['id'] == $edit['category'] ? ' selected' : '';
        ?>
            <option value="<?= $category['id']; ?>" <?= $selected; ?>><?= $category['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<label for="nameForm" class="form-label">Product name</label>
<div class="mb-3">
    <input type="text" name="name" class="form-control" id="nameForm" required<?= $edit ? (' value="' . $edit['name'] . '"') : ''; ?>>
</div>

<label for="descriptionForm" class="form-label">Description</label>
<div class="mb-3">
    <textarea name="description" class="form-control" id="descriptionForm" rows="3"><?= $edit ? $edit['description'] : ''; ?></textarea>
</div>

<label for="priceForm" class="form-label">Price</label>
<div class="mb-3 input-group">
    <span class="input-group-text">Rp.</span>
    <input type="number" min="0" max="<?= str_repeat('9', 16); ?>" step="100" name="price" class="form-control" id="priceForm" required<?= $edit ? (' value="' . $edit['price'] . '"') : ''; ?>>
    <span class="input-group-text">,00</span>
</div>

<label for="stockForm" class="form-label">Stock</label>
<div class="mb-3 input-group">
    <input type="number" min="0" max="<?= str_repeat('9', 8); ?>" step="1" name="stock" class="form-control" id="stockForm" required<?= $edit ? (' value="' . $edit['stock'] . '"') : ''; ?>>
    <span class="input-group-text">qty</span>
</div>

<label for="imagesForm" class="form-label">Image</label>
<div class="mb-3">
    <input type="file" name="images" class="form-control" id="imagesForm" accept="image/jpg">
    <div class="form-text">Will replace existing image!</div>
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