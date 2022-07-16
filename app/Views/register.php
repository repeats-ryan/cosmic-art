<?= $this->extend('layouts/master'); ?>

<?= $this->section('links'); ?>
<link rel="stylesheet" href="/static/css/signin.css">
<?= $this->endSection(); ?>

<?php
helper('form');
?>

<?= $this->section('content'); ?>

<?php
// TODO: Add form validation with Bootstrap
function isValidated($errors): bool
{
    global $errors;
    return is_array($errors);
}

// Valid until proven otherwise
function isValid(string $name): bool
{
    global $errors;
    return !(isValidated() && array_key_exists($name, $errors));
}

function getValid(string $name): string
{
    return isValid($name) ? 'valid' : 'invalid';
}

function getMessage(string $name): string
{
    global $errors;
    return isValid($name) ? '' : $errors[$name];
}
?>
<?= form_open('user/register', ['class' => 'text-center form-signin w-100 m-auto g-3']); ?>

<img src="/static/img/logotype.svg" alt="" width="125" height="100">
<h1 class="h3 mb-3 fw-normal">Welcome aboard!</h1>

<!-- INPUTS -->
<div class="form-floating mb-2">
    <input type="text" name="name" class="form-control" id="floatingName" placeholder="John Doe" required>
    <label for="floatingName">Name</label>
</div>
<div class="form-floating mb-2">
    <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="johndoe@example.com" required>
    <label for="floatingEmail">Email</label>
</div>
<div class="form-floating mb-2">
    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
    <label for="floatingPassword">Password</label>
</div>
<div class="form-floating mb-2">
    <input type="password" name="passconf" class="form-control" id="floatingPassconf" placeholder="Password" required>
    <label for="floatingPasswordConfirm">Confirm password</label>
</div>

<?php if ($errors) : ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $key => $message) : ?>
            <?= $message; ?>

            <?php if ($key !== array_key_last($errors)): ?>
                <hr>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<button class="w-100 btn btn-lg btn-warning mt-1" type="submit">Register</button>
<a href="/user/signin" class="btn btn-link">Or sign in instead</a>

</form>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<!-- <script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script> -->

<?= $this->endSection(); ?>