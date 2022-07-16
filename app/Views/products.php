<?= $this->extend('layouts/master'); ?>

<?php

use Michelf\Markdown;

?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row mt-4 mb-4">

        <div class="col-lg-3 order-md-first">
            <h3>Categories</h3>
            <div class="list-group">
                <?php
                foreach ($categories as $category) :
                    $segments = current_url(true)->getSegments();
                    $active = in_array($category['id'], $segments);
                ?>
                    <a href="/product<?= $active ? '' : '/category/' . $category['id']; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<?= $active ? ' active" aria-current="true' : ''; ?>">
                        <?= $category['name']; ?>
                        <?php if ($active) : ?>
                            <span data-feather="x"></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-lg-9">
            <h2>Products</h2>
            <hr>

            <?php if (count($products) > 0) : ?>

                <div class="row row-cols-1 row-cols-md-2">
                    <?php
                    foreach ($products as $product) :
                        $imagepath = \App\Models\Product::getImagePath($product['sku']);
                    ?>

                        <div class="col">
                            <form method="get" action="/cart/add" class="card">
                                <input type="hidden" name="sku" value="<?= $product['sku']; ?>">

                                <div class="card-img-top">
                                    <img src="<?= $imagepath; ?>" alt="<?= $product['name']; ?>" class="img-fluid">
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= $product['name']; ?>
                                    </h5>

                                    <p class="card-text text-end">
                                        Rp. <?= number_format($product['price'], 2, ',', '.'); ?>
                                    </p>

                                    <div class="btn-group float-end">
                                        <button type="submit" class="btn btn-primary">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    <?php endforeach; ?>
                </div>

            <?php else : ?>
                <div class="alert alert-info" role="alert">
                    We have no product here yet, please come back later.
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>