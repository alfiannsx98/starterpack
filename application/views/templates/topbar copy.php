<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../../index3.html" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- SEARCH FORM
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('assets/vendor/admin/dist/img/profile/') . $user['image']; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $user['nama']; ?></span>
            </a>
            <ul class="dropdown-menu">
                <li class="user-header">
                    <img src="<?= base_url('assets/vendor/admin/dist/img/profile/') . $user['image']; ?>" class="img-circle" alt="AdminLTE Logo">
                    <p><?= $user['nama']; ?>
                        <small><?= $user['nama']; ?></small>
                    </p>
                </li>
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                </li>
            </ul>
        </li>


    </ul>
</nav>
<!-- /.navbar -->