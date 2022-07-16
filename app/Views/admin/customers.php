<?= $this->extend('admin/layouts/master'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Customers</h1>
</div>

<?php
if (count($customers) > 0) :
?>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col" style="width: 30px;">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" style="width: 120px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?= $customer['id']; ?></td>
                        <td><?= $customer['name']; ?></td>
                        <td><?= $customer['email']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="<?= $customer['id']; ?>">Delete</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php
else :
?>

    <div class="alert alert-info" role="alert">
        No customers found.
    </div>

<?php
endif;
?>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <form action="/admin/customer/delete" method="get">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="idForm" value="">
                    <p>Are you sure you want to delete this customer?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>

            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script>
    $(document).ready(function() {
        $('#deleteModal').on('show.bs.modal', event => {
            // Button that triggered the modal
            var button = $(event.relatedTarget);
            // Extract info from data-bs-* attributes
            var id = button.attr('data-bs-id');

            // Update the modal's content.
            var modal = $('#idForm').val(id);
        });

        $('table.table').DataTable({
            'columnDefs': [{
                "orderable": false,
                "targets": 2
            }]
        });
    });
</script>

<?= $this->endSection(); ?>