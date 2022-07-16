<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ryan Suhartanto">

    <title><?= env('app.name', 'Cosmic Art.') . ($title ?? '') ?></title>

    <!-- STYLES -->
    <?= $this->include('partials/links') ?>
</head>
<body class="d-flex flex-column">
    
    <?= $this->include('partials/header') ?>

    <!-- CONTENT -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('partials/footer') ?>

    <!-- SCRIPTS -->
    <?= $this->include('partials/scripts') ?>
</body>
</html>