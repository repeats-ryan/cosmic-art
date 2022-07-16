<?= $this->extend('admin/layouts/master'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Orders</h1>
</div>

<?php 
if (count($orders) > 0) :
?>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col" style="width: 30px;">Id</th>
                <th scope="col">User</th>
                <th scope="col" style="width: 240px;">Status</th>
                <th scope="col" style="width: 120px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) ?>
            <tr>
                <td class="text-end pe-2"><?= $order['id']; ?></td>
                <td><?= model('User')->find($order['user_id'])['name']; ?></td>
                <td><?= ucwords($order['status']); ?></td>
                <td>
                    <a href="/admin/order/detail?id=<?= $order['id']; ?>" class="btn btn-sm btn-secondary">Details</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php 
else :
?>

<div class="alert alert-info" role="alert">
    No orders found.
</div>

<?php
endif;
?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script>
    $(document).ready(function() {
        // $('#deleteModal').on('show.bs.modal', event => {
        //     // Button that triggered the modal
        //     var button = $(event.relatedTarget);
        //     // Extract info from data-bs-* attributes
        //     var sku = button.data('data-bs-sku');

        //     // Update the modal's content.
        //     var modal = $('#skuForm').val(sku);
        // });

        $('table.table').DataTable({
            'columnDefs': [{
                "orderable": false,
                "targets": 3
            }]
        });
    });
</script>

<?= $this->endSection(); ?>