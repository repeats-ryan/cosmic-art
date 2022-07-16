<?= $this->extend('layouts/master'); ?>

<?= $this->section('links'); ?>
<link rel="stylesheet" href="/static/css/signin.css">
<?= $this->endSection(); ?>

<?php
helper('form');
?>

<?= $this->section('content'); ?>

<?= form_open('user/signin', ['class' => 'text-center form-signin w-100 m-auto g-3']); ?>

<img src="/static/img/logotype.svg" alt="" width="125" height="100">
<h1 class="h3 mb-3 fw-normal"><?= $success ? $success[0] : 'Welcome back!'; ?></h1>

<!-- INPUTS -->
<div class="form-floating mb-2">
    <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
    <label for="floatingEmail">Email</label>
</div>
<div class="form-floating mb-2">
    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
    <label for="floatingPassword">Password</label>
</div>

<div class="checkbox mb-3">
    <label>
        <input type="checkbox" name="remember-me" value="remember-me"> Remember me
    </label>
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

<button class="w-100 btn btn-lg btn-primary mt-1" type="submit">Sign in</button>
<a href="/user/register" class="btn btn-link">Or register instead</a>

</form>

<?= $this->endSection(); ?>