<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>

<!-- Print the products and its quantity as a list with a button to edit and remove. -->
<div class="container">

    <h2 class="mt-4">Cart</h2>
    <hr>
    <?php

    if (!$items) :

    ?>
        <div class="alert alert-info">
            Your cart is empty.
        </div>
    <?php
    else :
    ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($items as $item) :
                    $total = $item['price'] * $item['quantity'];
                ?>
                    <tr>
                        <td><?= $item['name']; ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td><?= 'Rp.' . number_format($item['price'], 2, ',', '.'); ?></td>
                        <td><?= 'Rp.' . number_format($total, 2, ',', '.'); ?></td>
                        <td>
                            <a href="/cart/remove?sku=<?= $item['sku']; ?>" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>

    <?php
    endif;
    ?>

    <h2 class="mt-4">History</h2>
    <hr>

    <?php
    if (!$history) :
    ?>
        <div class="alert alert-info">
            You have no history.
        </div>
    <?php
    else :
    ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($history as $item) :
                ?>
                <tr>
                    <td><?= $item['id']; ?></td>
                    <td><?= $item['status']; ?></td>
                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    <?php
    endif;
    ?>

</div>

<?= $this->endSection(); ?>