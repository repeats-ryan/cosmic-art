<?php
$user = \App\Controllers\User::getUser();
?>
<header class="p-3 mb-3 border-bottom bg-light mb-auto sticky-top">
    <div class="container">

        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <!-- LOGO -->
            <a href="/" class="navbar-brand">
                <img src="/static/img/logoface.svg" alt="Cosmic Art" class="bi me-2" width="40" height="32">
            </a>

            <!-- NAVIGATION -->
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <?php
                function inArray(string $key): bool
                {
                    $segments = current_url(true)->getSegments();

                    if ($key === '') {
                        return empty($segments);
                    }

                    return in_array($key, $segments);
                }

                foreach (App\Controllers\Home::$navigation as $key => $value) :
                ?>
                    <li>
                        <a href="/<?= $key ?>" class="nav-link px-2 <?= inArray($key) ? 'link-secondary' : 'link-dark' ?>"><?= $value; ?></a>
                    </li>
                <?php
                endforeach;

                if ($user && $user['role'] !== 'customer') :
                ?>
                    <li>
                        <a href="/admin" class="nav-link px-2 link-dark">Admin</a>
                    </li>
                <?php
                endif;
                ?>
            </ul>

            <!-- USER -->
            <?php
            if (!$user) :
            ?>
                <div class="link-end btn-group" role="group">
                    <a href="/user/signin" class="btn btn-primary">Sign in</a>
                    <a href="/user/register" class="btn btn-warning">Register</a>
                </div>
            <?php
            else :

                $cart = count(\App\Controllers\Cart::getItems($user['id']));
            ?>
                <div class="link-end me-3">
                    <a href="/cart" class="btn btn-sm <?= $cart > 0 ? 'btn-primary' : 'btn-outline-primary'; ?>">
                        <span data-feather="shopping-cart" width="16px"></span>
                        <?php if ($cart > 0) : ?>
                        <span class="badge text-bg-secondary"><?= $cart; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="link-end dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>
                            Hi <?= $user['name'] ?>!
                        </span>
                    </a>

                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser">

                        <!-- <li><a class="dropdown-item" href="/user/profile">Profile</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li> -->

                        <li><a class="dropdown-item" href="/user/signout">Sign out</a></li>

                    </ul>
                </div>
            <?php endif; ?>
        </div>

    </div>
</header>