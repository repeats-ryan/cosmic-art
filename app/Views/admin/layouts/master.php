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

    <!-- DataTables with Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <link href="/static/css/dashboard.css" rel="stylesheet">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/admin">
            <!-- <img src="/static/img/logoface.svg" alt="Cosmic Art" class="bi me-2" width="30" height="24"> -->
            Cosmic Art
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search"> -->
        <span class="w-100"></span>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="/user/signout">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <?php
                        function inArray(string $key) : bool {
                            $segments = current_url(true)->getSegments();
        
                            if ($key === '')
                            {
                                return empty($segments);
                            }
        
                            return in_array($key, $segments);
                        }

                        foreach (App\Controllers\Admin::$navigation as $key => [$data_feather, $label]):
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?= inArray($key) ? 'active' : '' ?>" aria-current="page" href="/admin/<?= $key; ?>">
                                <span data-feather="<?= $data_feather; ?>" class="align-text-bottom"></span>
                                <?= $label; ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Saved reports</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle" class="align-text-bottom"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                Current month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                Last quarter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                Social engagement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                Year-end sale
                            </a>
                        </li>
                    </ul> -->
                </div>
            </nav>

            <!-- CONTENT -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?= $this->renderSection('content'); ?>
            </main>
        </div>
    </div>


    <?= $this->include('partials/scripts'); ?>

    <!-- DataTables with Bootstrap 5 -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>