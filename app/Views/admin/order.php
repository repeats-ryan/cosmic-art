<?= $this->extend('admin/layouts/master'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Order details</h1>
    <div class="btn-toolbar mb-2 mb-md-0">

        <a href="/admin/order" class="btn btn-sm btn-outline-secondary">
            <span data-feather="arrow-left"></span>
            Back
        </a>

    </div>
</div>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Order ID: <b><?= $order['id']; ?></b></h5>
        <h6 class="card-subtitle mb-2 text-muted">For: <i><?= $user['name']; ?></i></h6>
        <p class="card-text"><?= ucwords($order['status']); ?></p>
        
        <?php if ($order['status'] !== 'completed'): ?>
        <div class="btn-group">
            <a href="/admin/order/increment?id=<?= $order['id']; ?>" class="btn btn-primary"><?= ucwords(\App\Controllers\Admin::incrementMessage($order['status'])); ?></a>
            <!-- <a href="/admin/order/cancel?id=<?= $order['id']; ?>" class="btn btn-outline-danger">Cancel</a> -->
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col" style="width: 120px;">SKU</th>
                <th scope="col">Name</th>
                <th scope="col" style="width: 80px;">Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $detail) : ?>
                <tr>
                    <td><?= $detail['sku']; ?></td>
                    <td><?= $detail['name']; ?></td>
                    <td class="text-end pe-2"><?= $detail['quantity']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script>
    $(document).ready(function() {
        $('table.table').DataTable({
            'columnDefs': [{
                "orderable": false,
                "targets": 3
            }]
        });
    });
</script>

<?= $this->endSection(); ?>